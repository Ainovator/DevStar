<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("PERSONAL_DATA_NAME"),
	"DESCRIPTION" => GetMessage("PERSONAL_DATA_DESC"),
	"ICON" => "/images/news_line.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "futuromed",
		"CHILD" => array(
			"ID" => "Данные",
			"NAME" => GetMessage("PERSONAL_DATA_SECTION"),
			"SORT" => 10,
		)
	),
);

?>