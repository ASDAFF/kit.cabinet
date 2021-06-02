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
	$discount = new \Kit\Cabinet\Shop\Discount(
		array('ID' => $arParams['G_DISCOUNT_ID_DISCOUNT'])
	);
	?>
	<div class="gdset-sale-img">
		<img src="<?=$arGadget['PATH_SITEROOT']?>/img/gift.png">
	</div>

	<div clas="gdset-sale-info">
		<div class="gdset-sale-info-title">
			<span>
				<?=$discount->getName()?>
			</span>
		</div>
		<div class="gdset-sale-info-description">
			<span>
				<?=$discount->getDescription()?>
			</span>
		</div>
		<?
		if($arParams['G_DISCOUNT_PATH_TO_PAGE'])
		{
			?>
			<div class="gdhtmlareachlink">
				<a href="/sale/">
					<?=Loc::getMessage('GD_KIT_CABINET_DISCOUNT_MORE')?>
				</a>
			</div>
			<?
		}
		?>
	</div>
	<?
}
?>