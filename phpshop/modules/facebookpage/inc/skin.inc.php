<?php


class PHPShopFacebookpageElement extends PHPShopElements {

    function PHPShopFacebookpageElement() {
        $this->debug = false;
        parent::PHPShopElements();
        
        // ������
        $this->setAction(array('get'=>'facebookpage'));
        
    }

    
    function facebookpage() {
        $_SESSION['skin'] = $this->PHPShopSystem->getParam('skin');
        if($GLOBALS['SysValue']['nav']['path'] == 'order')
            $location = "/order/";
        else 
            $location = "/";
        header("Location: $location");
        die();
    }

}

// ����� 
new PHPShopFacebookpageElement();
?>