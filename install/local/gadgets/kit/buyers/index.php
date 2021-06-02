<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

	use Bitrix\Main\Loader;
	use Bitrix\Main\Localization\Loc;
	use Bitrix\Main\Page\Asset;

	Loc::loadMessages(__FILE__);


	Asset::getInstance()->addJs($arGadget['PATH_SITEROOT'].'/script.js');
	Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
	$idUser = intval($USER->GetID());

	$request = \Bitrix\Main\Context::getCurrent()->getRequest();
	$deleteElementId = (int)($request->get("del_buyer"));

	$editing = (($_REQUEST['gdhtml'] == $id) && ($_REQUEST['edit'] == 'true'));

	if(Loader::includeModule('kit.cabinet') && Loader::includeModule('sale') && $idUser > 0)
	{
		if($deleteElementId > 0)
		{
			$buyer = new \Kit\Cabinet\Personal\Buyer();
			$buyer->setId($deleteElementId);
			$buyer->delete($idUser);
			LocalRedirect();
		}


		$buyers = new \Kit\Cabinet\Personal\Buyers($idUser);
		$listBuyers = $buyers->findBuyersForUser($idUser);
		foreach ($listBuyers as $idBuyer => $buyer)
		{
			if($editing)
			{
				?>
			<div id="buyer-<?=$idBuyer?>">
				<div class="personal-container-links personal-container-links-edit">
					<div class="personal-status-title">
						<?php
						if($buyer->getOrg())
						{
							echo $buyer->getOrg(),' (',$buyer->getName(),')';
						}
						else
						{
							echo $buyer->getName();
						}
						?>
						<a
							class="personal-status-title-link"
							href="<?= $buyer->genEditUrl($arParams['G_BUYERS_PATH_TO_BUYER_DETAIL']) ?>"
						>
							<span class="edit"></span>
						</a>
						<span
							class="delete"
							onclick="deleteBuyer(
										'<?= $idBuyer ?>',
										'<?= $arParams['G_BUYERS_PATH_TO_BUYER_DETAIL'] ?>',
										'<?=bitrix_sessid()?>'); return false;">
						</span>
					</div>
				</div>
				<div class="edge-block-inner"></div>
			</div>
		<?
		}
		else
		{
			?>
			<div class="personal-container-links">
				<a class="personal-status-title-link"
					href="<?= $buyer->genEditUrl($arParams['G_BUYERS_PATH_TO_BUYER_DETAIL']) ?>">
					<div class="personal-status-title">
						<?php
						if($buyer->getOrg())
						{
							echo $buyer->getOrg(),' (',$buyer->getName(),')';
						}
						else
						{
							echo $buyer->getName();
						}
						?>
					</div>
				</a>
			</div>
			<div class="edge-block-inner"></div>
			<?
		}
	}
	if(!$editing)
	{
		?>
		<a class="gdhtmlareachlink"
			href="<?= $GLOBALS["APPLICATION"]->GetCurPageParam("gdhtml=" . $id . "&edit=true", array(
				"gdhtml",
				"edit"
		)) ?>">
			<?= Loc::getMessage('GD_KIT_CABINET_BUYERS_EDIT') ?>
		</a>
		<?php
	}
	else
	{
		?>
		<a href="<?= $GLOBALS["APPLICATION"]->GetCurPageParam(($arParams["MULTIPLE"] == "Y" ? "dt_page=" . $arParams["DESKTOP_PAGE"] : ""), array(
			"dt_page",
			"gdhtml",
			"edit"
		)) ?>">
			<?= Loc::getMessage('GD_KIT_CABINET_BUYERS_SAVE') ?>
		</a>
		<?
	}
}
?>