<?

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

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
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������";
    $PHPShopGUI->size = "500,450";


    // �������
    $data = $PHPShopOrm->select();
    @extract($data);
    $vendor = unserialize($data['option']);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Product Option'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setField('����� A', $PHPShopGUI->setInputText('���:', 'option_1_name', $vendor['option_1_name'], 180, false, 'left') . $PHPShopGUI->setSelect('option_1_format', checkSelect($vendor['option_1_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� B', $PHPShopGUI->setInputText('���:', 'option_2_name', $vendor['option_2_name'], 180, false, 'left') . $PHPShopGUI->setSelect('option_2_format', checkSelect($vendor['option_2_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� C', $PHPShopGUI->setInputText('���:', 'option_3_name', $vendor['option_3_name'], 180, false, 'left') . $PHPShopGUI->setSelect('option_3_format', checkSelect($vendor['option_3_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� D', $PHPShopGUI->setInputText('���:', 'option_4_name', $vendor['option_4_name'], 180, false, 'left') . $PHPShopGUI->setSelect('option_4_format', checkSelect($vendor['option_4_format']), 100));

    $Tab1.= $PHPShopGUI->setField('����� E', $PHPShopGUI->setInputText('���:', 'option_5_name', $vendor['option_5_name'], 180, false, 'left') . $PHPShopGUI->setSelect('option_5_format', checkSelect($vendor['option_5_format']), 100));

    $info='������ ��������� �������� �������������� ���� ��� ����������� � �������� �������� �� ����� � ��� �������������� � �������� ������ ����� �������� "�������������". 
<p>        
��� ������ ������ �� ����� ������������ ���������� <b>@productOption1@, @productOption2@, @productOption3@, @productOption4@, @productOption5@</b>. ���������� ������������ ����������� ���������� ������ ���������� � �������� �������������� ������ ������ ����. ���������� �������� � ����� ����� �������� ��������� phpshop/templates/��� �������/product/.</p>  

��� ������� � ��������� ����� php ������� ������������ �����������:<br><br>
<code>
$PHPShopProduct = new PHPShopProduct(�� ������);<br>
echo $PHPShopProduct->getParam("option1");<br>
echo $PHPShopProduct->getParam("option2");<br>
echo $PHPShopProduct->getParam("option3");<br>
echo $PHPShopProduct->getParam("option4");<br>
echo $PHPShopProduct->getParam("option5");<br>
</code>';

    $Tab2 = $PHPShopGUI->setInfo($info, 200, '96%');

    $Tab3 = $PHPShopGUI->setPay($serial, false);
    $Tab3.= $PHPShopGUI->setLine('<br>') . $PHPShopGUI->setHistory();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("��������", $Tab2, 270), array("� ������", $Tab3, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� ������� 
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>


