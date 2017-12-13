<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");



$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->debug_close_window=false;
$PHPShopGUI->reload='top';
$PHPShopGUI->ajax="'modules','promotions'";
$PHPShopGUI->includeJava='<SCRIPT language="JavaScript" src="../../../lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>';
$PHPShopGUI->dir=$_classPath."admpanel/";

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));

function TestCat($n) {// ���� �� ��� �����������
    global $SysValue;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where parent_to='$n'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

function Vivod_rekurs($n, $prefix, $categories) {// ����� ������������ ��������
    global $SysValue;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to='$n' order by num, name";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $i = 0;
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $parent_to = $row['parent_to'];
        $num = TestCat($id);

        

        if ($i < $num) {// ���� ���� ��� ��������
            //@$disp.=$name . Vivod_rekurs($id);
            $disp.='<option value="'.$id.'" disabled>'.$prefix.' '.$name.'</option>';
            $prefix = $prefix.'-';
            $disp.=Vivod_rekurs($id, $prefix, $categories);
            
        } else {// ���� ��� ���������
            //@$disp.=$name . DispName($parent_to, $name);
            $catego_ar = explode(',', $categories);
            foreach ($catego_ar as $val_c) {
                if($val_c==$id):
                    $ssel = 'selected';
                    break;
                else:
                    $ssel = '';
                endif;
            }
            $disp.='<option value="'.$id.'" '.$ssel.'>'.$prefix.' '.$name.'</option>';
            //$valuer = DispName($parent_to, $name);
        }
    }
    return @$disp;
}

function DispName($n, $catalog) {
    global $SysValue;
    $sql = "select name from " . $SysValue['base']['table_name'] . " where id='$n'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name = str_replace(array('"', "'"), " ", $row['name']);
    $ar = array($name,$row['id'], false);
    return $ar;
}

function Vivod_pot($categories) {// ����� ���������
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm, $category;
    $sql = "select * from " . $SysValue['base']['table_name'] . " where parent_to=0 order by num, name";
    $result = mysql_query($sql);
    $i = 0;
    $dis=null;
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = str_replace(array('"', "'"), " ", $row['name']);
        $num = TestCat($id);
        if ($num > 0) {
            //$dis.=$name . Vivod_rekurs($id);
            $dis .= '<option value="'.$id.'" disabled>'.$name.'</option>';
            $dis .= Vivod_rekurs($id, '-',$categories);
        }
        else {
           //@$dis.=$name . Vivod_rekurs($id);
            $catego_ar = explode(',', $categories);
            foreach ($catego_ar as $val_c) {
                if($val_c==$id) {
                    $ssel = 'selected';
                    break;
                }
                else {
                    $ssel = '';
                }
            }
            $dis .= '<option value="'.$id.'" '.$ssel.'>'.$name.'</option>';
            //$dis .= Vivod_rekurs($id, '-',$categories);
        }
        $i++;
    }

    return $dis;
}

function Vivod_cat_all_num($n) {// ����� ���-�� ������� �� ������� �����������
    global $SysValue;
    $sql = "select id from " . $SysValue['base']['table_name'] . " where category='$n' and enabled='1'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
    if(empty($_POST['active_check_new'])) $_POST['active_check_new']=0;
    if(empty($_POST['discount_check_new'])) $_POST['discount_check_new']=0;
    if(empty($_POST['free_delivery_new'])) $_POST['free_delivery_new']=0;
    if(empty($_POST['categories_check_new'])) $_POST['categories_check_new']=0;
    if(empty($_POST['products_check_new'])) $_POST['products_check_new']=0;
    if(empty($_POST['sum_order_check_new'])) $_POST['sum_order_check_new']=0;
    if(empty($_POST['delivery_method_check_new'])) $_POST['delivery_method_check_new']=0;
    if(empty($_POST['code_check_new'])) $_POST['code_check_new']=0;
    if(empty($_POST['discount_tip_new'])) $_POST['discount_tip_new']=0;
    if(empty($_POST['code_tip_new'])) $_POST['code_tip_new']=0;
    
    if(isset($_POST['categories'])) {
        foreach ($_POST['categories'] as $value) {
            $_POST['categories_new'] .= $value.',';
        }
    }
    else {
        $_POST['categories_new'] = '';
    }

    //����� ������
    if($_POST['code_new']=="") {
        $_POST['code_new'] = '*';
    }

    $action = $PHPShopOrm->update($_POST,array('id'=>'='.$_POST['newsID']));
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="�������������� �����-�����";
    $PHPShopGUI->size="650,540";


    // �������
    $data = $PHPShopOrm->select(array('*'),array('id'=>'='.$_GET['id']));
    @extract($data);

    $PHPShopGUI->addJSFiles('../../../admpanel/java/popup_lib.js', '../../../admpanel/java/dateselector.js','../js/jquery-1.7.1.min.js','../js/promotions.js');
    $PHPShopGUI->addCSSFiles('../../../admpanel/skins/'.$_SESSION['theme'].'/dateselector.css');


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� �����-�����","",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"),true);
    $oFCKeditor = new Editor('description_new',true);
    $oFCKeditor->Height = '110';
    $oFCKeditor->Width = '100%';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "../templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $description;

    $descriptionCon = $oFCKeditor->AddGUI();


    $Tab1=$PHPShopGUI->setField('��������',$PHPShopGUI->setInputText('','name_new',$name,'300',false,'left').
        $PHPShopGUI->setText($PHPShopGUI->setRadio("enabled_new", 1, "����������", $enabled) .
        $PHPShopGUI->setRadio("enabled_new", 0, "������",$enabled),'left')
    );

    $versphp = phpversion(); //5.3.0
    //$versphp = "4.1.1";
    $version_status = version_compare($versphp,"5.3.0");

    if($version_status!='-1') {
         $Tab1.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("active_check_new", 1, "����������", $active_check, "left"),
            $PHPShopGUI->setInput("text", "active_date_ot_new", $active_date_ot, "left", 70, false, false, false, false, $PHPShopGUI->setImage("../../../admpanel/icon/date.gif", 16, 16, 'absmiddle', "5", $style = 'float:none', $onclick = "popUpCalendar(this, product_edit.active_date_ot_new, 'dd-mm-yyyy');")) .
            $PHPShopGUI->setInput("text", "active_date_do_new", $active_date_do, "left", 70, false, false, false, false, $PHPShopGUI->setImage("../../../admpanel/icon/date.gif", 16, 16, 'absmiddle', "5", $style = 'float:none', $onclick = "popUpCalendar(this, product_edit.active_date_do_new, 'dd-mm-yyyy');"))        
        );
    }
    else {
        $Tab1.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("active_check_new", 1, "����������", $active_check, "left"),
            $PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16) .
                    __('������ ������� �������� ������ ��� ������ <b>php 5.3</b> � ���� <i>(���� ������ <b>php '.$versphp.'</b>)</i>')       
        );
    }

    $Tab1.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("discount_check_new", 1, "������", $discount_check, "left"),
            $PHPShopGUI->setText($PHPShopGUI->setRadio("discount_tip_new", 1, "%", $discount_tip) .
                                $PHPShopGUI->setRadio("discount_tip_new", 0, "�����",$discount_tip),'left') .
            $PHPShopGUI->setInputText('','discount_new',$discount,'70',false,'left') 
    );

    $Tab1.= $PHPShopGUI->setField('���������� ��������',$PHPShopGUI->setText( $PHPShopGUI->setCheckbox("free_delivery_new", 1, "���������� ��������", $free_delivery, "left") ) );
    

    //������ ��������� � ������������
    $categories_option = Vivod_pot($categories);
    $categories_mul_sel .= '<select multiple size="5" id="categories" name="categories[]" style="width:100%;">'.$categories_option.'</select>';

    $Tab2.= $PHPShopGUI->setText(
            $PHPShopGUI->setField($PHPShopGUI->setCheckbox("categories_check_new", 1, "��������� ������", $categories_check, "left"),
                $categories_mul_sel . $PHPShopGUI->setCheckbox("selectalloption", 1, "������� ��� ���������?", '', "right")
            ,'none', 0, 0, $option = array('height'=>'120')),'left', 'width:48%; height:130px;'
            
        );

    $Tab2.= $PHPShopGUI->setText(
                $PHPShopGUI->setField($PHPShopGUI->setCheckbox("products_check_new", 1, "ID ������", $products_check, "left"),
                    $PHPShopGUI->setTextarea('products_new',$products) . 
                    $PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16) .
                    __('������� ID ������� � ������� 1,2,3 ��� ��������')
                ,'none', 0, 0, $option = array('height'=>'120'))      
    ,'left', 'width:48%; height:130px;');

    $Tab2.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("sum_order_check_new", 1, "����� ������ ��", $sum_order_check, "left"),
            $PHPShopGUI->setInputText('','sum_order_new',$sum_order,'70',false,'left') 
    );
    
    // ������ ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['payment_systems']);
    $data_payment_systems = $PHPShopOrm->select(array('id,name'), false, array('order' => 'name'), array('limit' => 100));

    foreach ($data_payment_systems as $value) {
        if($value['id']==$delivery_method)
            $sel = 'selected';
        else
            $sel = false;
        $value_payment_systems[]=array($value['name'],$value['id'],$sel);
    }

    $Tab2.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("delivery_method_check_new", 1, "������ ������", $delivery_method_check, "left"),
            
            $PHPShopGUI->setSelect('delivery_method_new',$value_payment_systems,200)
    );

    //����� ������
    if($code=='*') {
        $code = '';
    }

    $Tab2.=$PHPShopGUI->setField($PHPShopGUI->setCheckbox("code_check_new", 1, "��� ������", $code_check, "left"),
            $PHPShopGUI->setInputText('','code_new',$code,'170',false,'left') .
            $PHPShopGUI->setInput('button','gen','�������������', $float = "none", 120, $onclick = "randAa(10);")
    );

    $Tab2.=$PHPShopGUI->setField('��� ������',
            $PHPShopGUI->setText($PHPShopGUI->setRadio("code_tip_new", 1, "�����������", $code_tip) .
                                $PHPShopGUI->setRadio("code_tip_new", 0, "������������",$code_tip),'left')
    );

    $Tab3 = $descriptionCon;
                            
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,405), array("�������",$Tab2,350), array("��������",$Tab3,350));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","delID","�������","right",70,"","but","actionDelete").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}


// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id'=>'='.$_POST['newsID']));
    return $action;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setAction($_GET['id'],'actionStart','none');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>


