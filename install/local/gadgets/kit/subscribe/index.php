<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');

$editing = (($_REQUEST['gdhtml'] == $id) && ($_REQUEST['edit'] == 'true'));
$idUser = intval($USER->GetID());

if(Loader::includeModule('kit.mailing') && Loader::includeModule('kit.cabinet') && $idUser > 0)
{
	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['gdsubscribeform'] == 'Y' && $_REQUEST['gdhtml'] == $id)
	{
		if(!is_array($_POST['CATEGORIES_ID_CHECK']))
		{
			$idSubscribes = array(0 => 0);
		}
		else
		{
			$idSubscribes = $_POST['CATEGORIES_ID_CHECK'];
		}
		$subscribes = new \Kit\Cabinet\Personal\Subscribes();
		$subscribes->setIdSubscriber(intval($_POST['idSubscriber']));
		$subscribes->updateSubdcribes($_POST['EMAIL_TO'], $idSubscribes);
	}


	$subscribes = new \Kit\Cabinet\Personal\Subscribes();
	$subscribes->setFilter(array('USER_ID' => $idUser));
	$subscribes->genSubscribes();


	if($editing)
	{
		?>
		<form action="?gdhtml=<?= $id ?>" method="post" id="gdf<?= $id ?>">
			<input type="hidden" name="gdsubscribeform" value="Y">
			<input type="hidden" name="idSubscriber" value="<?= $subscribes->getIdSubscriber() ?>">
			<input type="text" value="<?= $subscribes->getEmail() ?>" name="EMAIL_TO"
				   title="<?= GetMessage('PANNEL_EMAIL') ?>" placeholder="<?= GetMessage('PANNEL_EMAIL') ?>">
			<?php
			foreach ($subscribes->getSubscribes() as $subscribe)
			{
				?>
				<div>
					<input type="checkbox" value="<?= $subscribe->getId() ?>"
						   name="CATEGORIES_ID_CHECK[<?= $subscribe->getId() ?>]" <?
						   if($subscribe->isSubscribed())
						   : ?>checked="checked"<?
					endif;
					?> id="CATEGORIES_ID_CHECK[<?= $subscribe->getId() ?>]"/>
					<label for="CATEGORIES_ID_CHECK[<?= $subscribe->getId() ?>]"><?= $subscribe->getName() ?> </label>
				</div>
				<?
			}
			?>
			<?= bitrix_sessid_post() ?>
		</form>
		<script type="text/javascript">
			function gdhtmlsave() {
				document.getElementById("gdf<?=$id?>").submit();
				return false;
			}
		</script>
		<a href="javascript:void(0);" onclick="return gdhtmlsave();">
			<?=Loc::getMessage('GD_KIT_CABINET_SUBSCRIBES_OK')?>
		</a>
		|
		<a href="<?= $GLOBALS["APPLICATION"]->GetCurPageParam(($arParams["MULTIPLE"] == "Y" ? "dt_page=" . $arParams["DESKTOP_PAGE"] : ""), array(
			"dt_page",
			"gdhtml",
			"edit"
		)) ?>">
			<?=Loc::getMessage('GD_KIT_CABINET_SUBSCRIBES_CANCEL')?>
		</a>
		<?
	}
	else
	{
		?>
		<div class="subscribe-theme">
			<div class="subscribe-block">
				<?= $subscribes->getEmail() ?>
				<a href="<?= $arParams['G_SUBSCRIBE_PATH_TO_SUBSCRIBES'] ?>" class="subscribe-theme-icon"></a>
			</div>
		</div>
		<div class="subscribe-items">
			<?
			foreach ($subscribes->getSubscribes() as $subscribe)
			{
				?>
				<span><?= $subscribe->getName() ?></span>
				<?
			}
			?>
		</div>
		<a class="gdhtmlareachlink"
		   href="<?= $GLOBALS["APPLICATION"]->GetCurPageParam("gdhtml=" . $id . "&edit=true", array(
			   "gdhtml",
			   "edit"
		   )) ?>"><?=Loc::getMessage('GD_KIT_CABINET_SUBSCRIBES_EDIT')?></a>
		<?php
	}

}
?>
