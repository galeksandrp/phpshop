<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.seourlpro.seourlpro_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    //return $action;
}

// �������������� �������� � ��������
function setLatin($str) {
    $str = strtolower($str);
    $str = str_replace("/", "", $str);
    $str = str_replace("\\", "", $str);
    $str = str_replace("(", "", $str);
    $str = str_replace(")", "", $str);
    $str = str_replace(":", "", $str);
    $str = str_replace(" ", "-", $str);
    $str = str_replace("\"", "", $str);
    $str = str_replace(".", "", $str);
    $str = str_replace("�", "", $str);
    $str = str_replace("�", "", $str);
    $str = str_replace("�", "", $str);
    $str = str_replace("�", "", $str);

    $_Array = array(
        "�" => "a",
        "�" => "b",
        "�" => "v",
        "�" => "g",
        "�" => "d",
        "�" => "e",
        "�" => "e",
        "�" => "zh",
        "�" => "z",
        "�" => "i",
        "�" => "i",
        "�" => "k",
        "�" => "l",
        "�" => "m",
        "�" => "n",
        "�" => "o",
        "�" => "p",
        "�" => "r",
        "�" => "s",
        "�" => "t",
        "�" => "u",
        "�" => "f",
        "�" => "h",
        "�" => "c",
        "�" => "ch",
        "�" => "sh",
        "�" => "sh",
        "�" => "y",
        "�" => "e",
        "�" => "uy",
        "�" => "ya",
        "�" => "a",
        "�" => "b",
        "�" => "v",
        "�" => "g",
        "�" => "d",
        "E" => "e",
        "�" => "e",
        "�" => "gh",
        "�" => "z",
        "�" => "i",
        "�" => "i",
        "�" => "k",
        "�" => "l",
        "�" => "m",
        "�" => "n",
        "�" => "o",
        "�" => "p",
        "�" => "r",
        "�" => "s",
        "�" => "t",
        "�" => "u",
        "�" => "f",
        "�" => "h",
        "�" => "c",
        "�" => "ch",
        "�" => "sh",
        "�" => "sh",
        "�" => "e",
        "�" => "uy",
        "�" => "ya",
        "." => "",
        "," => "",
        "$" => "i",
        "%" => "i",
        "&" => "and");

    $chars = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($chars as $val)
        if (empty($_Array[$val]))
            @$new_str.=$val;
        else
            $new_str.=$_Array[$val];

    return $new_str;
}

// ������������� ����� ��������� ����
function setGenerationPhoto() {
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name22']);
    $data = $PHPShopOrm->select(array('id', 'name'), false, false, array('limit' => 1000));

    if (is_array($data))
        foreach ($data as $val) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name22']);
            $array['seoname_new'] = setLatin($val['name']);
            $PHPShopOrm->update($array, array('id' => '=' . $val['id']));
        }
}

// ������������� ����� ���������
function setGeneration() {
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
    $data = $PHPShopOrm->select(array('id', 'name'), false, false, array('limit' => 1000));

    if (is_array($data))
        foreach ($data as $val) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
            $array['seoname_new'] = setLatin($val['name']);
            $PHPShopOrm->update($array, array('id' => '=' . $val['id']));
        }
}

// ������������� ����� ��������
function setGenerationNews() {
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name8']);
    $data = $PHPShopOrm->select(array('id', 'title'), false, false, array('limit' => 1000));

    if (is_array($data))
        foreach ($data as $val) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name8']);
            $array['seo_name_new'] = setLatin($val['title']);
            $PHPShopOrm->update($array, array('id' => '=' . $val['id']));
        }
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    // ������������� �����
    if (!empty($_POST['generation']))
        setGeneration();
    if (!empty($_POST['generationnews']))
        setGenerationNews();
    if (!empty($_POST['generationphoto']))
        setGenerationPhoto();

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();


    // ���������� ��������
    $Info = '<p>��� ��������� ������ "SEO ���������" ������� �������� ���������� <kbd>@seourl_canonical@</kbd> � ������ <code>phpshop/templates/��� �������/main/shop.tpl</code>, � ���������� ����� ��������� ������ link rel="canonical" � ������ ������� ��� ���������� ������ ������� �������� ������ �������.</p>';

    $Tab1 = $PHPShopGUI->setField('SEO ���������', $PHPShopGUI->setRadio('paginator_new', 2, '��������', $data['paginator']) . $PHPShopGUI->setRadio('paginator_new', 1, '���������', $data['paginator']));
    $Tab1.=$PHPShopGUI->setField('�������� �������� �� ���������� ���������', $PHPShopGUI->setRadio('cat_content_enabled_new', 1, '��������', $data['cat_content_enabled']) . $PHPShopGUI->setRadio('cat_content_enabled_new', 2, '���������', $data['cat_content_enabled']));
    $Tab1.= $PHPShopGUI->setField('�����',$PHPShopGUI->setInfo($Info));

    $Tab2 = $PHPShopGUI->setPay($serial = false, $pay = false, $data['version'], $update = true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab2, 270));

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
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>