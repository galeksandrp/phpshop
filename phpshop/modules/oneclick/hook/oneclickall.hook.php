<?php

/**
 * ������� ����� ��������� ������
 */
class AddToTemplateOneclickElementAll extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function __construct() {
        parent::__construct();
        $this->option();
    }

    /**
     * ���������
     */
    function option() {
        global $OneclickOption;

        // ������ ��������
        if (!$OneclickOption) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['oneclick']['oneclick_system']);
            $PHPShopOrm->debug = $this->debug;
            $OneclickOption = $this->option = $PHPShopOrm->select();
        }
        else $this->option = $OneclickOption;
    }

    /**
     * ����� �����
     */
    function display() {

        if ($this->option['display'] == 0)
            return true;

        $forma = PHPShopParser::file($GLOBALS['SysValue']['templates']['oneclick']['oneclick_forma'], true, false, true);
        $this->set('leftMenuContent', $forma);
        $this->set('leftMenuName', '������� �����');

        // ���������� ������
        if (empty($this->option['windows']))
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
        else {
            if (empty($this->option['enabled']))
                $dis = PHPShopParser::file($GLOBALS['SysValue']['templates']['oneclick']['oneclick_window_forma'], true, false, true);
            else {
                $this->set('leftMenuContent', PHPShopParser::file($GLOBALS['SysValue']['templates']['oneclick']['oneclick_window_forma'], true, false, true));
                $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
            }
        }


        // ��������� ���������� �������
        switch ($this->option['enabled']) {

            case 1:
                $this->set('leftMenu', $dis, true);
                break;

            case 2:
                $this->set('rightMenu', $dis, true);
                break;

            default: $this->set('oneclick', $dis);
        }
    }

}

function product_grid_mod_oneclick_hook($obj, $row) {
    $AddToTemplateOneclickElement = new AddToTemplateOneclickElementAll();
    $AddToTemplateOneclickElement->display($row);
    return true;
}

$addHandler = array
    (
    'product_grid' => 'product_grid_mod_oneclick_hook',
);
?>