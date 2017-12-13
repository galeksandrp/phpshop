<?php

/**
 * ������� ����� ��������� ������
 */
class AddToTemplateReturnCallElement extends PHPShopElements {

    var $debug = false;

    /**
     * �����������
     */
    function AddToTemplateReturnCallElement() {
        parent::PHPShopElements();
        $this->option();
    }

    /**
     * ���������
     */
    function option() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['returncall']['returncall_system']);
        $PHPShopOrm->debug = $this->debug;
        $this->option = $PHPShopOrm->select();
    }

    /**
     * ����� �����
     */
    function display() {

        // �������� ������
        $captcha = parseTemplateReturn($GLOBALS['SysValue']['templates']['returncall']['returncall_captcha_forma'], true);
        $this->set('returncall_captcha', $captcha);
        
        $forma = parseTemplateReturn($GLOBALS['SysValue']['templates']['returncall']['returncall_forma'], true);
        $this->set('leftMenuContent', $forma);
        $this->set('leftMenuName', $this->option['title']);

        // ���������� ������
        if (empty($this->option['windows']))
            $dis = $this->parseTemplate($this->getValue('templates.left_menu'));
        else {
            if (empty($this->option['enabled']))
                $dis = parseTemplateReturn($GLOBALS['SysValue']['templates']['returncall']['returncall_window_forma'], true);
            else {
                $this->set('leftMenuContent', parseTemplateReturn($GLOBALS['SysValue']['templates']['returncall']['returncall_window_forma'], true));
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

            default: $this->set('returncall', $dis);
        }
    }

}

// ��������� � ������ �������
if ($PHPShopNav->notPath('returncall')) {
    $AddToTemplateReturnCallElement = new AddToTemplateReturnCallElement();
    $AddToTemplateReturnCallElement->display();
}
?>