<?php

// ��������� ������
PHPShopObj::loadClass("array");

class PHPShopNextPayArray extends PHPShopArray {
    function __construct() {
        $this->objType=3;
        $this->objBase=$GLOBALS['SysValue']['base']['nextpay']['nextpay_system'];
        parent::__construct("status","title",'title_sub','merchant_key','merchant_skey');
    }
}

?>
