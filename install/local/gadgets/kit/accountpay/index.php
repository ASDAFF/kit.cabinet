<?


if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if (Loader::includeModule('kit.cabinet') && $idUser > 0)
{
	$APPLICATION->IncludeComponent(
		"bitrix:sale.personal.account",
		"kit_cabinet",
		Array(
			"SET_TITLE" => "N"
		),
		''
	);

	$APPLICATION->IncludeComponent(
		"bitrix:sale.account.pay",
		"kit_cabinet",
		Array(
			"REFRESHED_COMPONENT_MODE" => "Y",
			"ELIMINATED_PAY_SYSTEMS" => array("0"),
			"PATH_TO_BASKET" => $arParams['G_ACCOUNTPAY_PATH_TO_BASKET'],
			"PATH_TO_PAYMENT" => $arParams['G_ACCOUNTPAY_PATH_TO_PAYMENT'],
			"PERSON_TYPE" => $arParams['G_ACCOUNTPAY_PERSON_TYPE_ID'],
			"REDIRECT_TO_CURRENT_PAGE" => "N",
			"SELL_AMOUNT" => array(""),
			"SELL_CURRENCY" => '',
			"SELL_SHOW_FIXED_VALUES" => 'Y',
			"SELL_SHOW_RESULT_SUM" =>  '',
			"SELL_TOTAL" => array(""),
			"SELL_USER_INPUT" => 'Y',
			"SELL_VALUES_FROM_VAR" => "N",
			"SELL_VAR_PRICE_VALUE" => "",
			"SET_TITLE" => "N",
		),
		''
	);
}
?>
