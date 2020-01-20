<?php

/**
 * ���������� ������ �� ����
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopCore
 */
class PHPShopPricemail extends PHPShopShopCore {

    /**
     * �����������
     */
    function __construct() {

        // �������
        $this->debug = false;

        // ������ �������
        $this->action = array("nav" => "index", "post" => "send_price_link");
        parent::__construct();
    }

    /**
     * ����� �� ��������� 
     */
    function index() {

        if (PHPShopSecurity::true_num($this->PHPShopNav->getId()))
            $this->forma();
        else
            $this->setError404();
    }

    /**
     * �������� �����
     * @param array $option ��������� �������� [url|captcha|referer]
     * @return boolean
     */
    function security($option = array('url' => false, 'captcha' => true, 'referer' => true)) {
        global $PHPShopRecaptchaElement;

        return $PHPShopRecaptchaElement->security($option);
    }

    /**
     * ����� �������� ����� ��� ��������� $_POST[send_price_link]
     */
    function send_price_link() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST))
            return true;

        if ($this->security()) {
            $this->send();
            $this->set('Error', PHPShopText::alert(__("��������� ������� ����������"), 'success'));
        }
        else
            $this->set('Error', PHPShopText::alert(__("������ �����, ��������� ������� ����� �����")));
        $this->index();
    }

    /**
     * ����������� ������ �� ����� � ���������� � ��
     */
    function send() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, $_POST, 'START'))
            return true;

        if (PHPShopSecurity::true_param($_POST['mail'], $_POST['name_person'], $_POST['link_to_page'])) {

            // ��������� e-mail ������������
            $this->title_mail = __('��������� � ������� ����');

            $this->set('user_name', $_POST['name_person']);
            $this->set('user_org_name', $_POST['org_name']);
            $this->set('user_tel_code', $_POST['tel_code']);
            $this->set('user_tel', $_POST['tel_name']);
            $this->set('user_info', $_POST['adr_name']);
            $this->set('user_mail', $_POST['mail']);
            $this->set('link_to_page', $_POST['link_to_page']);

            // ������ �� ������
            $PHPShopProduct = new PHPShopProduct($this->PHPShopNav->getId());
            $this->set('product_name', $PHPShopProduct->getName());
            $this->set('product_art', $PHPShopProduct->getParam('uid'));
            $this->set('product_id', $this->PHPShopNav->getId());
            $this->set('product_link', $_SERVER['SERVER_NAME'] . "/shop/UID_" . $this->PHPShopNav->getId() . ".html");

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, $_POST, 'END');

            // ���������� e-mail ������������
            $content = ParseTemplateReturn('./phpshop/lib/templates/users/mail_pricemail.tpl', true);

            if (PHPShopSecurity::true_email($_POST['mail'])) {
                PHPShopObj::loadClass('mail');
                new PHPShopMail($this->PHPShopSystem->getEmail(), $this->PHPShopSystem->getEmail(), $this->title_mail, $content, true);
            }

            $this->redirect();
        }
    }

    /**
     * ������� �� �������� ������
     */
    function redirect() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__))
            return true;

        header("Location: ../shop/UID_" . $this->PHPShopNav->getId() . ".html?pricemail=done");
    }

    /**
     * ������
     * @param string $name ��� ���� � ������� ����� ��� ������
     * @return string
     */
    function currency($name = 'code') {

        if (isset($_SESSION['valuta']))
            $currency = $_SESSION['valuta'];
        else
            $currency = $this->PHPShopSystem->getParam('dengi');

        $PHPShopOrm = new PHPShopOrm($this->getValue('base.currency'));

        $row = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($currency)), false, array('limit' => 1), __FUNCTION__, array('base' => $this->getValue('base.currency'), 'cache' => 'true'));

        if ($name == 'code' and ($row['iso'] == 'RUR' or $row['iso'] == "RUB"))
            return 'p';

        return $row[$name];
    }

    /**
     * ���������� �����
     */
    function forma() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        $PHPShopProduct = new PHPShopProduct($this->PHPShopNav->getId());

        // ����������
        $PHPShopPromotions = new PHPShopPromotions();
        $promotions = $PHPShopPromotions->getPrice($PHPShopProduct->objRow);
        if (is_array($promotions)) {
            $this->set('productPrice', $promotions['price']);
            $this->set(array('productPriceRub', 'productPriceOld'), number_format($promotions['price_n'], $this->format, '.', ' ') . ' ' . $this->PHPShopSystem->getValutaIcon());
        } else {
            $this->set('productPrice', number_format($PHPShopProduct->getPrice(), $this->format, '.', ' '));
            
            if($PHPShopProduct->getPriceOld()>0)
            $this->set(array('productPriceRub', 'productPriceOld'), number_format($PHPShopProduct->getPriceOld(), $this->format, '.', ' ') . ' ' . $this->PHPShopSystem->getValutaIcon());
            else $this->set(array('productPriceRub', 'productPriceOld'), '');
        }

        $this->set('productName', $PHPShopProduct->getName());
        $this->set('productDes', $PHPShopProduct->getParam('description'));
        $this->set('productImg', $PHPShopProduct->getImage());
        $this->set('productUid', $this->PHPShopNav->getId());
        $this->set('productValutaName', $this->currency());

        // ������ ������������
        if (PHPShopSecurity::true_num($_SESSION['UsersId'])) {
            $PHPShopUsers = new PHPShopUser($_SESSION['UsersId']);
            $this->set('UserMail', $PHPShopUsers->getParam('mail'));
            $this->set('UserName', $PHPShopUsers->getParam('name'));
            $this->set('UserTel', $PHPShopUsers->getParam('tel'));
            $this->set('UserTelCode', $PHPShopUsers->getParam('tel_code'));
            $this->set('UserAdres', $PHPShopUsers->getParam('adres'));
            $this->set('UserComp', $PHPShopUsers->getParam('company'));
            $this->set('formaLock', 'readonly=1');
        }
        // ���������� ������ ��� ��������� �������� �����
        elseif (!empty($_POST['send_price_link'])) {
            $this->set('UserMail', $_POST['mail']);
            $this->set('UserName', $_POST['name_person']);
            $this->set('UserTel', $_POST['tel_name']);
            $this->set('UserTelCode', $_POST['tel_code']);
            $this->set('UserAdres', $_POST['adr_name']);
            $this->set('UserComp', $_POST['org_name']);
            $this->set('UserLink', $_POST['link_to_page']);
        }

        // ���������
        $this->title = $PHPShopProduct->getName() . ' - ' . __('������������ �� ����') . " - " . $this->PHPShopSystem->getName();
        $this->description = __('������������ �� ����') . ': ' . $PHPShopProduct->getName();
        $this->keywords = $PHPShopProduct->getName();

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $PHPShopProduct, 'END');

        // ������� ������ � ������
        $this->ParseTemplate($this->getValue('templates.pricemail_forma'));
    }

}

?>