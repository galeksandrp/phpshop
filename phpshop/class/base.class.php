<?php

/**
 * ���������� ����������� � ��
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 * @param string $iniPath ���� �� ����������������� ����� config.ini
 */
class PHPShopBase {

    /**
     * ���� �� ����������������� ����� config.ini
     * @var string 
     */
    var $iniPath;

    /**
     * ������ ������ �������� ����������������� ����� config.ini
     * @var array 
     */
    var $SysValue;

    /**
     * ��������� MySQL (������� cp1251)
     * @var string
     */
    var $codBase = "cp1251";

    /**
     * ��������� ������ ������� (������� cp1251)
     * @var string 
     */
    var $locale = 'ru_RU.cp1251';

    /**
     * ��������� ���� (������ Europe/Moscow)
     * @var string 
     */
    var $timezone = 'Europe/Moscow';

    /**
     * ����� �������
     * @var bool 
     */
    var $debug = true;

    /**
     * ����������� � ��
     * @param string $iniPath ���� �� ����������������� ����� config.ini
     */
    function PHPShopBase($iniPath, $connectdb = true) {

        // ��������� ����
        $this->setTimeZone();

        // ������� ����
        $this->setPHPCoreReporting();

        $this->iniPath = $iniPath;
        $this->SysValue = parse_ini_file($this->iniPath, 1);
        $GLOBALS['SysValue'] = &$this->SysValue;

        if (!empty($connectdb))
            $this->connect();
    }

    /**
     * ������ ��������� ���������� �������
     * @return array
     */
    function getSysValue() {
        return $this->SysValue;
    }

    /**
     * ������ ��������� ���������� �������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->getParam('base.table_name');
     * </code>
     * @param mixed $param ��� ���������
     * @return string
     */
    function getParam($param) {
        $param = explode(".", $param);
        if (count($param) > 2)
            return $this->SysValue[$param[0]][$param[1]][$param[2]];
        return $this->SysValue[$param[0]][$param[1]];
    }

    /**
     * �������� ��������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->setParam('base.table_name','mybase');
     * </code>
     * @param string $param ��� ���������
     * @param mixed $value �������� ���������
     */
    function setParam($param, $value) {
        $param = explode(".", $param);
        if ($param[0] == "var")
            $param[0] = "other";
        $GLOBALS['SysValue'][$param[0]][$param[1]] = $value;
    }

    /**
     * ����� ��������� �� ������
     * @param int $e ����� ���������� ������
     * @param string $message ����� ���������
     * @param string $error ����� ������
     */
    function errorConnect($e = false, $message = "��� ���������� � �����", $error = false) {
        echo "<strong>$message</strong> ( <a href='http://www.phpshop.ru/help/Content/install/phpshop.html#6' target='_blank'>Error $e</a> )<br>";
        echo "<em>������: " . $error . mysql_error() . "</em>";

        if (is_dir('./install/'))
            echo '<script>window.open("./install/");</script>';
        else
            echo '<script>window.open("http://www.phpshop.ru/help/Content/install/phpshop.html#6");</script>';
        exit();
    }

    /**
     * ���������� � �� MySQL
     */
    function connect() {
        $SysValue = $this->SysValue;
        @mysql_connect($this->getParam("connect.host"), $this->getParam("connect.user_db"), $this->getParam("connect.pass_db")) or die($this->errorConnect(101));
        mysql_select_db($SysValue['connect']['dbase']) or die($this->errorConnect(102));
        mysql_query("SET NAMES '" . $this->codBase . "'");
    }

    /**
     * �������� ���� ��������������
     * @param bool $require �������� ������������ �����
     */
    function chekAdmin($require = true) {
        global $UserChek, $UserStatus;
        $adminPath = explode("../", $this->iniPath);
        $aPath=null;
        $i = 2;
        while (count($adminPath) > $i) {
            $aPath.="../";
            $i++;
        }
        $loadPath = $aPath . "enter_to_admin.php";
        if ($require) {
            require_once($loadPath);
            PHPShopObj::loadClass('admrule');
            $this->Rule = new PHPShopAdminRule();
        }
        else
            return $loadPath;
    }

    /**
     * ������ ���-�� ����� � �������
     * @param string $from_base ��� �������
     * @param string $query SQL ������
     * @return int
     */
    function getNumRows($from_base, $query) {
        $num = 0;
        $sql = "select COUNT('id') as count from " . $this->SysValue['base'][$from_base] . " " . $query;
        $result = mysql_query($sql);
        $row = mysql_fetch_array(@$result);
        $num = $row['count'];
        return $num;
    }

    /**
     * ��������� ������ ������� 
     */
    function setLocale() {
        if (function_exists('setlocale') and !empty($this->locale))
            setlocale(LC_ALL, $this->locale);
    }

    /**
     * ��������� ��������� ���� ������� 
     */
    function setTimeZone() {
        if (function_exists('date_default_timezone_set') and !empty($this->timezone))
            date_default_timezone_set($this->timezone);
    }

    /**
     *  ��������� ������ ���������� ���������
     */
    function setPHPCoreReporting() {
        if (function_exists('error_reporting')) {
            if ($this->phpversion('5.0')){
                error_reporting('E_ALL & ~E_NOTICE & ~E_DEPRECATED');
                if ($this->phpversion() and function_exists('ini_set')){
                ini_set('allow_call_time_pass_reference',1);
                }
            }
            else
                error_reporting('E_ALL & ~E_NOTICE');
        }
    }
    
    /**
     * ����������� ������ PHP ��� ��������� PHP 5.4
     * @param float $version ������
     * @return boolean 
     */
    function phpversion($version='5.3'){
        if ((phpversion() * 1) >= $version)
            return true;
    }

}

?>