<?php
/**
 * ���������� ������ �� ���������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */

if (!defined("OBJENABLED")) {
    require_once(dirname(__FILE__)."/obj.class.php");
    require_once(dirname(__FILE__)."/array.class.php");
}

/**
 * ������ ��������� �������
 * ���������� ������ � �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopArray
 */
class PHPShopPageCategoryArray extends PHPShopArray {

    function PHPShopPageCategoryArray() {
        $this->objBase=$GLOBALS['SysValue']['base']['page_categories'];
        $this->order=array('order'=>'num');
        parent::PHPShopArray("id","name","parent_to");
    }
}

?>