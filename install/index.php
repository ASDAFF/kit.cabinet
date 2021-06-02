<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_client.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_client_partner.php');

class kit_cabinet extends CModule
{
    const MODULE_ID = 'kit.cabinet';
    var $MODULE_ID = 'kit.cabinet';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $_395436890 = '';

    function __construct()
    {
        $arModuleVersion = array();
        include(dirname(__FILE__) . '/version.php');
        $this->MODULE_VERSION = $arModuleVersion['VERSION'];
        $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        $this->MODULE_NAME = GetMessage('kit.cabinet_MODULE_NAME');
        $this->MODULE_DESCRIPTION = GetMessage('kit.cabinet_MODULE_DESC');
        $this->PARTNER_NAME = GetMessage('kit.cabinet_PARTNER_NAME');
        $this->PARTNER_URI = GetMessage('kit.cabinet_PARTNER_URI');
    }

    function DoInstall()
    {
        global $APPLICATION;
        $this->InstallFiles();
        $this->InstallEvents();
        $this->InstallDB();
        ModuleManager::registerModule(self::MODULE_ID);
    }

    function InstallFiles($_199605487 = array())
    {
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin', true);
        CopyDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/themes/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes/', true, true);
        if (is_dir($_1848142125 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/local')) {
            if ($_384493622 = opendir($_1848142125)) {
                while (false !== $_994241978 = readdir($_384493622)) {
                    if ($_994241978 == '..' || $_994241978 == '.') continue;
                    CopyDirFiles($_1848142125 . '/' . $_994241978, $_SERVER['DOCUMENT_ROOT'] . '/local/' . $_994241978, $_1828379914 = True, $_1177185337 = True);
                }
                closedir($_384493622);
            }
        }
        return true;
    }

    function InstallEvents()
    {
        return true;
    }

    function InstallDB($_199605487 = array())
    {
        global $DB, $APPLICATION;
        return true;
    }

    function DoUninstall()
    {
        global $APPLICATION;
        UnRegisterModule(self::MODULE_ID);
        $this->UnInstallDB();
        $this->UnInstallEvents();
        $this->UnInstallFiles();
    }

    function UnInstallDB($_199605487 = array())
    {
        global $DB, $APPLICATION;
        return true;
    }

    function UnInstallEvents()
    {
        return true;
    }

    function UnInstallFiles()
    {
        DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/admin', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin');
        DeleteDirFiles($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/themes/.default/icons/', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/themes/.default/icons');
        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER['DOCUMENT_ROOT'] . '/local/gadgets/kit/');
        if (is_dir($_1848142125 = $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . self::MODULE_ID . '/install/local/templates/.default/components/bitrix/')) {
            if ($_384493622 = opendir($_1848142125)) {
                while (false !== $_994241978 = readdir($_384493622)) {
                    if ($_994241978 == '..' || $_994241978 == '.' || !is_dir($_1796297443 = $_1848142125 . '/' . $_994241978)) continue;
                    $_1139210685 = opendir($_1796297443);
                    while (false !== $_359426658 = readdir($_1139210685)) {
                        if ($_359426658 == '..' || $_359426658 == '.') continue;
                        DeleteDirFilesEx('/local/templates/.default/components/bitrix/' . $_994241978 . '/' . $_359426658);
                    }
                    closedir($_1139210685);
                }
                closedir($_384493622);
            }
        }
        return true;
    }
}