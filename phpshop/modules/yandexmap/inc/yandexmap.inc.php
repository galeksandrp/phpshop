<?php

// Sape
class PHPShopYandexMapElement extends PHPShopElements {

    function PHPShopYandexMapElement() {
        $this->debug=false;
        $this->objBase=$GLOBALS['SysValue']['base']['yandexmap']['yandexmap_system'];
        parent::PHPShopElements();
    }

    // ����� ������
    function yandexmap($num=false) {
        $data = $this->PHPShopOrm->select();
        return $data['code'];
    }

}

// ����� 
$PHPShopYandexMapElement = new PHPShopYandexMapElement();
$PHPShopYandexMapElement->init('yandexmap');

?>