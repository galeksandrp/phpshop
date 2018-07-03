<?php

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$select_name;
    
    $PHPShopGUI->setActionPanel(__("��������� ������") . ' <span id="module-name">' . ucfirst($_GET['id']).'</span>', $select_name, null);

    $Info = '<p>������ ��������� �������� ��������� ������ � ���� ������ �������� � ��������� �������� ������� ��� �� ����������. �������� ��� ������� ������, ����������� � ����� � �.�.</p>
        <h4>��������� ������</h4>
        <p>��� �������������� ������ �� ������� <kbd>������</kbd> ���� ����������� ��������� ������ ��������� ������� � ������.</p>
<h4>��������� �������</h4>
    <p><kbd>@productsgroup_list@</kbd> - ���������� �������� �� ����� ����� � ������� ���������� �������� ������ <code>/phpshop/templates/���_�������/product/main_product_forma_full.tpl</code></p>
    <p><kbd>@productsgroup_button_buy@</kbd> - ������ ������� ��� ������� �������, �������� ���� �������: <code>/phpshop/templates/���_�������/product/main_product_forma_2.tpl</code></p>
    <p>��� ��������� ����������� ���� ��� ������ ���-�� ������ � �������� ������, ����� ������ ��������� � ������� �������� ������ <code>/phpshop/templates/���_�������/product/main_product_forma_full.tpl</code>. �������� ����� "<b>priceGroupeR</b>" � ���, ���������� ����. ������: <pre>
&lt;div class="tovarDivPrice12"&gt;����: &lt;span class="priceGroupeR"&gt;@productPrice@&lt;/span&gt; &lt;span&gt;@productValutaName@&lt;/span>&lt;/div&gt;</pre>

    ';

    // ���������� �������� 1
    $Tab2 = $PHPShopGUI->setInfo($Info);

    // ���������� �������� 2
    $Tab3 = $PHPShopGUI->setPay('� ������', false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("����������", $Tab2), array("� ������", $Tab3));

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