<?php

/**
 * ���������� ����������� � ��
 * @author PHPShop Software
 * @version 1.8
 * @package PHPShopClass
 * @param string $iniPath ���� �� ����������������� ����� config.ini
 * @param bool $connectdb ����������� � MySQL
 * @param bool $error ���������� ������
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
     * ����� ������ �����������
     * @var string
     */
    var $mysql_error = null;

    /**
     * ����������� � ��
     * @param string $iniPath ���� �� ����������������� ����� config.ini
     * @param bool $connectdb ��������� � ��
     * @param bool $error ���������� ������ PHP
     */
    function __construct($iniPath, $connectdb = true, $error = true) {

        // ��������� ����
        $this->setTimeZone();

        // UTF-8 Fix
        $this->fixUTF();

        // ������� ����
        $this->setPHPCoreReporting($error);

        $this->iniPath = $iniPath;
        $this->SysValue = parse_ini_file_true($this->iniPath, 1);


        define('parser_function_allowed', $this->SysValue['function']['allowed']);
        define('parser_function_deny', $this->SysValue['function']['deny']);
        define('parser_function_guard', $this->SysValue['function']['guard']);

        $GLOBALS['SysValue'] = &$this->SysValue;

        if ($connectdb)
            $this->link_db = $this->connect($connectdb);
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

        $message = '<strong>' . $message . '</strong><br><em>������: ' . $error . '</em>';

        if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/install/') and $e != 105) {
            header('Location: /install/');
        }
        if (function_exists('ParseTemplateReturn')) {
            $GLOBALS['SysValue']['other']['message'] = $message;
            $GLOBALS['SysValue']['other']['title'] = $e;
            exit(ParseTemplateReturn('phpshop/lib/templates/error/error.tpl', true));
        } elseif (class_exists('PHPShopObj')) {
            PHPShopObj::loadClass('parser');
            PHPShopParser::set('message', $message);
            PHPShopParser::set('title', $e);
            exit(PHPShopParser::file($_SERVER['DOCUMENT_ROOT'] . '/phpshop/lib/templates/error/error.tpl'));
        }
        else
            exit($message);
    }

    /**
     * ���������� � �� MySQL
     * @param bool $connectdb ����������� / �������� �����������
     */
    function connect($connectdb = true) {
        global $link_db;

        $link_db = mysqli_connect($this->getParam("connect.host"), $this->getParam("connect.user_db"), $this->getParam("connect.pass_db")) or $this->mysql_error = mysqli_connect_error();
        mysqli_select_db($link_db, $this->getParam("connect.dbase")) or $this->mysql_error .= mysqli_error($link_db);
        mysqli_query($link_db, "SET NAMES '" . $this->codBase . "'");
        mysqli_query($link_db, "SET SESSION sql_mode=''");

        if ($connectdb and !empty($this->mysql_error))
            $this->errorConnect(101, "��� ���������� � �����", $this->mysql_error);
        else if (empty($this->mysql_error))
            return $link_db;
    }

    /**
     * �������� ���� ��������������
     */
    function chekAdmin() {

        // Portable PHP password hashing framework.
        require_once dirname(__FILE__) . '/../lib/phpass/passwordhash.php';

        PHPShopObj::loadClass('admrule');
        $this->Rule = new PHPShopAdminRule();
    }

    /**
     * ������ ���-�� ����� � �������
     * @param string $from_base ��� �������
     * @param string $query SQL ������
     * @return int
     */
    function getNumRows($from_base, $query) {
        $sql = "select COUNT('id') as count from " . $this->SysValue['base'][$from_base] . " " . $query;
        $result = mysqli_query($this->link_db, $sql);
        $row = @mysqli_fetch_array($result);
        $num = $row['count'];
        return intval($num);
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
     * UTF-8 Fix
     */
    function fixUTF() {

        //  UTF-8 Default Charset Fix
        if (stristr(ini_get("default_charset"), "utf") and function_exists('ini_set')) {
            ini_set("default_charset", "cp1251");
        }

        // UTF-8 Env Fix
        if (floatval(phpversion()) < 5.6) {
            if (ini_get("mbstring.func_overload") > 0 and function_exists('ini_set')) {
                ini_set("mbstring.internal_encoding", null);
            }
        }
    }

    /**
     *  ��������� ������ ���������� ���������
     */
    function setPHPCoreReporting($error) {
        if (function_exists('error_reporting')) {
            if (empty($error)) {
                error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
                if ($this->phpversion() and function_exists('ini_set')) {
                    ini_set('allow_call_time_pass_reference', 1);
                }
            }
            else
                error_reporting(0);

            // Short Open Tag 
            if (ini_get("short_open_tag") == 0) {
                ini_set('short_open_tag', 1);
            }
        }
    }

    /**
     * ����������� ������ PHP ��� ��������� PHP 5.4
     * @param float $version ������
     * @return boolean 
     */
    function phpversion($version = '5.3') {
        if ((phpversion() * 1) >= $version)
            return true;
    }

    /**
     * �������� ���������� ��� ������� ������
     * @param string $path ���� �� ����� � ���������
     */
    function checkMultibase($path = '../') {
        global $PHPShopSystem;

        $this->LicenseParse = @parse_ini_file_true($path .'license/'. PHPShopFile::searchFile($path.'license/', 'getLicense', true), 1);

        if (is_array( $this->LicenseParse) and strstr($this->LicenseParse['License']['HardwareLocked'], 'Showcase')) {

            if (getenv('SERVER_NAME') == $this->LicenseParse['License']['DomenLocked']) {
                define("HostMain", true);
            } else {
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['servers']);
                $PHPShopOrm->debug = false;
                $data = $PHPShopOrm->select(array('id,name,company'), array('enabled' => "='1'", 'host' => '="' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . '"'), false, array('limit' => 1));

                if (is_array($data)){
                    define("HostID", intval($data['id']));
                    
                    if($PHPShopSystem){
                        
                        if(!empty($data['company']))
                        $PHPShopSystem->setParam('company', $data['company']);
                        
                        if(!empty($data['name']))
                        $PHPShopSystem->setParam('name', $data['name']);
                    }
                }
            }
        }
    }

}

/**
 * ���������� ��������� INI ������
 * @param string $file INI ����
 * @param bool $process_sections [true/false] ����� ������������ �������
 * @return array
 */
function parse_ini_file_true($file, $process_sections) {
    if (function_exists('parse_ini_file'))
        return @parse_ini_file($file, $process_sections);
    elseif (is_file($file))
        return parse_ini_string(@file_get_contents($file), $process_sections);
}

?>