<?php
/**
 * ������� ������ ���������� ������� ��������� @showcase@
 */
class AddToTemplate extends PHPShopProductElements {
    var $debug=false;

    function AddToTemplate() {
        $this->objBase=$GLOBALS['SysValue']['base']['products'];
        parent::PHPShopProductElements();
    }

    function showcase() {

        // ������ ������
        $template='main_spec_forma_icon';

        // ���������� ����� ��� ������ ������
        $cell=2;

        // ���-�� ������� �� ��������
        $limit=2;

        // �������� ������
        $where['id']=$this->setramdom($limit);
        $where['spec']="='1'";
        $where['enabled']="='1'";

        $this->dataArray=$this->select(array('*'),$where,array('order'=>'RAND()'),array('limit'=>$limit));

        // ��������� � ������ ������ � ��������
        $this->product_grid($this->dataArray,$cell,$template,$line=false);

        // �������� � ���������� ������� � ��������
        $this->set('showcase',$this->compile());
    }
}


// ��������� � ������ ������� ������ ���������� ������ � ������
$AddToTemplate = new AddToTemplate();
$AddToTemplate->showcase();
?>