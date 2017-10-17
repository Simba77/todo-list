<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<div class="auth-form">
	<div class="cls-content-sm panel">
		<div class="panel-body">
			<p class="pad-btm">Авторизация</p>
            <?
            ShowMessage($arParams["~AUTH_RESULT"]);
            ShowMessage($arResult['ERROR_MESSAGE']);
            ?>
			<form action="<?=$arResult["AUTH_URL"]?>" method="post">
                <input type="hidden" name="AUTH_FORM" value="Y" />
                <input type="hidden" name="TYPE" value="AUTH" />
                <?if (strlen($arResult["BACKURL"]) > 0):?>
                    <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
                <?endif?>
                <?foreach ($arResult["POST"] as $key => $value):?>
                    <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                <?endforeach?>

                <div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-user"></i></div>
						<input type="text" name="USER_LOGIN" class="form-control" placeholder="<?=GetMessage("AUTH_LOGIN")?>"  value="<?=$arResult["LAST_LOGIN"]?>" required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
						<input type="password" class="form-control" name="USER_PASSWORD" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
					</div>
				</div>
                <?if($arResult["CAPTCHA_CODE"]):?>
                <div class="row">
                    <div class="col-xs-5">
                        <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                    </div>
                    <div class="col-xs-7">
                        <input class="form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" />
                    </div>
                </div>
                <?endif;?>
				<div class="row">
					<div class="col-xs-8 text-left checkbox remember">
						<label class="form-checkbox form-icon">
							<input type="checkbox" name="USER_REMEMBER" value="Y"> <?=GetMessage("AUTH_REMEMBER_ME")?>
						</label>
					</div>
					<div class="col-xs-4">
						<div class="form-group text-right">
							<button class="btn btn-success text-uppercase" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" type="submit"><?=GetMessage("AUTH_AUTHORIZE")?></button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>