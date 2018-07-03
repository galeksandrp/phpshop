<?php

$TitlePage = __("����������");
PHPShopObj::loadClass('user');

function actionStart() {
    global $PHPShopInterface;

    $PHPShopInterface->action_button['�������� ������������'] = array(
        'name' => '',
        'action' => 'addNew',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="�������� ������������"'
    );

    $PHPShopInterface->action_title['order'] = '����� �����';

    $PHPShopInterface->action_select['�����'] = array(
        'name' => '����������� �����',
        'action' => 'search enabled'
    );


    $PHPShopInterface->addJSFiles('./shopusers/gui/shopusers.gui.js');
    $PHPShopInterface->setActionPanel(__("����������"), array('�����', 'CSV', '������� ���������'), array('�������� ������������'));
    $PHPShopInterface->setCaption(array(null, "2%"), array("���", "25%"), array("E-mail", "20%"), array("������", "20%"), array("������ %", "10%"), array("����", "10%"), array("", "10%"), array("������ &nbsp;&nbsp;&nbsp;", "10%", array('align' => 'right')));

    // ������� �������������
    $PHPShopUserStatus = new PHPShopUserStatusArray();
    $PHPShopUserStatusArray = $PHPShopUserStatus->getArray();
    $PHPShopUserStatusArray[0]['name'] = '������������';
    $PHPShopUserStatusArray[0]['discount'] = 0;

    $where = false;

    // ����������� �����
    if (is_array($_GET['where'])) {
        foreach ($_GET['where'] as $k => $v) {
            if (!empty($v))
                $where[PHPShopSecurity::TotalClean($k)] = " LIKE '%" . PHPShopSecurity::TotalClean($v) . "%'";
        }
        $limit = array('limit' => 30000);
    }
    else {
        $limit = array('limit' => 300);
    }

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['shopusers']);
    $PHPShopOrm->debug = false;
    $PHPShopOrm->mysql_error = false;
    $PHPShopOrm->Option['where'] = ' or ';
    $data = $PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), $limit);
    if (is_array($data))
        foreach ($data as $row) {
        
                // Enabled
            if (empty($row['enabled']))
                $enabled = 'text-muted';
            else
                $enabled = null;

            $PHPShopInterface->setRow(
                    $row['id'], array('name' => $row['name'], 'link' => '?path=shopusers&id=' . $row['id'], 'align' => 'left','class'=>$enabled), array('name' => $row['login'], 'link' => 'mailto:' . $row['login'],'class'=>$enabled), $PHPShopUserStatusArray[$row['status']]['name'], $PHPShopUserStatusArray[$row['status']]['discount'], array('name' => '<span class="hide">'.$row['datas'].'</span>'.PHPShopDate::get($row['datas'])), array('action' => array('edit', 'order', '|', 'delete', 'id' => $row['id']), 'align' => 'center'), array('status' => array('enable' => $row['enabled'], 'align' => 'right', 'caption' => array('����', '���'))));
        }
    $PHPShopInterface->Compile();
}

/**
 * ����� ������������� �����������
 */
function actionAdvanceSearch() {
    global $PHPShopInterface;

    $PHPShopInterface->field_col = 2;

    $searchforma = $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[name]', 'placeholder' => __('���'), 'class' => 'pull-left', 'value' => $_REQUEST['words']));
    $searchforma.='<br><br>';
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'text', 'name' => 'where[login]', 'size' => 300, 'placeholder' => __('E-mail'), 'class' => 'pull-left', 'value' => $_REQUEST['words']));
    $searchforma.= $PHPShopInterface->setInputArg(array('type' => 'hidden', 'name' => 'path', 'value' => 'shopusers'));

    $PHPShopInterface->_CODE.=$searchforma;

    exit($PHPShopInterface->getContent() . '<p class="clearfix"> </p>');
}

// ��������� �������
$PHPShopInterface->getAction();
?>