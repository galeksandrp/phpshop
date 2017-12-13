<?php

if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

class PHPShopRulepartner extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopRulepartner() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['partner']['partner_system'];
        $this->debug = false;
        parent::PHPShopCore();

        // ��������� ������� ������
        $this->navigation(null, '����������� ���������');
    }

    function index() {

        $PHPShopOrm = new PHPShopOrm($this->objBase);
        $data = $PHPShopOrm->select(array('percent,rule'));

        // ���������� ����������
        $this->set('partnerPercent', $data['percent']);
        $this->set('pageContent', Parser($data['rule']));
        $this->set('pageTitle', $GLOBALS['SysValue']['lang']['partner_rule_title']);

        // ����
        $this->title = "������� �������� - ����������� ������ - " . $this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

}

?>
