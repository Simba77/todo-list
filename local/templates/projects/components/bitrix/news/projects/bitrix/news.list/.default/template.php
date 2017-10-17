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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="header">
                <h4 class="title">Название проекта</h4>
                <p class="category">Краткое описание....</p>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-striped">
                    <thead>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Крайний срок</th>
                    <th>Стоимость</th>
                    <th>Количество часов</th>

                    </thead>
                    <tbody>
                        <? if(empty($arResult["ITEMS"])): ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <b>писок пуст</b>
                                </td>
                            </tr>
                        <? endif; ?>

                        <?foreach($arResult["ITEMS"] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <td><?= $arItem['ID'] ?></td>
                                <td><a href="<?= $arItem['DETAIL_PAGE_URL'] ?>"><?= $arItem['NAME'] ?></a></td>
                                <td><?= $arItem['DATE_ACTIVE_TO'] ?></td>
                                <td>Chile</td>
                                <td>Gloucester</td>
                            </tr>
                        <?endforeach;?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

