<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if(Loader::includeModule('kit.cabinet') && $idUser > 0)
{
	$listOrders = new \Kit\Cabinet\Shop\Orders();
	$listOrders->setLimit(1);

	$filter = array(
		"USER_ID" => $idUser,
		"LID" => SITE_ID,
		'PAYED' => 'N'
	);
	$orders = $listOrders->getOrders($filter);
	foreach ($orders as $order)
	{
		?>
		<div class="buyorder-cost">
			<span> <?=Loc::getMessage('GD_KIT_CABINET_BUYORDER_SUM')?></span>
			<span><?= $order->getPrice() ?></span>
		</div>

		<div class="buyorder-name">
			<span><?=$order->getOrgName($arParams['G_BUYORDER_ORG_PROP'])?></span>
		</div>

		<div class="buyorder-info">
			<span><?=Loc::getMessage('GD_KIT_CABINET_BUYORDER_DATE')?></span>
			<span><?=$order->getDate()->format("d.m.Y H:i:s")?></span>
		</div>

		<div class="buyorder-info">
			<span><?=Loc::getMessage('GD_KIT_CABINET_BUYORDER_PERSON_TYPE')?></span>
			<span><?=$order->getPersonType()?></span>
		</div>
		<div class="b2b-gadget-buyorder-link">
			<a href="<?=$order->getUrl($arParams['G_BUYORDER_PATH_TO_ORDER_DETAIL'])?>">
				<?=Loc::getMessage('GD_KIT_CABINET_BUYORDER_BUY_ONLINE')?>
			</a>
			<?
			$pathToDownload = $order->getDownloadBillLink($arParams['G_BUYORDER_PATH_TO_PAY']);
			if($pathToDownload)
			{
				?>
				<a href="<?=$pathToDownload?>">
					<?=Loc::getMessage('GD_KIT_CABINET_BUYORDER_DOWNLOAD')?>
				</a>
				<?
			}?>
		</div>
	<?
	}
}
?>
