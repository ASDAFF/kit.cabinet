<?


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arParameters = Array(
	"PARAMETERS" => Array(
		"PATH_TO_BLANK" => array(
			"NAME" => GetMessage("GD_KIT_CABINET_PATH_TO_BLANK"),
			"TYPE" => "STRING",
			"DEFAULT" => "/personal/blank_zakaza/"
		),
		'INIT_JQUERY' => array(
			"NAME" => GetMessage("GD_KIT_CABINET_INIT_JQUERY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N"
		),
	)
);
?>
