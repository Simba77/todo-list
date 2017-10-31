<?php
/**
 * Created by PhpStorm.
 * User: Maxim Masalov
 * Date: 13.10.2017
 * Time: 16:31
 * Project: projects.local
 */

namespace Simba\Projects;

use Bitrix\Main\Loader;

Loader::includeModule('iblock');


class Projects
{
    /**
     * Идентификатор инфоблока
     */
    const IBLOCK_ID = 1;


    /**
     * Получение статусов оплаты
     * @return array
     */
    public static function getStatuses()
    {
        $statuses = [];
        $property_enums = \CIBlockPropertyEnum::GetList(
            ["DEF" => "DESC", "SORT" => "ASC"],
            ["IBLOCK_ID" => 1, "CODE" => ["STATUS", 'PAY_STATUS']]
        );
        while ($enum_fields = $property_enums->GetNext()) {
            $statuses[$enum_fields['PROPERTY_CODE']][] = $enum_fields;
        }

        return $statuses;
    }


    /**
     * Сохранение задачи
     * @param $fields
     */
    public static function saveTask($fields)
    {
        global $USER;

        $time = $fields['hour'] * 60;
        $time = $fields['minutes'] + $time;

        $arFields = [
            "ACTIVE"            => "Y",
            "IBLOCK_ID"         => self::IBLOCK_ID,
            'DATE_ACTIVE_FROM'  => $fields['date_start'],
            'DATE_ACTIVE_TO'    => $fields['date_end'],
            "IBLOCK_SECTION_ID" => $fields['section_id'],
            "NAME"              => $fields['name'],
            "CODE"              => $fields['code'],
            "DETAIL_TEXT"       => $fields['description'],
            "PROPERTY_VALUES"   => [
                "PRICE"      => $fields['price'],
                "TIME"       => $time,
                "STATUS"     => $fields['status'],
                "PAY_STATUS" => $fields['pay_status']
            ]
        ];
        $oElement = new \CIBlockElement();
        $idElement = $oElement->Add($arFields, false, false, true);

        $rsSections = \CIBlockSection::GetList(
            [], ['IBLOCK_ID' => self::IBLOCK_ID, 'ID' => $fields['section_id']],
            false, ['ID', 'NAME', 'DESCRIPTION_TYPE', 'DESCRIPTION', 'SECTION_PAGE_URL']
        );

        if ($arrSection = $rsSections->GetNext()) {
            LocalRedirect($arrSection['SECTION_PAGE_URL']);
        } else {
            LocalRedirect('/projects/' . $USER->GetID());
        }

    }


}