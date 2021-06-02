<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if(Loader::includeModule('kit.cabinet') && Loader::includeModule('kit.reviews') && $idUser > 0)
{
	$limit = 1;
	$filter = array('ID_USER' => $idUser);
	if($arGadgetParams['CNT'] > 0)
	{
		$limit = $arGadgetParams['CNT'];
	}

	if($arGadgetParams['TYPE'] == 'MODERATED')
	{
		$filter['MODERATED'] = 'Y';
	}
	elseif($arGadgetParams['TYPE'] == 'NOT_MODERATED')
	{
		$filter['MODERATED'] = 'N';
	}


	$listReviews = new \Kit\Cabinet\Personal\Reviews();
	$listReviews->setLimit($limit);
	$listReviews->setFilter($filter);
	$listReviews->getReviews($arParams['G_REVIEWS_MAX_RATING']);

	foreach ($listReviews->getReviewsList() as $idReview => $review)
	{
		?>
		<div class="personal-container-reviews">
			<div class="personal-container-reviews-title">
				<a href="<?= $review->getElement()->getUrl() ?>"><?= $review->getElement()->getName() ?></a>
			</div>
			<div class="personal-container-reviews-rating">
				<div class="rating_selection"
					 style="width:<?= $review->getRatingProcent($arParams['G_REVIEWS_MAX_RATING']) ?>%"></div>
				<div class="rating_selection_white"></div>
			</div>
			<div class="personal-container-reviews-status">
				<span><?= $review->getDateCreate("d F Y, H:i") ?></span> |
				<span class="<?= ($review->isModerated() ? 'reviews-status-published' : 'reviews-status-unpublished') ?>">
					<?= ($review->isModerated() ? Loc::getMessage('KIT_CABINET_REVIEWS_MODERATED') :
						Loc::getMessage('KIT_CABINET_REVIEWS_NOT_MODERATED')) ?>
				</span>
			</div>
			<div class="personal-container-reviews-text">
				<?= $review->getText() ?>
			</div>
		</div>
		<?
	}
	if($arParams['G_REVIEWS_PATH_TO_REVIEWS'])
	{
		?>
		<div class="edge-block"></div>
		<div class="gdhtmlareachlink">
			<a href="<?=$arParams['G_REVIEWS_PATH_TO_REVIEWS']?>">
				<?=Loc::getMessage('KIT_CABINET_REVIEWS_ALL')?>
			</a>
		</div>
		<?
	}
}
?>
