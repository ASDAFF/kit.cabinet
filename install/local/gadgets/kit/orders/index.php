<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if(Loader::includeModule('kit.cabinet') && Loader::includeModule('sale') && $idUser > 0)
{
    $limit = 2;
    if($arParams['GU_ORDERS_LIMIT'] > 0)
    {
        $limit = $arParams['GU_ORDERS_LIMIT'];
    }
	if($arGadgetParams['LIMIT'] > 0)
	{
		$limit = $arGadgetParams['LIMIT'];
	}
	$listOrders = new \Kit\Cabinet\Shop\Orders();
	$listOrders->setLimit($limit);
	$filter = array(
		"USER_ID" => $idUser,
		"LID" => SITE_ID
	);


	if($arParams['STATUS'] && $arParams['STATUS'] != 'ALL')
	{
		$filter['STATUS_ID'] = $arParams['STATUS'];
	}
	if($arGadgetParams['STATUS'] && $arGadgetParams['STATUS'] != 'ALL')
	{
		$filter['STATUS_ID'] = $arGadgetParams['STATUS'];
	}

	$orders = $listOrders->getOrders($filter);
	foreach ($orders as $order)
	{
		?>
        <div class="order-status">
            <a href="<?= $order->getUrl($arParams['G_ORDERS_PATH_TO_ORDER_DETAIL']) ?>"
               class="order-status-title-link"
               title="<?= Loc::getMessage('GD_KIT_CABINET_ORDER_ORDER') ?> <?= $order->getId() ?>">
                <div class="order-status-title">
					<?= Loc::getMessage('GD_KIT_CABINET_ORDER_ORDER') ?> <?= $order->getId() ?>
                </div>
            </a>
            <div class="order-status-info">
                <div>
					<?= Loc::getMessage('GD_KIT_CABINET_ORDER_FROM') ?> <?= $order->getDate()->format("d.m.Y") ?>
                </div>
                <div>
                    <span><?= Loc::getMessage('GD_KIT_CABINET_ORDER_SUM') ?>: </span>
                    <span><?= $order->getPrice() ?></span>
                </div>
            </div>
            <div class="order-status-now order-status-<?= strtolower(key($order->getStatus())) ?>">
				<?= reset($order->getStatus()) ?>
            </div>
        </div>
		<?
	}
	if($arParams['G_ORDERS_PATH_TO_ORDERS'])
	{
		?>
        <div class="b2b-gadget b2b-gadget-orders">
            <div class="b2b-gadget-profile__link">
                <a href="<?php echo $arParams['G_ORDERS_PATH_TO_ORDERS']; ?>">
					<?= Loc::getMessage('GD_KIT_CABINET_ORDER_HISTORY') ?>
                </a>
            </div>
        </div>
		<?php
	}
}
?>
