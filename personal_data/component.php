<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Engine\CurrentUser,
    Bitrix\Main\UserTable;






$arParams['USER_ID'] = intval($arParams['USER_ID']) ?? null;

$curUserID = CurrentUser::get()->getId();

if ($curUserID <= 0) {
//    LocalRedirect($arParams['CANCEL_REDIRECT_URL']);
    ShowError(GetMessage("COMPONENT_USER_NOT_LOGGED_IN"));
    return;
}

if ($curUserID != $arParams['USER_ID']) {
//    LocalRedirect($arParams['CANCEL_REDIRECT_URL']);
    ShowError(GetMessage("COMPONENT_USER_NOT_IDENTICAL"));
    return;
}

if ($arParams["CACHE_TYPE"] == "Y" || ($arParams["CACHE_TYPE"] == "A" && COption::GetOptionString("main", "component_cache_on", "Y") == "Y"))
    $arParams["CACHE_TIME"] = intval($arParams["CACHE_TIME"]);
else
    $arParams["CACHE_TIME"] = 86400;


$cache = new CPHPCache();

$cacheID = "user_edit_profile".$arParams['USER_ID'];
$cache_path_main = str_replace(array(":", "//"), "/", "/".SITE_ID."/".$componentName."/");
$cache_path = $cache_path_main."users";

if($cache->InitCache($arParams['CACHE_TIME'], $cacheID, $cache_path)) {
    $arResult = $cache->GetVars();
}
else
{
    $cache->StartDataCache();

    $arResult = UserTable::getList([
        'select' => ['ID', 'NAME', 'LAST_NAME', 'PERSONAL_BIRTHDAY', 'PERSONAL_PHONE'],
        'filter' => ['ID' => $arParams['USER_ID']],
    ])->fetch();

    if ($arResult)
    {
        $arResult['PERSONAL_BIRTHDAY'] = $arResult['PERSONAL_BIRTHDAY']->format('Y-m-d');

        $cache->endDataCache($arResult);
    }
    else
    {
        $cache->abortDataCache();
    }
}

$this->IncludeComponentTemplate();
