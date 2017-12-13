<?php

/**
 * ������� ����� ����� � ���
 */
class AddToTemplateChatElement extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function AddToTemplateChatElement() {
        parent::PHPShopElements();
        $this->option();
    }

    /**
     * ���������
     */
    function option() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['chat']['chat_system']);
        $PHPShopOrm->debug = $this->debug;
        $this->option = $PHPShopOrm->select();
    }

    /**
     * ����� �����
     */
    function display() {

        $forma = parseTemplateReturn($GLOBALS['SysValue']['templates']['chat']['chat_forma'], true);
        $this->set('leftMenuContent', $forma);
        $this->set('leftMenuName', $this->option['title']);

        // ���������� ������
        $dis = $this->parseTemplate($this->getValue('templates.left_menu'));


        // ��������� ���������� �������
        //if ($this->option['operator'] == 1)
            switch ($this->option['enabled']) {

                case 1:
                    $this->set('leftMenu', $dis, true);
                    break;

                case 2:
                    $this->set('rightMenu', $dis, true);
                    break;

                default: $this->set('chat', $dis);
            }
    }

}

// ��������� � ������ �������
$AddToTemplateChatElement = new AddToTemplateChatElement();
$AddToTemplateChatElement->display();
?>