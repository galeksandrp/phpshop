<?php
if (!defined("OBJENABLED")) define("OBJENABLED", dirname(__FILE__));

/**
 * ������������ ����� �������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */
class PHPShopObj {
    /**
     * @var int �� ������� � ��
     */
    var $objID;
    /**
     * @var string ��� ��
     */
    var $objBase;
    /**
     * @var array ������ ������
     */
    var $objRow;
    /**
     * @var bool ����� �������
     */
    var $debug=false;
    /**
     * @var bool �������� ���������
     */
    var $install=true;
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
        $PHPShopOrm->install=$this->install;
        $this->objRow = $PHPShopOrm->select(array('*'),array($var=>'='.$this->objID),false,array('limit'=>1));
    }

    /**
     * ������ ��������� �� ������� �� �����
     * @param string $paramName ����
     * @return mixed
     */
    function getParam($paramName) {
        return $this->objRow[$paramName];
    }
    /**
     * ������ ��������� �� ������� �� �����, ����� ������� getParam($paramName)
     * @param string $paramName ����
     * @return mixed
     */
    function getValue($paramName) {
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
}
?>