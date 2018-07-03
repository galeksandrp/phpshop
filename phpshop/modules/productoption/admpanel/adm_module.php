<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.productoption.productoption_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $vendor = array(
        'option_1_name' => $_POST['option_1_name'],
        'option_1_format' => $_POST['option_1_format'],
        'option_2_name' => $_POST['option_2_name'],
        'option_2_format' => $_POST['option_2_format'],
        'option_3_name' => $_POST['option_3_name'],
        'option_3_format' => $_POST['option_3_format'],
        'option_4_name' => $_POST['option_4_name'],
        'option_4_format' => $_POST['option_4_format'],
        'option_5_name' => $_POST['option_5_name'],
        'option_5_format' => $_POST['option_5_format'],
    );

    $_POST['option_new'] = serialize($vendor);

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function checkSelect($val) {
    $value[] = array('text', 'text', $val);
    $value[] = array('textarea', 'textarea', $val);
    //$value[] = array('checkbox', 'checkbox', $val);
    $value[] = array('radio', 'radio', $val);
    return $value;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;
    
        $PHPShopGUI->field_col = 1;

    // �������
    $data = $PHPShopOrm->select();
    $vendor = unserialize($data['option']);

    $Tab1 = $PHPShopGUI->setField('����� A', $PHPShopGUI->setInputText('���:', 'option_1_name', $vendor['option_1_name'], 180, false, 'left') .'&nbsp;'. $PHPShopGUI->setSelect('option_1_format', checkSelect($vendor['option_1_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� B', $PHPShopGUI->setInputText('���:', 'option_2_name', $vendor['option_2_name'], 180, false, 'left').'&nbsp;'. $PHPShopGUI->setSelect('option_2_format', checkSelect($vendor['option_2_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� C', $PHPShopGUI->setInputText('���:', 'option_3_name', $vendor['option_3_name'], 180, false, 'left') .'&nbsp;'. $PHPShopGUI->setSelect('option_3_format', checkSelect($vendor['option_3_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� D', $PHPShopGUI->setInputText('���:', 'option_4_name', $vendor['option_4_name'], 180, false, 'left') .'&nbsp;'. $PHPShopGUI->setSelect('option_4_format', checkSelect($vendor['option_4_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� E', $PHPShopGUI->setInputText('���:', 'option_5_name', $vendor['option_5_name'], 180, false, 'left') .'&nbsp;'. $PHPShopGUI->setSelect('option_5_format', checkSelect($vendor['option_5_format']), 100));

    $info = '������ ��������� �������� �������������� ���� ��� ����������� � �������� �������� �� ����� � ��� �������������� � �������� ������ ����� �������� "�������������". 
<p>        
��� ������ ������ �� ����� ������������ ���������� <kbd>@productOption1@, @productOption2@, @productOption3@, @productOption4@, @productOption5@</kbd>. ���������� ������������ ����������� ���������� ������ ���������� � �������� �������������� ������ ������ ����. ���������� �������� � ����� ����� �������� ��������� <code>phpshop/templates/��� �������/product/</code>.</p>  

��� ������� � ��������� ����� php ������� ������������ �����������:<br><br>
<code>
$PHPShopProduct = new PHPShopProduct(�� ������);<br>
echo $PHPShopProduct->getParam("option1");<br>
echo $PHPShopProduct->getParam("option2");<br>
echo $PHPShopProduct->getParam("option3");<br>
echo $PHPShopProduct->getParam("option4");<br>
echo $PHPShopProduct->getParam("option5");<br>
</code>';

    $Tab2 = $PHPShopGUI->setInfo($info);

    $Tab3 = $PHPShopGUI->setPay();
    $Tab3.= $PHPShopGUI->setHistory();


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("��������", $Tab2), array("� ������", $Tab3));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� ������� 
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>