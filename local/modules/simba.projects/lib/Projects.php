<?php
/**
 * Created by PhpStorm.
 * User: Maxim Masalov
 * Date: 13.10.2017
 * Time: 16:31
 * Project: projects.local
 */

namespace Simba\Projects;

use Bitrix\Main\Loader,
    Bitrix\Main\Type\DateTime;

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
            ["IBLOCK_ID" => self::IBLOCK_ID, "CODE" => ["STATUS", 'PAY_STATUS']]
        );
        while ($enum_fields = $property_enums->GetNext()) {
            $statuses[$enum_fields['PROPERTY_CODE']][] = $enum_fields;
        }

        return $statuses;
    }


    /**
     * Сохранение задачи
     * @param $fields
     * @return bool
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
        return $oElement->Add($arFields, false, false, false);
    }


    /**
     * Метод получает даты для фиотрации списка
     * @return array
     */
    public static function getDates()
    {
        $dates = [];

        // Текущие месяц и год
        $dates['current_month'] = date('n');
        $dates['current_year'] = date('Y');

        // Предыдущий месяц и год
        $dates['previous_month'] = $dates['current_month'] - 1;
        $dates['previous_year'] = $dates['current_year'];
        if ($dates['previous_month'] == 0) {
            $dates['previous_month'] = 12;
            $dates['previous_year'] = $dates['current_year'] - 1;
        }

        $dates['month'] = !empty($_REQUEST['month']) ? intval($_REQUEST['month']) : $dates['current_month'];
        $dates['year'] = !empty($_REQUEST['year']) ? intval($_REQUEST['year']) : $dates['current_year'];
        $dates['years'] = $dates['months'] = [];

        // Прописываем установленную дату и месяц в сессию, чтобы не терять
        // выбранный период при переходах на другие страницы
        if (!empty($_REQUEST['month']) && !empty($_REQUEST['year'])) {
            $_SESSION['kpi_month'] = $dates['month'];
            $_SESSION['kpi_year'] = $dates['year'];
        } else {
            if (!empty($_SESSION['kpi_month']) && !empty($_SESSION['kpi_year'])) {
                $dates['month'] = $_SESSION['kpi_month'];
                $dates['year'] = $_SESSION['kpi_year'];
            }
        }

        $dates['months'] = [
            '1'  => ['id' => 1, 'name' => 'Январь'],
            '2'  => ['id' => 2, 'name' => 'Февраль'],
            '3'  => ['id' => 3, 'name' => 'Март'],
            '4'  => ['id' => 4, 'name' => 'Апрель'],
            '5'  => ['id' => 5, 'name' => 'Май'],
            '6'  => ['id' => 6, 'name' => 'Июнь'],
            '7'  => ['id' => 7, 'name' => 'Июль'],
            '8'  => ['id' => 8, 'name' => 'Август'],
            '9'  => ['id' => 9, 'name' => 'Сентябрь'],
            '10' => ['id' => 10, 'name' => 'Октябрь'],
            '11' => ['id' => 11, 'name' => 'Ноябрь'],
            '12' => ['id' => 12, 'name' => 'Декабрь']
        ];

        $dates['years'][0] = ['id' => 0, 'name' => '- Год -'];
        $dates['months'][0] = ['id' => 0, 'name' => '- Месяц -'];


        // Минимальный год для выбора в фильтре -5 лет от текущего
        $min_year = $dates['current_year'] - 5;

        for ($i = $min_year; $i <= $dates['current_year']; $i++) {
            $dates['years'][$i] = ['id' => $i, 'name' => $i];
        }

        if (!array_key_exists($dates['year'], $dates['years'])) {
            // Чтобы небыло пустоты в селекте при навигации, дописываем год, хоть данных по нему и нет
            $dates['years'][$dates['year']] = ['id' => $dates['year'], 'name' => $dates['year']];
        }

        // Дата начала и конца месяца
        $dates['start_date'] = new DateTime(date('01.' . $dates['month'] . '.' . $dates['year']));
        $dates['end_date'] = new DateTime(date('01.' . $dates['month'] . '.' . $dates['year']));
        $dates['end_date']->add('+1 month -1 second');

        return $dates;

    }


}