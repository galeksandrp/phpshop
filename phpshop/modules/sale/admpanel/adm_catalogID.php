<?php

function updateAllPrice(){
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $price = ($price + (($price * $LoadItems['System']['percent']) / 100));
    $pr=$_POST['mod_sale_price']/100;
    
    if(empty($_POST['mod_sale_old'])) $_POST['mod_sale_old']='0';
    
    $PHPShopOrm->sql='update '.$GLOBALS['SysValue']['base']['products'].' set 
    price_n='.$_POST['mod_sale_old'].',
    price=price'.$_POST['mod_sale_opt'].'(price*'.$pr.') 
    where category='.intval($_POST['catalogID']);
    $PHPShopOrm->update();
}


function addFieldSale($data) {
    global $PHPShopGUI;
    
    // ��������� �������� � ������� actionStart
    $sel_value[]=array('+','+',false);
    $sel_value[]=array('-','-', 'selected');
    $sel=$PHPShopGUI->setSelect('mod_sale_opt', $sel_value, 40);
    $Tab9=$PHPShopGUI->setField('����� ����',$PHPShopGUI->setInputText('�������� ���� � ����� ������ �������� �� '.$sel, 'mod_sale_price', "10",'30','%'));
   
    $sel_value2[]=array('��������',0, false);
    $sel_value2[]=array('��������� �������� ��������� ���� �� ���������','price','selected');
   
    $Tab9.=$PHPShopGUI->setField('������ ����',$PHPShopGUI->setSelect('mod_sale_old', $sel_value2, 300));
    
    $PHPShopGUI->addTab(array("����������",$Tab9,450));
}

$addHandler=array(
        'actionStart'=>'addFieldSale',
        'actionDelete'=>false,
        'actionUpdate'=>'updateAllPrice',
        'actionSave'=>false
);

?>