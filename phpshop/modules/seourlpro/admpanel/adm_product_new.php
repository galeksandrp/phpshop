<?php

function addSeoUrl($data) {
    global $PHPShopGUI;

     // ����������� ������
     if(!empty($_GET['id']))
     $data['prod_seo_name']=null;
     
     $Tab3 = $PHPShopGUI->setField("SEO ������:", $PHPShopGUI->setInput("text", "prod_seo_name_new", $data['prod_seo_name'], "left", false,false,false,false,'/id/','-'.$data['id'].'.html'), 1, '����� ������������ ��������� ������ /sony/plazma/televizor');
    
    $PHPShopGUI->addTab(array("SEO",$Tab3,450));
}


$addHandler=array(
        'actionStart'=>'addSeoUrl',
        'actionDelete'=>false,
        'actionUpdate'=>false
);

?>