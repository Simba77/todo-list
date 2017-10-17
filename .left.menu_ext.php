<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$projects = $APPLICATION->IncludeComponent(
    "bitrix:menu.sections",
    "",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "DEPTH_LEVEL" => "4",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "all",
        "ID" => $_REQUEST["ID"],
        "IS_SEF" => "Y",
        "SECTION_URL" => ""
    ),
    false
);

$aMenuLinks = array_merge($projects, $aMenuLinks);