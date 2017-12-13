<?php
/**
 * ��������� ����� ������� � "��������������� �� �������"
 * @param array $obj ������
 */

function specmainFacebook_hook($obj){
	// ���� ��������� ��� �� ������ ������� ��� ��������
	// ������ ���-�� ������ �� ������� = 15
	$obj->limit = 15;
}


/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>
 * @param array $obj ������
 * @param array $arg ������ ������
 * @return string
 */
function setcell2_hook($obj,$arg) {
    $li=null;
    $panel=array('panel_l','panel_r','panel_l','panel_r');

    foreach($arg as $key=>$val) {
        if(!empty($val)) {
            $li.='<li>'.$val.'</li>';
        }
    }

    return $li;
}

/**
* ��������� ���-�� ������ �� �������
*/

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>, ���������� ������ � <ul>
 * @return string
 */
function compile2_hook($obj) {
    $ul='<ul>'.$obj->product_grid.'</ul>';
    $obj->product_grid=null;
    return $ul;
}

/**
 * ���������� � ������ ��������� ��������������� ������� � 3 ������, ����� 3
 */
function cid_category_add_spec_hook($obj,$row) {
    global $PHPShopProductIconElements;

    // ��������� ����� ��������
    if(is_array($row))
        foreach($row as $val)
            $cat[]=$val['id'];
    $rand=rand(0,count($cat)-1);

    // ���������� ������� ������ ���������������
    $PHPShopProductIconElements->template='main_product_forma_3';
    $spec=$PHPShopProductIconElements->specMainIcon(false,$cat[$rand],3,3,true);
    $spec=PHPShopText::div(PHPShopText::p($spec),$align="left",$style='float:none;padding:10px');

    // ��������� � ���������� ������ ��������� ����� ���������������
    $obj->set('catalogList',$spec,true);
}

$addHandler=array
        (
        'setCell'=>'setcell2_hook',
        'compile'=>'compile2_hook',
        '#specMain'=>'specmainFacebook_hook',
	'CID_Category'=>'cid_category_add_spec_hook'
);

?>