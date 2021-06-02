<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$types = array(
	'ALL' => GetMessage("GD_KIT_CABINET_REVIEWS_ALL"),
	'MODERATED' => GetMessage("GD_KIT_CABINET_REVIEWS_MODERATED"),
	'NOT_MODERATED' => GetMessage("GD_KIT_CABINET_REVIEWS_NOT_MODERATED"),
);
$arParameters = Array(
	"PARAMETERS" => Array(
		"MAX_RATING" => array(
			"NAME" => GetMessage("GD_KIT_CABINET_REVIEWS_MAX_RATING"),
			"TYPE" => "STRING",
			"DEFAULT" => "5"
		),
		"PATH_TO_REVIEWS" => array(
			"NAME" => GetMessage("GD_KIT_CABINET_REVIEWS_PATH_TO_REVIEWS"),
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/reviews/"
		),
	),
	'USER_PARAMETERS' => Array(
		"CNT" => array(
			"NAME" => GetMessage("GD_KIT_CABINET_REVIEWS_CNT"),
			"TYPE" => "LIST",
			"DEFAULT" => "1",
			"VALUES" => array(
					1 => 1, 
					2 => 2,
					3 => 3,
					4 => 4,
					5 => 5
			)
		),
		"TYPE" => array(
			"NAME" => GetMessage("GD_KIT_CABINET_REVIEWS_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $types
		),
	),
);