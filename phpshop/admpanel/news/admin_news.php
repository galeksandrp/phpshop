<?php

$TitlePage = __("�������");

// ���������� JS ����������
$addJS = true;

function actionStart() {
    global $PHPShopInterface;
    $PHPShopInterface->size = "670,550";
    $PHPShopInterface->link = "news/adm_newsID.php";
    $PHPShopInterface->setCaption(array('', "3%"), array("����", "10%"), array("���������", "45%"), array("������� ����������", "45%"));

    // �����
    if ($_REQUEST['var1'] == 'search') {

        $where = array(
            'zag' => " LIKE '%" . $_REQUEST['var2'] . "%'",
            'podrob' => " LIKE '%" . $_REQUEST['var2'] . "%'",
            'id' => "='" . $_REQUEST['var2'] . "'",
            'datas' => "='" . $_REQUEST['var2'] . "'"
        );

        $search_text = $_REQUEST['var2'];
    } elseif ($_REQUEST['var1'] == 'all') {
        $where = null;
    } else {
        // ���������� �� ����
        if (empty($_REQUEST['var1']))
            $pole1 = date("U") - 86400;
        else
            $pole1 = PHPShopDate::GetUnixTime($_REQUEST['var1']) - 86400;

        if (empty($_REQUEST['var2']))
            $pole2 = date("U");
        else
            $pole2 = PHPShopDate::GetUnixTime($_REQUEST['var2']) + 86400;

        $where['datau'] = ' BETWEEN ' . $pole1 . ' AND ' . $pole2;
        $search_text = null;
    }


    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);
    $PHPShopOrm->Option['where'] = ' or ';
    $PHPShopOrm->debug = false;
    $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), array('limit' => 1000));
    if (is_array($data))
        foreach ($data as $row) {
            $PHPShopInterface->setRow($row['id'], array($PHPShopInterface->setCheckbox($row['id'], $row['id'], false, false), $link = false), $row['datas'], $row['zag'], substr(strip_tags($row['kratko']), 0, 150) . "...");
        }

    $PHPShopIcon = new PHPShopIcon($start = 100);
    $PHPShopIcon->padding = 0;
    $PHPShopIcon->margin = 0;

    if (empty($_REQUEST['var1']) or $_REQUEST['var1'] == 'search' or $_REQUEST['var1'] == 'all')
        $pole1 = PHPShopDate::get(date("U") - (86400 * 10), false);
    else
        $pole1 = $_REQUEST['var1'];

    if (empty($_REQUEST['var2']) or $_REQUEST['var1'] == 'search')
        $pole2 = PHPShopDate::get(date("U") + 86400, false);
    else
        $pole2 = $_REQUEST['var2'];

    // ���������
    $Calendar = $PHPShopIcon->setForm(
            $PHPShopIcon->setInputText(false, 'pole1', $pole1, $size = 70, $description = false, $float = "left") .
            $PHPShopIcon->setImage("icon/date.gif", 16, 16, 'absmiddle', "5", $style = 'float:left', $onclick = "popUpCalendar(this, calendar.pole1, 'dd-mm-yyyy');", false, 'icon') .
            $PHPShopIcon->setInputText(false, 'pole2', $pole2, $size = 70, $description = false, $float = "left") .
            $PHPShopIcon->setImage("icon/date.gif", 16, 16, 'absmiddle', "5", $style = 'float:left', $onclick = "popUpCalendar(this, calendar.pole2, 'dd-mm-yyyy');", false, 'icon') .
            $PHPShopIcon->setInput("button", "date_but", "��������", "right", 70, "DoReload('news',calendar.pole1.value, calendar.pole2.value,'core')", 'but small')
            , $action = false, $name = "calendar", 'get');

    $Tab1.= $PHPShopIcon->add($Calendar, 270, 0, 5) .
            $PHPShopIcon->setBorder();

    // ����� ������
    $Search = $PHPShopIcon->setForm(
            $PHPShopIcon->setInputText(__('�����: '), 'words', $search_text, $size = 180, $description = false, $float = "left", false, __('����� �� id, ���� ��� ����������')) .
            $PHPShopIcon->setInput("button", "search_but", "������", "right", 70, "DoReload('news','search',search.words.value, 'core');", 'but small'), $action = false, $name = "search", 'get', false, "DoReload('news','search',search.words.value, 'core'); return false");

    $Tab1.= $PHPShopIcon->add($Search, 300, 5) .
            $PHPShopIcon->setBorder();

    $Tab1.= $PHPShopIcon->setIcon("icon/page_new.gif", __('����� �������'), "PHPShopJS.news.addnew();") .
            $PHPShopIcon->setIcon("icon/layout_content.gif", __('����� ���� ��������'), "DoReload('news','all',null, 'core');") .
            $PHPShopIcon->setBorder();

    // ���������� ���������
    $selact_value[] = array(__('� �����������'), 0, 'selected');
    $selact_value[] = array(__('�������'), 46, false);
    $selact_value[] = array(__('��������� �������������'), 47, false);
    $Select = $PHPShopIcon->setSelect('action', $selact_value, 200, 'none', false, $onchange = 'PHPShopJS.action(this.value)', $height = false, $size = 1, $multiple = false, $id = 'actionSelect');

    $Tab1.=$PHPShopIcon->add($Select, 100);

    $Tab1.=$PHPShopIcon->setIcon("icon/chart_organisation_add.gif", __('�������� ���'), "PHPShopJS.selectall(1)") .
            $PHPShopIcon->setBorder() .
            $PHPShopIcon->setIcon("icon/chart_organisation_delete.gif", __('����� �������'), "PHPShopJS.selectall(2)");

    $PHPShopIcon->setTab($Tab1);
    $PHPShopInterface->addTop($PHPShopIcon->Compile(true));

    //$PHPShopInterface->setAddItem('news/adm_news_new.php');
    $PHPShopInterface->Compile('interfaces', 'flag_form', null);
}

?>