<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}

use Bitrix\Main\Loader,
    Bitrix\Main,
    Bitrix\Main\Engine\CurrentUser,
    Bitrix\Main\UserTable,
    Bitrix\Main\Application,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\HttpResponse,
    \Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Main\Engine\ActionFilter\Authentication;


class PersonalData extends CBitrixComponent implements  Controllerable{

    private int $CurUserID = 0;
    private int $TarUserID = 0;

    public function onPrepareComponentParams($arParams){
        $this->arParams['USER_ID'] = isset($arParams['USER_ID']) ? intval($this->arParams["USER_ID"]) : 0;

        return $arParams;
    }
    
    public function prepareResult(){

        $this->arResult['TARGET_USER_ID'] = $this->arParams['USER_ID'];
        $this->arResult['CUR_USER_ID'] = CurrentUser::get()->getId();
        $this->arResult = UserTable::getList([
            'select' => ['ID', 'NAME', 'LAST_NAME', 'PERSONAL_BIRTHDAY', 'PERSONAL_PHONE'],
            'filter' => ['ID' => $this->arParams['USER_ID']],
        ])->fetch();
    }

    public function checkPermission(){
        if($this->arResult['CURRENT_USER_ID'] <= 0){
            ShowError(Loc::getMessage("COMPONENT_USER_NOT_LOGGED_IN"));
            return false;
        }

        if($this->arResult['CURRENT_USER_ID'] != $this->arResult['TARGET_USER_ID']){
            ShowError(Loc::getMessage("COMPONENT_USER_NOT_IDENTICAL"));
            return false;
        }

        return true;
    }

    public function hello(){
        $request = Application::getInstance()->getContext()->getRequest();
        ShowError($request);
        exit;
    }

    public function configureActions()
    {
        return[
            'hello' => [
                new Authentication(),
            ]
        ];

    }

    public function sendAction(string $name = '', string $last_name,){

    }

    public function executeComponent() {
        $this->checkPermission();
        $this->prepareResult();
        $this->includeComponentTemplate();

    }
}