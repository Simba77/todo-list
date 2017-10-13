<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();


use Bitrix\Main\ModuleManager;

if (class_exists('simba_projects')) {
    return;
}

class simba_projects extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'simba.projects';
        $this->MODULE_VERSION = '1.0.0';
        $this->MODULE_VERSION_DATE = '2017-10-13 00:00:01';
        $this->MODULE_NAME = 'Управление проектами';
        $this->MODULE_DESCRIPTION = 'Модуль для ведения списка задач и проектов';
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Simba";
        $this->PARTNER_URI = "https://symbos.su";
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    public function installDB()
    {

    }

    public function uninstallDB()
    {

    }
}
