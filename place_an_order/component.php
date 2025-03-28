<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

// Пример данных для теста
$arResult = [
    "TITLE" => "Добро пожаловать на наш сайт!",
    "MESSAGE" => "Этот текст отображается из компонента.",
];

// Подключаем шаблон компонента
$this->IncludeComponentTemplate();
?>
