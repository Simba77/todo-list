<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */


$rsSections = CIBlockSection::GetList(
    [], ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arParams['PARENT_SECTION']],
    false, ['NAME', 'DESCRIPTION_TYPE', 'DESCRIPTION', 'UF_*']
);

$arResult['SECTION_DATA'] = $rsSections->GetNext();



