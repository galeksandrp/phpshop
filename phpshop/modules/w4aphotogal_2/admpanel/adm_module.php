<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.w4aphotogal_2.w4aphotogal_2_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $action = $PHPShopOrm->update($_POST);
    return $action;
}


function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;
    
    
    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";
    
    
    // �������
    $data = $PHPShopOrm->select();
    @extract($data);
    
    
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� Photo Gallery","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");
    
         $info='������ ������� ���������� ������� � �������� ������. <a href="http://www.web4.su/dorabotka_funktsionala_phpshop.html" target="blank">��������� �� ����� ������������</a>.
            <p>
        <p></p>
';
    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');
	
     $w4a_info='			
		<div style="padding: 0 0 15px 0; font-size: 20px; color:#63b6e6; text-align:center;">
								���������� ���������� ���-�������:<br/>
			</div>
			<div style="text-align:center;">
			<a href="http://www.web4.su" target="_blank"  tabindex="1000" title="������� �� ���� ������������"><img style="border:0;width: 180px;" src="http://web4.su/UserFiles/logo_02.png"></a>
			</div>
			<div style="padding: 15px 0 0 0; font-size: 12px;text-align:center;">
								����������� ������������� PHPShop <br/>
			<span style="color:#63b6e6;"> ������, �������, ������, ���������� �<br/>
								��������� ������ ������ ���������  ��� PHPShop</span><br/>
								<a href="http://www.web4.su" target="_blank"  tabindex="1000">������� �� ���� ������������</a>
			</div>
';
	$w4aTab4=$PHPShopGUI->setInfo($w4a_info, 200, '96%');   
    
    $Tab3=$PHPShopGUI->setPay($serial,false);
    
    // ����� ����� ��������
   $PHPShopGUI->setTab(array("� ������",$Tab3,270),array("� ������������",$w4aTab4,270));
    
    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","�������","right",70,"return onCancel();","but");
    
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if($UserChek->statusPHPSHOP < 2) {
    
    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'],'actionStart');
    
    // ��������� ������� 
    $PHPShopGUI->getAction();
    
}else $UserChek->BadUserFormaWindow();

?>


