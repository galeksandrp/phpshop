<?php

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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    
    // ������������ ���������� / � ����� ����������
    if(substr($_POST['upload_dir_new'], -1) != '/')
           $_POST['upload_dir_new'].='/';
    
    // ������� ���������� ����� 775 �� ����� ��� ������
    @chmod($_SERVER['DOCUMENT_ROOT'] .$GLOBALS['SysValue']['dir']['dir'].'/UserFiles/Image/'.$_POST['upload_dir_new'],$_POST['chmod_new']);

    $PHPShopOrm->debug=false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

// ����� �������
function GetSkinList($skin) {
    global $PHPShopGUI;
    $dir="../templates/skin/";

    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

                $file=str_replace('.css','',$file);
                
                if($skin == $file)
                    $sel="selected";
                else $sel="";

                if($file!="." and $file!=".." and !strpos($file, '.'))
                    $value[]=array($file,$file,$sel);
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('skin_new',$value,100);
}


function actionStart() {
    global $PHPShopGUI,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������ ����";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    // �����
    $e_value[]=array('�� ��������',0,$enabled);
    $e_value[]=array('�����',1,$enabled);
    $e_value[]=array('������',2,$enabled);
    
    // ��� ������
    $w_value[]=array('�����',0,$windows);
    $w_value[]=array('����������� ����',1,$windows);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '���'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('���������',$PHPShopGUI->setInputText(false,'title_new', $title),'left');
    $Tab1.=$PHPShopGUI->setField('CHMOD',$PHPShopGUI->setInputText(false, 'chmod_new', $chmod,100,'* 0775'),'left');
    $Tab1.=$PHPShopGUI->setLine().$PHPShopGUI->setField('������������� ���������', $PHPShopGUI->setTextarea('title_start_new', $title_start));
    $Tab1.=$PHPShopGUI->setField('C�������� ������������ ������', $PHPShopGUI->setTextarea('title_end_new', $title_end));
    $Tab1.=$PHPShopGUI->setField('����� ������',$PHPShopGUI->setSelect('enabled_new',$e_value,100),'left');
    $Tab1.=$PHPShopGUI->setField('������',GetSkinList($data['skin']),'left');
    $Tab1.=$PHPShopGUI->setField('����� �������������',$PHPShopGUI->setInputText('/UserFiles/Image/','upload_dir_new', $upload_dir,100),'left');
    //$Tab1.=$PHPShopGUI->setField('��� ������',$PHPShopGUI->setSelect('windows_new',$w_value,150),'left');
    
    $info='

��� ������������ ������� �������� ������� ������� �������� ������ "�� ��������" � � ������ ������ �������� ����������
        <b>@chat@</b> � ���� ������.
        <p>��� �������������� ����� ������ �������������� ������� phpshop/modules/chat/templates/. 
        CSS ����� �������� ����� ��������� � phpshop/modules/chat/templates/skin/ 
        ��� �������� ������ ����� ���������� ������� ����� ���� *.css � ���� �����.</p>
<p>
��� ������ �� ������� ������������� � ���� ������� ���������� ����� ������ EasyControl � ��������� ������� ��� ��������� 
"��� � ������������". ��� �������� � ���� ��� ����� ������ '.
$PHPShopGUI->setImage('../templates/tray.png',16,16,$align='absmiddle',$hspace="3").'
</p>
';
    
    $Load=$PHPShopGUI->setInput("button","","������� EasyControl","left",300,"return window.open('http://www.phpshop.ru/loads/ThLHDegJUj/setup.exe');","but");


    $Tab2=$PHPShopGUI->setInfo($info, 200, '96%');
    $Tab2.=$Load;

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,290),array("����������",$Tab2,290),array("� ������",$Tab3,290));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

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