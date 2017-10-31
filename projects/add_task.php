<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Добавить задачу");

use \Simba\Projects\Projects,
    \Bitrix\Main\Loader;

Loader::includeModule('simba.projects');
$statuses = Projects::getStatuses();

$section_id = isset($_REQUEST['section_id']) ? intval($_REQUEST['section_id']) : 0;

$rsSections = \CIBlockSection::GetList(
    [], ['IBLOCK_ID' => Projects::IBLOCK_ID, 'ID' => $section_id],
    false, ['ID', 'NAME', 'DESCRIPTION_TYPE', 'DESCRIPTION', 'SECTION_PAGE_URL']
);
$back_url = '/projects/' . $USER->GetID().'/';
if ($arrSection = $rsSections->GetNext()) {
    $back_url = $arrSection['SECTION_PAGE_URL'];
}

if (!empty($_POST['submit']) && $_POST['submit'] == 'add_form') {
    Projects::saveTask($_POST);
    LocalRedirect($back_url);
}

?>
    <div class="col-xs-12" id="add_task">
        <div class="card">
            <div class="header">
                <h4 class="title">Добавить задачу</h4>
            </div>
            <div class="content">
                <form method="post" action="">
                    <input type="hidden" name="section_id" value="<?= $section_id ?>">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text"
                                       name="name"
                                       v-model="message"
                                       class="form-control border-input"
                                       required
                                       placeholder="Название"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Символьный код</label>
                                <input type="text"
                                       v-model="code"
                                       class="form-control border-input"
                                       placeholder="Символьный код"
                                       name="code"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Статус</label>
                                <select name="status" id="status" class="form-control border-input">
                                    <? foreach ($statuses['STATUS'] as $status) { ?>
                                        <option value="<?= $status['ID'] ?>"><?= $status['VALUE'] ?></option>
                                        <?
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Статус оплаты</label>
                                <select name="pay_status" id="pay_status" class="form-control border-input">
                                    <? foreach ($statuses['PAY_STATUS'] as $status) { ?>
                                        <option value="<?= $status['ID'] ?>"><?= $status['VALUE'] ?></option>
                                        <?
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <legend>Трудозатраты</legend>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Часов</label>
                                <input type="number"
                                       v-model="hour"
                                       name="hour"
                                       class="form-control border-input"
                                       placeholder="Часов"
                                       value="0"
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Минут</label>
                                <input type="number"
                                       v-model="minutes"
                                       name="minutes"
                                       class="form-control border-input"
                                       placeholder="Минут"
                                       value="0"
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Расчетная стоимость</label>
                                <input type="text"
                                       v-model="price"
                                       name="price"
                                       class="form-control border-input"
                                       placeholder="Стоимость"
                                       value="0"
                                >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Дата постановки</label>
                                <input type="text"
                                       name="date_start"
                                       class="form-control border-input date-picker"
                                       placeholder="Дата постановки"
                                       data-timepicker="true"
                                       value="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Дата завершения</label>
                                <input type="text"
                                       name="date_end"
                                       class="form-control border-input date-picker"
                                       placeholder="Дата завершения"
                                       data-timepicker="true"
                                       value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Описание задачи</label>
                                <textarea rows="5" name="description" class="form-control border-input"
                                          placeholder="Описание задачи"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" name="submit" value="add_form" class="btn btn-info btn-fill btn-wd">
                            Сохранить
                        </button>
                        <a href="<?= $back_url ?>" class="btn btn-default btn-fill btn-wd">Отмена</a>
                    </div>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('.date-picker').datepicker({});
        });
    </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>