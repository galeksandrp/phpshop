<?php
 
/**
 * ��������� ����� ������ ������������� �������
 */
function product_grid_phpshopshopcore_multilanguages($obj,$row,$rout){
    
    if($_SESSION['lang_prefix']!='') {
        //���� ���� ������� ��������� ����������
        
        $multilanguages = unserialize($row['multilanguages']);

        if($multilanguages['multilanguages_name'][ $_SESSION['lang_id'] ]!='')
            $obj->set('productName', $multilanguages['multilanguages_name'][ $_SESSION['lang_id'] ]);

        if($multilanguages['multilanguages_content'][ $_SESSION['lang_id'] ]!='')
            $obj->set('productDes', $multilanguages['multilanguages_content'][ $_SESSION['lang_id'] ]);



    }
    
} 

$addHandler=array
        (
         'product_grid'=>'product_grid_phpshopshopcore_multilanguages'
);
?>