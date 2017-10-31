<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="col-xs-12">
    <div class="card">
        <div class="header">
            <h4 class="title"><?= $arResult['NAME'] ?></h4>
            <p class="category">
                Поставлена: <?= $arResult['DATE_ACTIVE_FROM'] ?><br>
                Крайний срок: <?= !empty($arResult['DATE_ACTIVE_TO']) ? $arResult['DATE_ACTIVE_TO'] : 'Не установлен' ?>
                <br>
                Время на задачу: <?= !empty($arResult['PROPERTIES']['TIME']['VALUE']) ? $arResult['PROPERTIES']['TIME']['VALUE'] : 'Не установлено' ?>
                <br>
                Стоимость: <?= !empty($arResult['PROPERTIES']['PRICE']['VALUE']) ? $arResult['PROPERTIES']['PRICE']['VALUE'] : 'Не установлено' ?>
                <br>
                Статус: <?= !empty($arResult['PROPERTIES']['STATUS']['VALUE']) ? $arResult['PROPERTIES']['STATUS']['VALUE'] : 'Не установлено' ?>
                <br>
                Статус оплаты: <?= !empty($arResult['PROPERTIES']['STATUS']['VALUE']) ? $arResult['PROPERTIES']['STATUS']['VALUE'] : 'Не установлено' ?>

            </p>
        </div>
        <div class="content">
            <p>
                <?= $arResult['DETAIL_TEXT'] ?>
            </p>
        </div>
    </div>
</div>