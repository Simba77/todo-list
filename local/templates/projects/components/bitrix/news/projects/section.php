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
$rsSections = CIBlockSection::GetList(
    [], ['IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ID' => $arResult["VARIABLES"]["SECTION_ID"]],
    false, ['ID', 'NAME', 'DESCRIPTION_TYPE', 'DESCRIPTION', 'UF_*']
);
$arResult['SECTION_DATA'] = $rsSections->GetNext();

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
				<p>
					<br>
					<a href="/projects/add_task.php?section_id=<?= $arResult['SECTION_DATA']['ID'] ?>"
					   class="btn button btn-default">Добавить задачу</a>
				</p>
			</div>

			<div class="content table-responsive table-full-width">
				<div class="row">
					<div class="col-xs-12">
						<div class="tasks-filter">
							<div class="pull-right">
								<button class="btn btn-default button-last">
									<i class="ti-angle-right"></i>
								</button>
							</div>
							<div class="pull-left">
								<button class="btn btn-default button-first">
                                    <i class="ti-angle-left"></i>
								</button>
								<div class="select-month">
									<select name="years" id="years" class="form-control border-input">
										<option label="- Год -" value="0">- Год -</option>
										<option label="2017" value="2017" selected="selected">2017</option>
									</select>
								</div>
								<div class="select-month">
									<select name="months" id="months" class="form-control border-input">
										<option label="- Месяц -" value="0">- Месяц -</option>
										<option label="Январь" value="1">Январь</option>
										<option label="Февраль" value="2">Февраль</option>
										<option label="Март" value="3">Март</option>
										<option label="Апрель" value="4">Апрель</option>
										<option label="Май" value="5">Май</option>
										<option label="Июнь" value="6">Июнь</option>
										<option label="Июль" value="7">Июль</option>
										<option label="Август" value="8">Август</option>
										<option label="Сентябрь" value="9">Сентябрь</option>
										<option label="Октябрь" value="10" selected="selected">Октябрь</option>
										<option label="Ноябрь" value="11">Ноябрь</option>
										<option label="Декабрь" value="12">Декабрь</option>
									</select>
								</div>
								<div class="period">
									Месяц:
									<div class="btn-group">
										<button type="button" class="btn btn-default active">
                                            Текущий
										</button>
										<button type="button" class="btn btn-default">
                                            Предыдущий
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "",
                    [
                        "IBLOCK_TYPE"                     => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID"                       => $arParams["IBLOCK_ID"],
                        "NEWS_COUNT"                      => $arParams["NEWS_COUNT"],
                        "SORT_BY1"                        => $arParams["SORT_BY1"],
                        "SORT_ORDER1"                     => $arParams["SORT_ORDER1"],
                        "SORT_BY2"                        => $arParams["SORT_BY2"],
                        "SORT_ORDER2"                     => $arParams["SORT_ORDER2"],
                        "FIELD_CODE"                      => $arParams["LIST_FIELD_CODE"],
                        "PROPERTY_CODE"                   => $arParams["LIST_PROPERTY_CODE"],
                        "DISPLAY_PANEL"                   => $arParams["DISPLAY_PANEL"],
                        "SET_TITLE"                       => $arParams["SET_TITLE"],
                        "SET_LAST_MODIFIED"               => $arParams["SET_LAST_MODIFIED"],
                        "MESSAGE_404"                     => $arParams["MESSAGE_404"],
                        "SET_STATUS_404"                  => $arParams["SET_STATUS_404"],
                        "SHOW_404"                        => $arParams["SHOW_404"],
                        "FILE_404"                        => $arParams["FILE_404"],
                        "INCLUDE_IBLOCK_INTO_CHAIN"       => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
                        "ADD_SECTIONS_CHAIN"              => $arParams["ADD_SECTIONS_CHAIN"],
                        "CACHE_TYPE"                      => $arParams["CACHE_TYPE"],
                        "CACHE_TIME"                      => $arParams["CACHE_TIME"],
                        "CACHE_FILTER"                    => $arParams["CACHE_FILTER"],
                        "CACHE_GROUPS"                    => $arParams["CACHE_GROUPS"],
                        "DISPLAY_TOP_PAGER"               => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER"            => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE"                     => $arParams["PAGER_TITLE"],
                        "PAGER_TEMPLATE"                  => $arParams["PAGER_TEMPLATE"],
                        "PAGER_SHOW_ALWAYS"               => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_DESC_NUMBERING"            => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL"                  => $arParams["PAGER_SHOW_ALL"],
                        "PAGER_BASE_LINK_ENABLE"          => $arParams["PAGER_BASE_LINK_ENABLE"],
                        "PAGER_BASE_LINK"                 => $arParams["PAGER_BASE_LINK"],
                        "PAGER_PARAMS_NAME"               => $arParams["PAGER_PARAMS_NAME"],
                        "DISPLAY_DATE"                    => $arParams["DISPLAY_DATE"],
                        "DISPLAY_NAME"                    => "Y",
                        "DISPLAY_PICTURE"                 => $arParams["DISPLAY_PICTURE"],
                        "DISPLAY_PREVIEW_TEXT"            => $arParams["DISPLAY_PREVIEW_TEXT"],
                        "PREVIEW_TRUNCATE_LEN"            => $arParams["PREVIEW_TRUNCATE_LEN"],
                        "ACTIVE_DATE_FORMAT"              => $arParams["LIST_ACTIVE_DATE_FORMAT"],
                        "USE_PERMISSIONS"                 => $arParams["USE_PERMISSIONS"],
                        "GROUP_PERMISSIONS"               => $arParams["GROUP_PERMISSIONS"],
                        "FILTER_NAME"                     => $arParams["FILTER_NAME"],
                        "HIDE_LINK_WHEN_NO_DETAIL"        => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],
                        "CHECK_DATES"                     => $arParams["CHECK_DATES"],
                        "STRICT_SECTION_CHECK"            => $arParams["STRICT_SECTION_CHECK"],

                        "PARENT_SECTION"      => $arResult["VARIABLES"]["SECTION_ID"],
                        "PARENT_SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                        "DETAIL_URL"          => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
                        "SECTION_URL"         => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                        "IBLOCK_URL"          => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
                    ],
                    $component
                ); ?>
			</div>
		</div>
	</div>
</div>