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

        // �������� �� ������
        if($this->PHPShopNav->index()) {

            // ������ ������
            $template='product_showcase';
            $this->SysValue['templates']['product_showcase']='element/'.$template.'.tpl';

            // ���������� ����� ��� ������ ������
            $cell=1;

            // ���-�� ������� �� ��������
            $limit=1;

            // �������� ������
            //$where['id']=$this->setramdom($limit);
            $where['spec']="='1'";
            $where['enabled']="='1'";

            $this->dataArray[]=$this->select(array('*'),$where,array('order'=>'RAND()'),array('limit'=>$limit));

            // ��������� � ������ ������ � ��������
            $this->product_grid($this->dataArray,$cell,$template,$line=false);

            // �������� � ���������� ������� � ��������
            $this->set('showcase',$this->compile());
        }
    }
}


// ��������� � ������ ������� ������ ���������� ������ � ������
$AddToTemplate = new AddToTemplate();
$AddToTemplate->showcase();
?>