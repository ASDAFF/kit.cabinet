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
	$user = new \Kit\Cabinet\Personal\User($idUser);
	$avatar = $user->genAvatar(array(
		'width' => 85,
		'height' => 85,
		'resize' => BX_RESIZE_IMAGE_EXACT
	));
	?>
	<div class="b2b-gadget b2b-gadget-profile">
		<div class="b2b-gadget-profile__avatar">
			<div class="b2b-gadget-profile__img">
				<div class="img_block_avatar">
					<?
					if ($avatar['src'])
					{
						?>
						<img src="<?= $avatar['src'] ?>" width="<?= $avatar['width'] ?>"
							 height="<?= $avatar['height'] ?>">
						<?
					}
					?>
				</div>
			</div>
		</div>
		<div class="b2b-gadget-profile__data">
			<div class="b2b-gadget-profile__title"><?php echo $user->getFIO(); ?></div>
			<div class="b2b-gadget-profile__props">
				<?php
				if (strlen($user->getEmail()) > 0)
				{
					?>
					<div class="b2b-gadget-profile__prop">
						<div class="b2b-gadget-profile__propName">
							<?php echo Loc::getMessage('GD_KIT_CABINET_EMAIL'); ?>
						</div>
						<div class="b2b-gadget-profile__propValue">
							<?php echo $user->getEmail(); ?>
						</div>
					</div>
					<?php
				}
				if (strlen($user->getPersonalPhone()) > 0)
				{
					?>
					<div class="b2b-gadget-profile__prop">
						<div class="b2b-gadget-profile__propName">
							<?=Loc::getMessage('GD_KIT_CABINET_PHONE')?>
						</div>
						<div class="b2b-gadget-profile__propValue">
							<?=$user->getPersonalPhone()?>
						</div>
					</div>
					<?php
				} ?>
			</div>
			<div class="b2b-gadget-profile__link">
				<a href="<?=$arParams['G_PROFILE_PATH_TO_PROFILE']?>">
					<?=Loc::getMessage('GD_KIT_CABINET_CHANGE')?>
				</a>
			</div>
		</div>
	</div>
	<?php
}
?>
