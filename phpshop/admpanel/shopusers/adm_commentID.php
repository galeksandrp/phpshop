<?php

$TitlePage = __('�������������� �����������').' #' . $_GET['id'];
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['comment']);
PHPShopObj::loadClass('user');

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules,$PHPShopSystem;

    // �������
    $PHPShopOrm->sql = 'SELECT a.*, b.name as product, b.pic_small, b.description FROM ' . $GLOBALS['SysValue']['base']['comment'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['products'] . ' AS b ON a.parent_id = b.id    
            WHERE a.id=' . intval($_REQUEST['id']) . ' limit 1';
    $result = $PHPShopOrm->select();

    $data = $result[0];

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel(__("����������") . ' / ' . __('�����������') . ' / ' . $data['name'], array('�������'), array('��������� � �������'),false);

    $media = '<div class="media">
  <div class="media-left">
    <a href="?path=product&id=' . $data['parent_id'] . '&return=' . $_GET['path'] . '">
      <img src="' . $data['pic_small'] . '" onerror="imgerror(this)" class="media-object" lowsrc="./images/no_photo.gif">
    </a>
  </div>
  <div class="media-body">
    <a class="media-heading" href="?path=product&id=' . $data['parent_id'] . '&return=' . $_GET['path'] . '">' . $data['product'] . '</a>
    ' . $data['description'] . '
  </div>
</div>';
    
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '300';
    $oFCKeditor->Value = $data['content'];
    

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setCollapse('����������', $PHPShopGUI->setField("���", $PHPShopGUI->setInput('text.required', "name_new", $data['name'])) .
            $PHPShopGUI->setField("��������", $media) .
            $PHPShopGUI->setField("�����������", $oFCKeditor->AddGUI()) .
            $PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled'])
    ));
    



    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("hidden", "parentID", $data['parent_id'], "right", 70, "", "but") .
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

    // �������� �������� ������
    ratingUpdate();

    return array('success' => $action);
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

/**
 * �������� �������� ������
 */
function ratingUpdate() {

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['comment']);
    $PHPShopOrm->debug = false;

    // ��������� �� ���c��
    if (empty($_POST['parentID'])) {
        $data = $PHPShopOrm->select(array('parent_id'), array('id' =>'='.intval($_POST['rowID'])), false, array('limit' => 1));
        if (!empty($data['parent_id']))
            $_POST['parentID'] = $data['parent_id'];
        else
            return false;
    }


    $result = $PHPShopOrm->query("select avg(rate) as rate, count(id) as num from " . $GLOBALS['SysValue']['base']['comment'] . " WHERE parent_id=" . intval($_POST['parentID']) . " AND enabled='1' AND rate>0 group by parent_id LIMIT 1");
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result);
        $rate = round($row['rate'], 1);
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug = false;
        $PHPShopOrm->update(array('rate_new' => $rate, 'rate_count_new' => $row['num']), array('id' => '=' . $_POST['parentID']));
    } else {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug = false;
        $PHPShopOrm->update(array('rate_new' => 0, 'rate_count_new' => 0), array('id' => '=' . $_POST['parentID']));
    }
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    
    // �������� �������� ������
    ratingUpdate();
    
    return array('success' => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>