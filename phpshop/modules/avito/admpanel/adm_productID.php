<?php

include_once dirname(__FILE__) . '/../class/Avito.php';

function addAvitoProductTab($data) {
    global $PHPShopGUI;

    $tab = $PHPShopGUI->setField('�����', $PHPShopGUI->setCheckbox('export_avito_new', 1, __('�������� ������� � �����'), $data['export_avito']));

    $tab .= $PHPShopGUI->setField("�������� ������:", $PHPShopGUI->setInput('text', 'name_avito_new', $data['name_avito'], 'left', 300));
    $tab .= $PHPShopGUI->setField(__('��������� ������'), $PHPShopGUI->setSelect('condition_avito_new', Avito::getConditions($data['condition_avito']),300), 1, '��� <condition>');
    $tab .= $PHPShopGUI->setField(__('������� �������� ����������'), $PHPShopGUI->setSelect('listing_fee_avito_new', Avito::getListingFee($data['listing_fee_avito']),300), 1, '��� <ListingFee>');
    $tab .= $PHPShopGUI->setField(__('������� ������'), $PHPShopGUI->setSelect('ad_status_avito_new', Avito::getAdStatuses($data['ad_status_avito']),300), 1, '��� <AdStatus>');

    $PHPShopGUI->addTab(array("�����", $tab, true));
}

function avitoUpdate($data)
{
    if (empty($_POST['export_avito_new']) and !isset($_REQUEST['ajax'])) {
        $_POST['export_avito_new'] = 0;
    }
}

$addHandler = array(
    'actionStart' => 'addAvitoProductTab',
    'actionDelete' => false,
    'actionUpdate' => 'avitoUpdate'
);
?>