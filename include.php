<?php
class KitCabinet
{
    const idModule = 'kit.cabinet';
    static private $_2080371640 = null;
    static private $_963467704;
    protected $_1150848363 = true;
    protected $_1801519237 = array();

    private function __construct()
    {
        self::$_963467704 = \Bitrix\Main\Loader::includeSharewareModule("kit.cabinet");
    }

    static function getInstance()
    {
        if (self::$_2080371640 == null) {
            self::$_2080371640 = new self();
        }
        return self::$_2080371640;
    }

    public function isSuccess()
    {
        return $this->_1150848363;
    }

    public function setSuccess($_1150848363)
    {
        $this->_1150848363 = $_1150848363;
    }

    public function getErrors()
    {
        return $this->_1801519237;
    }

    public function setErrors($_1801519237)
    {
        $this->_1801519237 = $_1801519237;
    }

    protected function checkInstalledModules($_1474106308 = array())
    {
        $_1655791671 = true;
        if (!is_array($_1474106308)) {
            $_1474106308 = array($_1474106308);
        }
        $_797778933 = count($_1474106308);
        if ($_797778933 > 0) {
            for ($_752507228 = 0; $_752507228 < $_797778933; ++$_752507228) {
                if (!\Bitrix\Main\Loader::includeModule($_1474106308[$_752507228])) {
                    $_1655791671 = false;
                    break;
                }
            }
        }
        return $_1655791671;
    }

    private function __clone()
    {
    }
}