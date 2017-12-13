<?php

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__) . "/obj.class.php");
}

/**
 * ���������� ������ ���������������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopObj
 */
class PHPShopUser extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ������������
     */
    function PHPShopUser($objID) {
        $this->objID = $objID;
        $this->cache = true;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name27'];
        parent::PHPShopObj();
    }

    /**
     * ����� ������ �� �����
     * @param string $str ����
     * @return string 
     */
    function getParam($str) {
        return str_replace("\"", "&quot;", parent::getParam($str));
    }

    /**
     * ����� ������ ������� ������������ ��� ������
     * @return string 
     */
    function getAdresList() {
        $data_adres = unserialize(parent::getParam('data_adres'));
        if (!is_array($data_adres) OR !count($data_adres['list']))
            return "";

        foreach ($data_adres['list'] as $index => $data_adres_one) {
            $dis = "";
            foreach ($data_adres_one as $key => $value) {
                if ($value)
                    $dis .= " ," . $value;
            }
            if ($dis) {
                if ($index == $data_adres['main'])
                    $sel = 'selected="selected"';
                else
                    $sel = "";
                $disp .= '<option value="' . $index . '" ' . $sel . '>' . substr($dis, 2) . '</option>';
            }
        }
        if ($disp)
            $disp = '
                <h2>������� ����� ��������</h2>    
                <select name="adres_id" id="adres_id" style="margin-bottom: 15px;" size="5">
                <option value="none">������� ����� �����</option>
                ' . $disp . '
                </select><br>
                <input type="checkbox" name="adres_this_default" value="1">  ������� ��������� ������� ������� �� ���������
                <input type="hidden" class="adresListJson" value=\'' . PHPShopString::json_safe_encode($data_adres['list']) . '\'>
                ';
        return $disp;
    }

    /**
     * ����� ������ �� �����
     * @param string $str ����
     * @return string 
     */
    function getValue($str) {
        return $this->getParam($str);
    }

    /**
     * ����� ����� ������������
     * @return string
     */
    function getName() {
        return $this->getParam("name");
    }

    /**
     * ����� ID �������
     * @return int 
     */
    function getStatus() {
        return $this->getParam("status");
    }

    /**
     * ����� �������� �������
     * @return string 
     */
    function getStatusName() {
        $PHPShopUserStatus = new PHPShopUserStatus($this->getStatus());
        return $PHPShopUserStatus->getParam("name");
    }

    /**
     * ����� ������� ������
     * @return float 
     */
    function getDiscount() {
        $PHPShopUserStatus = new PHPShopUserStatus($this->getStatus());
        return $PHPShopUserStatus->getDiscount();
    }

}

/**
 * ���������� ������ �������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopObj
 */
class PHPShopUserStatus extends PHPShopObj {

    /**
     * �����������
     * @param Int $objID �� ������� ������������
     * @param array $import_data ������ ������� ������
     */
    function PHPShopUserStatus($objID, $import_data = null) {
        $this->objID = $objID;
        $this->cache = true;
        $this->objBase = $GLOBALS['SysValue']['base']['table_name28'];
        parent::PHPShopObj('id', $import_data);
    }

    /**
     * ����� ������� ������ � ������������
     * @return int
     */
    function getPrice() {
        return parent::getParam("price");
    }

    /**
     * ����� ������ � ������������
     * @return float
     */
    function getDiscount() {
        return parent::getParam("discount");
    }

}

/**
 * ���������� ������� ��� �������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopUserFunction {

    /**
     * �������� ��������� ������ � ������������
     * @param float $mysum ��������� ������
     * @return array
     */
    function ChekDiscount($mysum) {
        global $PHPShopSystem;

        $maxsum = 0;
        $userdiscount = 0;
        $maxdiscount = 0;

        $sql = "select * from " . $GLOBALS['SysValue']['base']['table_name23'] . " where sum < '$mysum' and enabled='1'";
        $result = mysql_query($sql);
        while ($row = mysql_fetch_array($result)) {
            $sum = $row['sum'];
            if ($sum > $maxsum) {
                $maxsum = $sum;
                $maxdiscount = $row['discount'];
            }
        }

        if (!empty($_SESSION['UsersStatus'])) {
            $PHPShopUserStatus = new PHPShopUserStatus($_SESSION['UsersStatus']);
            $userdiscount = $PHPShopUserStatus->getDiscount();
        }
        else
            $userdiscoun = 0;

        if ($userdiscount > $maxdiscount)
            $maxdiscount = $userdiscount;

        $sum = $mysum - ($mysum * @$maxdiscount / 100);
        $format = $PHPShopSystem->getSerilizeParam("admoption.price_znak");
        $array = array(0 + @$maxdiscount, number_format($sum, $format, ".", ""));

        return $array;
    }

}

?>