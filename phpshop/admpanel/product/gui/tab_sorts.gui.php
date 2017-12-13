<?php

/**
 * ������ ������ �������������
 * @param int $value �������� ��������������
 * @param int $n �� ��������������
 * @param int $title ��������� ��������������
 * @param array $vendor ������ �������������
 */
function sorttemplate($value, $n, $title, $vendor) {
    global $PHPShopGUI;
    $i = 1;
    $value_new[0]=array(__('��� ������'),false, 'none');
    sort($value);
    if (is_array($value)) {
        foreach ($value as $p) {
            $sel = null;
            if (is_array($vendor[$n])) {
                foreach ($vendor[$n] as $value) {

                    if ($value == $p[1])
                        $sel = "selected";
                }
            }elseif ($vendor[$n] == $p[1])
                $sel = "selected";

            $value_new[$i] = array($p[0], $p[1], $sel);
            $i++;
        }
    }

    $value = $PHPShopGUI->setSelect('vendor_array_new[' . $n . '][]', $value_new, '100%', false, false, false, false, false, $n,'list'.$n);
    
    $disp=$PHPShopGUI->setLine().$PHPShopGUI->setField($title, $value,'left',false,false,array('width'=>'45%;')).
            $PHPShopGUI->setField(__('�������� � ������������ ����� �������� ��������������'), $PHPShopGUI->setInputText(false, 'addval'.$n).$PHPShopGUI->setInput("button", "", "��������", "right", 70, "return enterchar($n);", "but").'<B id="sta'.$n.'"></B>','left');
    
    return $disp;
}

/**
 * ������ ����������� ������
 * @param array $row ������ ������
 * @return string 
 */
function tab_sorts($data){
    global $PHPShopGUI;
    PHPShopObj::loadClass("sort");
    $PHPShopGUI->addJSFiles('gui/tab_sorts.gui.js');
    $PHPShopSort = new PHPShopSort($data['category'], false, false, 'sorttemplate', unserialize($data['vendor_array']), false, true);
    return $PHPShopGUI->setDiv('left', $PHPShopSort->disp, 'height:450px;overflow:auto;');
}
?>
