<?php

/**
 * ������� ������ ���������� ������� ��������� @showcase@
 */
class AddToTemplate extends PHPShopProductElements {

    var $debug = false;

    function AddToTemplate() {
        $this->objBase = $GLOBALS['SysValue']['base']['products'];
        parent::PHPShopProductElements();
    }

    function randMultibase() {

        $multi_cat = null;

        // ����������
        if ($this->PHPShopSystem->ifSerilizeParam('admoption.base_enabled')) {

            $where['servers'] = " REGEXP 'i" . $this->PHPShopSystem->getSerilizeParam('admoption.base_id') . "i'";
            $where['parent_to'] = " > 0";
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
            $PHPShopOrm->debug = $this->debug;
            $PHPShopOrm->cache = true;
            $data = $PHPShopOrm->select(array('id'), $where, false, array('limit' => 1), __CLASS__, __FUNCTION__);
            if (is_array($data)) {
                foreach ($data as $row) {
                    $multi_cat = '=' . $row['id'];
                }
            }

            return $multi_cat;
        }
    }

    function showcase() {

        // �������� �� ������
        if ($this->PHPShopNav->index()) {

            // ������ ������
            $template = 'product_showcase';
            $this->SysValue['templates']['product_showcase'] = 'element/' . $template . '.tpl';

            // ���������� ����� ��� ������ ������
            $cell = 1;

            // ���-�� ������� �� ��������
            $limit = 1;

            // �������� ������
            //$where['id']=$this->setramdom($limit);
            $where['spec'] = "='1'";
            $where['enabled'] = "='1'";

            $randMultibase = $this->randMultibase();
            if (!empty($randMultibase))
                $where['category'] = $randMultibase;

            $this->dataArray[] = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $limit));

            // ��������� � ������ ������ � ��������
            $this->product_grid($this->dataArray, $cell, $template, $line = false);

            // �������� � ���������� ������� � ��������
            $this->set('showcase', $this->compile());
        }
    }

}

// ��������� � ������ ������� ������ ���������� ������ � ������
$AddToTemplate = new AddToTemplate();
$AddToTemplate->showcase();
?>