<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}
/** @var array $arCurrentValues */

use Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
{
	return;
}


$arComponentParameters = [
    "GROUPS" => array(
        "URL_TEMPLATES" => array(
            "NAME" => "ASASF",
        ),
    ),
	"PARAMETERS" => [
		'USER_ID' => [
            "PARENT" => "BASE",
            'NAME' => GetMessage('PERSONAL_USER_ID'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
        ],
        'SAVE_REDIRECT_URL' => [
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => GetMessage('SAVE_REDIRECT_URL'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => '/'
        ],
        'CANCEL_REDIRECT_URL' => [
            'PARENT' => 'URL_TEMPLATES',
            'NAME' => GetMessage('CANCEL_REDIRECT_URL'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => '/'
        ],
        "CACHE_TIME" => [
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => GetMessage('CACHE_TIME'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => '86400'
        ],

        "CACHE_TYPE" => [
            'PARENT' => 'CACHE_SETTINGS',
            'NAME' => GetMessage('CACHE_TIME'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => '86400'
        ],

        "BUTTON_SAVE_NAME" =>[
            'PARENT' => 'VISUAL',
            'NAME' => GetMessage('BUTTON_SAVE_NAME'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => 'Сохранить'

        ],
        "BUTTON_CANCEL_NAME" =>[
            'PARENT' => 'VISUAL',
            'NAME' => GetMessage('BUTTON_CANCEL_NAME'),
            'TYPE' => 'STRING',
            'REFRESH' => 'Y',
            'DEFAULT' => 'Отменить',
        ]
	],

];
