<?php

$TitlePage = __('�������������� ��������� #' . $_GET['id']);
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['messages']);
PHPShopObj::loadClass('user');

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules;

    // �������
    $PHPShopOrm->sql = 'SELECT a.*, b.name, b.login FROM ' . $GLOBALS['SysValue']['base']['messages'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.UID = b.id     
            WHERE a.id=' . intval($_REQUEST['id']) . '  limit 1';

    $result = $PHPShopOrm->select();

    $data = $result[0];

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("����������") . ' / ' . __('���������') . ' / ' . $data['name'], array('�������'), array('��������� � �������'));
    
    $user='<a class="btn btn-default btn-sm" href="?path=shopusers&id=' . $data['UID'].'&return='.$_GET['path'].'"><span class="glyphicon glyphicon-user"></span> '.$data['name'].' : '.$data['login'].'</a>';
    
    $message='<div class="well">'.strip_tags($data['Message'],'<b><hr><br>').'</div>';

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse(__('����������'), 
            $PHPShopGUI->setField("�����������", $user) .
            $PHPShopGUI->setField("����", $PHPShopGUI->setInput('text.required', "Subject_new", $data['Subject'])) .
            $PHPShopGUI->setField("���������", $message).$PHPShopGUI->setInput('hidden', "Message_new", $data['Message']).
            $PHPShopGUI->setField("�����", $PHPShopGUI->setTextarea('respond', null, false, '100%', 100,false,'����� ���������...'))
    );


    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['ID'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.shopusers.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.shopusers.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.shopusers.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);


    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array('success' => $action);
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    if(!empty($_POST['respond'])){
        $_POST['Message_new']='<b>�������������</b>: '.$_POST['respond'].'<HR>'.$_POST['Message_new'];
        $_POST['enabled_new']=1;
    }
        

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
   return array('success' => $action);
}


// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>