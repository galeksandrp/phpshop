<?php
if (!defined("OBJENABLED")) define("OBJENABLED", dirname(__FILE__));

/**
 * ������������ ����� �������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopClass
 */
class PHPShopObj {
    /**
     * �� ������� � ��
     * @var int 
     */
    var $objID;
    /**
     * ��� ��
     * @var string 
     */
    var $objBase;
    /**
     * ������ ������
     * @var array 
     */
    var $objRow;
    /**
     * ����� �������
     * @var bool 
     */
    var $debug=false;
    /**
     * �������� ���������
     * @var bool 
     */
    var $install=true;
    /**
     * ����� �����������
     * @var bool
     */
    var $cache=false;
    /**
     * �������������� ����
     * @var array
     */
    var $cache_format=array();

    /**
     * �����������
     * @var var ���� �������, �� ��������� id
     */
    function PHPShopObj($var='id') {
        $this->setRow($var);
    }
    /**
     * ������ � ��
     * @var var ���� �������, �� ��������� id
     */
    function setRow($var) {
        $this->loadClass("orm");
        $PHPShopOrm = &new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug=$this->debug;
        $PHPShopOrm->cache=$this->cache;
        $PHPShopOrm->cache_format=$this->cache_format;
        $PHPShopOrm->install=$this->install;
        $this->objRow = $PHPShopOrm->select(array('*'),array($var=>'="'.$this->objID.'"'),false,array('limit'=>1));
    }

    /**
     * ��������� ��������� �� �������
     * @param string $paramName ��� ����������
     * @param string $paramValue �������� ����������
     * @return bool
     */
    function ifValue($paramName,$paramValue=false) {
        if(empty($paramValue)) $paramValue=1;
        if(!empty($this->objRow[$paramName]))
            if($this->objRow[$paramName] == $paramValue) return true;
    }

    /**
     * ������ ��������� �� ������� �� �����
     * @param string $paramName ����
     * @return mixed
     */
    function getParam($paramName) {
        if(!empty($this->objRow[$paramName]))
        return $this->objRow[$paramName];
    }
    /**
     * ������ ��������� �� ������� �� �����, ����� ������� getParam($paramName)
     * @param string $paramName ����
     * @return mixed
     */
    function getValue($paramName) {
        if(!empty($this->objRow[$paramName]))
        return $this->objRow[$paramName];
    }

    /**
     * ������ ������� �������� �������
     * @return array
     */
    function getArray() {
        return $this->objRow;
    }

    /**
     * �������� ������
     * @param string $class_name ��� ������, �������� config.ini
     */
    function loadClass($class_name) {
        $class_path=OBJENABLED."/".$class_name.".class.php";
        if(file_exists($class_path)) require_once($class_path);
        else echo "��� ����� ".$class_path;
    }

    /**
     * ������ ������������������ ��������
     * @param string $paramName ��� ���������
     * @return <type>
     */
    function unserializeParam($paramName) {
        return unserialize($this->getParam($paramName));
    }

    /**
     * �������� ������ ������� ���� ��� ������������
     * @param string $class_name ��� ������, �������� config.ini
     */
    function importCore($class_name) {
        global $_classPath;
        $class_path=$_classPath.'/core/'.$class_name.".core.php";
        if(file_exists($class_path)) require_once($class_path);
        else echo "��� ����� ".$class_path;
    }
}
?>