<?php

if (!defined("OBJENABLED"))
    require_once(dirname(__FILE__) . "/obj.class.php");

/**
 * ��������� ���������
 * @author PHPShop Software
 * @version 1.6
 * @package PHPShopObj
 */
class PHPShopSystem extends PHPShopObj {

    var $timezone = null;

    /**
     * �����������
     */
    function __construct() {
        $this->objID = 1;
        $this->install = false;
        $this->cache = false;
        $this->objBase = $GLOBALS['SysValue']['base']['system'];
        parent::__construct();

        // ��������� ����
        $this->setTimeZone();
    }

    /**
     * ��������� ��������� ���� ������� 
     */
    function setTimeZone() {
        $this->timezone = $this->getSerilizeParam("admoption.timezone");
        if (function_exists('date_default_timezone_set') and ! empty($this->timezone))
            date_default_timezone_set($this->timezone);
    }

    /**
     * ����� ����� �����
     * @return string
     */
    function getName() {
        return parent::getParam("name");
    }

    /**
     * ����� ���������������� �������� [param.val]
     * @param string $param
     * @return string
     */
    function getSerilizeParam($param) {
        $param = explode(".", $param);
        $val = parent::unserializeParam($param[0]);
        return $val[$param[1]];
    }

    /**
     * �������� ��� �������� ��������������� �������� [param.val]
     * @param string $param ��� ��������� 
     * @param mixed $value �������� ���������
     */
    function setSerilizeParam($param, $value) {
        $param = explode(".", $param);
        if (is_array($param)) {
            $val = parent::unserializeParam($param[0]);
            $val[$param[1]] = $value;
            $this->objRow[$param[0]] = serialize($val);
        }
    }

    /**
     * ��������� ���������������� �������� [param.val]
     * @param string $param ��� ����������
     * @param string $value �������� ����������
     * @return bool
     */
    function ifSerilizeParam($param, $value = false) {
        if (empty($value))
            $value = 1;
        if ($this->getSerilizeParam($param) == $value)
            return true;
    }

    /**
     * ����� �� ������ �� ��������� �� �����
     * @return int
     */
    function getDefaultValutaId() {
        return parent::getParam("dengi");
    }

    /**
     * ����� ����� ������ �� ���������
     * @return float
     */
    function getDefaultOrderValutaId() {
        return parent::getParam("kurs");
    }

    /**
     * ����� ����� ������ �� ���������
     * @param bool $order ������ � ������ (true)
     * @return float
     */
    function getDefaultValutaKurs($order = false) {
        if (!class_exists("phpshopvaluta"))
            parent::loadClass("phpshopvaluta");
        if ($order) {
            // �������� ������ �������
            if (defined("HostID"))
                $valuta_id = $_SESSION['valuta'];
            else
                $valuta_id = $this->getDefaultOrderValutaId();
        } else
            $valuta_id = $this->getDefaultValutaId();
        $PV = new PHPShopValuta($valuta_id);

        return $PV->getKurs();
    }

    /**
     * ����� ISO ������ �� ���������
     * @param bool $order ������ � ������ (true)
     * @return string
     */
    function getDefaultValutaIso($order = false) {
        if (!class_exists("phpshopvaluta"))
            parent::loadClass("valuta");
        if ($order) {

            // �������� ������ �������
            if (defined("HostID"))
                $valuta_id = $_SESSION['valuta'];
            else
                $valuta_id = $this->getDefaultOrderValutaId();
        } else
            $valuta_id = $this->getDefaultValutaId();
        $PV = new PHPShopValuta($valuta_id);

        return $PV->getIso();
    }

    /**
     * ����� ���� ������ �� ���������
     * @param bool $order ������ � ������ ������ � ������ ��� ������ (true)
     * @return string
     */
    function getDefaultValutaCode($order = false) {
        if (!class_exists("phpshopvaluta"))
            parent::loadClass("valuta");

        if ($order) {
            // �������� ������ �������
            if (defined("HostID"))
                $valuta_id = $_SESSION['valuta'];
            else
                $valuta_id = $this->getDefaultOrderValutaId();
        }
        elseif (isset($_SESSION['valuta']))
            $valuta_id = $_SESSION['valuta'];
        else
            $valuta_id = $this->getDefaultValutaId();

        $PV = new PHPShopValuta($valuta_id);
        return $PV->getCode();
    }

    /**
     * ����� ������ ������ �����
     * @return string
     */
    function getValutaIcon($order = false) {

        if ($this->getDefaultValutaIso($order) == 'RUR' or $this->getDefaultValutaIso($order) == "RUB")
            return '<span class=rubznak>p</span>';
        else
            return $this->getDefaultValutaCode($order);
    }

    /**
     * ����� �������� �����
     * @param bool $print ������� ��� �������
     * @return string
     */
    function getLogo($print = false) {
        $logo = parent::getParam("logo");

        if (!empty($print)) {
            $bank_logo = $this->getSerilizeParam("bank.org_logo");
            if (!empty($bank_logo))
                $logo = $bank_logo;
        }
        return $logo;
    }

    /**
     * ����� ������� �������� ������� �� ��
     * @return array
     */
    function getArray() {
        $array = $this->objRow;
        foreach ($array as $key => $v)
            if (is_string($key))
                $newArray[$key] = $v;
        return $newArray;
    }

    /**
     * ����� e-mail ��������������
     * @return string
     */
    function getEmail() {
        return parent::getParam('adminmail2');
    }

    /**
     * ��������� ����� SMTP
     * @param array $add �������������� ���������
     * @return array
     */
    function getMailOption($add = false) {

        if ($this->ifSerilizeParam('admoption.mail_smtp_enabled', 1)) {

            if ($this->ifSerilizeParam('admoption.mail_smtp_debug', 1))
                $mail_debug = 2;
            else
                $mail_debug = 0;

            $option = array(
                'smtp' => true,
                'host' => $this->getSerilizeParam('admoption.mail_smtp_host'),
                'port' => $this->getSerilizeParam('admoption.mail_smtp_port'),
                'debug' => $mail_debug,
                'auth' => $this->getSerilizeParam('admoption.mail_smtp_auth'),
                'user' => $this->getSerilizeParam('admoption.mail_smtp_user'),
                'password' => $this->getSerilizeParam('admoption.mail_smtp_pass'),
                'replyto' => $this->getSerilizeParam('admoption.mail_smtp_replyto')
            );
        } else
            $option = null;

        // �������������� ���������
        if (is_array($add)) {
            foreach ($add as $k => $v)
                $option[$k] = $v;
        }


        return $option;
    }

    public function getPriceColumn()
    {
        $column = 'price';
        if (defined("HostPrice") and HostPrice > 1) {
            $column .= HostPrice;
        }

        return $column;
    }
}

?>