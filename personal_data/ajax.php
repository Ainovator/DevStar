<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var CBitrixComponent $this */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


use Bitrix\Main\Engine\Controller,
    Bitrix\Main\Loader,
    Bitrix\Main\UserTable,
    Bitrix\Main\Engine\CurrentUser,
    Bitrix\Main;


class EditProfileUserController extends Controller
{
    private int $UID = 0;

    const ACTION_EDIT = "PROFILE_EDIT";

    const COMPONENT_NAME = "futuromed:personal_data";

    /**
     * Не нашёл как мне получить список доступных полей для записи,
     * В UserTable есть только метод getIndexedFields, но там нет PERSONAL_BIRTHDAY
     */
    const FIELDS = [
        "NAME",
        "LAST_NAME",
        "PERSONAL_PHONE",
        "PERSONAL_BIRTHDAY"
    ];

    /**
     * Тут задаём настройки для методов Action
     * Как я понял установленный ~prefilters с данным классом проверяет что USER авторизован
     * @return array[]
     */
    public function configureActions(){
        return [
            'editUserProfile' => [
                '-prefilters' => [
                    Main\Engine\ActionFilter\Authentication::class,
                ],
            ],

        ];
    }


    /**
     * Запускается перед вызовом определённого Action
     * @param Main\Engine\Action $action
     * @return bool
     * @throws Main\LoaderException
     */
    protected function processBeforeAction(Main\Engine\Action $action){
        if(!Loader::includeModule("main"))
        {
            $this->addError(new \Bitrix\Main\Error('Модуль main не найден'));
            return false;
        }

        $this->UID = CurrentUser::get()->getId() ?? null;


        return parent::processBeforeAction($action);
    }

    /**
     * Собственно сам Action для изменения данных пользователя
     * @param array $data
     * @param $actionType
     * @return array|string[]|void
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    public function editUserProfileAction(array $data = [], $actionType = "")
    {

        $this->checkActionType($actionType);

        $result = $this->convertDataObject($data);

        $result = $this->checkFields($result);

        $this->isDuplicatePhone($result['PERSONAL_PHONE']);


        $result['PERSONAL_BIRTHDAY'] = DateTime::createFromFormat('Y-m-d', $result['PERSONAL_BIRTHDAY'])->format('d.m.Y');


        if(!empty($this->getErrors()))
        {
            return ['message' => 'Ошибка'];
        }


        $user = new CUser;
        $isUserUpdated = $user->Update($this->UID, $result);

        if($isUserUpdated)
        {


            return [
                'message' => 'Данные успешно обновлены, кеш очищен',
            ];
        }
        else
        {
            $this->addError(new \Bitrix\Main\Error('Ошибка: '. $isUserUpdated->LAST_ERROR));
        }
    }

    /**
     * Проверка переданных полей на доступные, пустые + подготовка
     * @param array $fields
     * @return void
     */
    private function checkFields(array $fields): array
    {
        foreach($fields as $key=>$value)
        {
            if(!in_array($key, self::FIELDS))
            {
                $this->addError(new \Bitrix\Main\Error('Поле '. $key. ' не соответствует'));
            }
            else if(empty($value))
            {
                $this->addError(new \Bitrix\Main\Error('Пустое поле '. $key));
            }
            else
            {
                $fields[$key] = htmlspecialcharsbx(trim(preg_replace('/\s+/', ' ', $value)));
            }
        }

        return $fields;
    }


    /**
     * Проверка есть ли User с таким телефоном
     * @param $phone
     * @return bool
     * @throws Main\ArgumentException
     * @throws Main\ObjectPropertyException
     * @throws Main\SystemException
     */
    private function isDuplicatePhone($phone): void{
        $duplicate = UserTable::getList([
            'select' => ['ID'],
            'filter' => ['PERSONAL_PHONE' => $phone, '!ID' => $this->UID],
            'limit' => 1
        ])->fetch();

        if(!empty($duplicate))
        {
            $this->addError(new \Bitrix\Main\Error('Есть пользователь с таким телефоном'));
        }
    }

    /**
     * Приведение объекта запроса к ассоциативному массиву
     * @param array $dataObject
     * @return array
     */
    private function convertDataObject (array $dataObject): array
    {
        if(empty($dataObject))
        {
            $this->addError(new \Bitrix\Main\Error('Пустые данные'));
        }

        $convertedData = array_column($dataObject, 'value', 'name');

        return $convertedData;
    }

    /**
     * Проверка на соответствие запрашиваемого действия для AJAX
     * (взял из старых наработок компонента forum.user.profile.edit, думаю полезно лишний раз убедится, что запрос туда летит)
     * @param string $actionType
     * @return void
     */
    private function checkActionType (string $actionType): void
    {
        if (empty($actionType) || $actionType !== self::ACTION_EDIT)
        {
            $this->addError(new \Bitrix\Main\Error('Не верный формат действия'));
        }
    }

}