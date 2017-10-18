<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$all_time = 0;
$all_money = 0;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title"><?= $arResult['SECTION_DATA']['NAME'] ?></h4>
                <p class="category">
                    <?= $arResult['SECTION_DATA']['DESCRIPTION'] ?>

                    Стоимость часа: <b><?= $arResult['SECTION_DATA']['UF_HOUR_PRICE'] ?> руб.</b>
                </p>

            </div>
            <div class="content table-responsive table-full-width">

                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Задача поставлена</th>
                    <th>Крайний срок</th>
                    <th>Стоимость</th>
                    <th>Количество часов</th>
                    <th>Статус</th>
                    <th>Статус оплаты</th>
                    </thead>
                    <tbody>
                    <? if (empty($arResult["ITEMS"])): ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                <b>Список пуст</b>
                            </td>
                        </tr>
                    <? endif; ?>

                    <? foreach ($arResult["ITEMS"] as $arItem): ?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);
                        $all_time = $all_time+$arItem['PROPERTIES']['TIME']['VALUE'];
                        $all_money = $all_money+$arItem['PROPERTIES']['PRICE']['VALUE'];
                        ?>
                        <tr id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <td><?= $arItem['ID'] ?></td>
                            <td><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a></td>
                            <td><?= $arItem['DATE_ACTIVE_FROM'] ?></td>
                            <td><?= $arItem['DATE_ACTIVE_TO'] ?></td>
                            <td><?= $arItem['PROPERTIES']['PRICE']['VALUE'] ?> руб.</td>
                            <td><?= $arItem['PROPERTIES']['TIME']['VALUE'] ?></td>
                            <td><?= $arItem['PROPERTIES']['STATUS']['VALUE'] ?></td>
                            <td><?= $arItem['PROPERTIES']['PAY_STATUS']['VALUE'] ?></td>
                        </tr>
                    <? endforeach; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">
                            <b>Итого:</b>
                        </td>
                        <td><b><?= $all_money ?> руб.</b></td>
                        <td><b><?= $all_time ?> ч.</b></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>

<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
    <?= $arResult["NAV_STRING"] ?>
<? endif; ?>

