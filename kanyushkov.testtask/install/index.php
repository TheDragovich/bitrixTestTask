<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

class kanyushkov_testtask extends CModule {

    var $MODULE_ID = "kanyushkov.testtask";
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $PARTNER_NAME;
    var $PARTNER_URI;

    function kanyushkov_testtask() {
        self::__construct();
    }

    function __construct() {
        $arModuleVersion = [];
        include __DIR__ . "/version.php";
        $this->MODULE_NAME = Loc::getMessage("NK_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::getMessage("NK_MODULE_DESCRIPTION");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        $this->PARTNER_NAME = Loc::GetMessage("NK_PARTNER_NAME");
        $this->PARTNER_URI = Loc::GetMessage("NK_PARTNER_URI");
    }

    function DoInstall() {
        self::InstallFiles();
        ModuleManager::RegisterModule($this->MODULE_ID);
    }

    function DoUninstall() {
        self::UnInstallFiles();
        ModuleManager::UnRegisterModule($this->MODULE_ID);
    }

    function InstallFiles() {
        CopyDirFiles(
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . $this->MODULE_ID . '/install/components/',
            $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/',
            true, true
        );
        return true;
    }

    function UnInstallFiles() {
        DeleteDirFilesEx('/bitrix/components/kanyushkov/');
        return true;
    }
}