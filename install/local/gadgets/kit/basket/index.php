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
	$Items = new \Kit\Cabinet\Shop\BasketItems(array(
		'CAN_BUY' => 'Y',
		'DELAY' => 'N',
		'SUBSCRIBE' => 'N'
	), array(
		'width' => 70,
		'height' => 70,
		'resize' => BX_RESIZE_IMAGE_PROPORTIONAL,
		'noPhoto' => '/upload/no_photo_small.jpg'
	));

	?>
	<div class="gdsetcartinfo">
		<span><?= $Items->getQnt() ?></span>
		<span><?= \Kit\Cabinet\Element::num2word(
				$Items->getQnt(),
				array(
					Loc::getMessage('GD_KIT_CABINET_BASKET_PRODUCTS_1'),
					Loc::getMessage('GD_KIT_CABINET_BASKET_PRODUCTS_2'),
					Loc::getMessage('GD_KIT_CABINET_BASKET_PRODUCTS_3')
				));
			?></span>
		<span><?= $Items->getSum() ?></span>
	</div>
	<div class="gdsetcartinfo-img">
		<?php
		foreach ($Items->getItems() as $item)
		{
			$img = $item->getElement()->getImg();
			?>
			<a href="<?=$item->getElement()->getUrl()?>" title="<?=$item->getElement()->getName()?>">
				<div class="block-cart-img" style="background-image: url('<?= $img['src'] ?>');">
				</div>
			</a>
			<?
		}
		?>
	</div>
	<?php
	if($arParams['G_BASKET_PATH_TO_BASKET'])
	{
		?>
		<div class="gdhtmlareachlink">
			<a href="<?= $arParams['G_BASKET_PATH_TO_BASKET'] ?>">
				<?= Loc::getMessage('GD_KIT_CABINET_BASKET_MORE') ?>
			</a>
		</div>
		<?
	}
}
?>
