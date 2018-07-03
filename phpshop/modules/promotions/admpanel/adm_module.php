<?php

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$select_name;
    
    $PHPShopGUI->setActionPanel(__("��������� ������") . ' <span id="module-name">' . ucfirst($_GET['id']).'</span>', $select_name, null);

    $Info = '
        <h4>�������������� ���������� � �������</h4>
    <ol>
        <li><kbd>@promotionInfo@</kbd> - �������� �����. �������� ������ � ������ <code>phpshop/templates/��� �������/product/main_product_forma_full.tpl</code></li>
        <li><kbd>@promotionsIcon@</kbd> - ������ �����. �������� � �������� <code>phpshop/templates/��� �������/product/*</code></li></li>
    </ol>';

    // ���������� �������� 1
    $Tab2 = $PHPShopGUI->setInfo($Info);

    // ���������� �������� 2
    $Tab3 = $PHPShopGUI->setPay('� ������', false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("����������", $Tab2), array("� ������", $Tab3),array("����������", null,'?path=modules.dir.promotions'));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>