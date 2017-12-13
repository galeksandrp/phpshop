<?php

session_start();

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("parser");
PHPShopObj::loadClass("text");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("mail");

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");
$PHPShopModules->checkInstall('chat');

function smile($string) {

    $Smile = array(
        ':-D' => '<img src="templates/smiley/grin.gif" alt="�������" border="0">',
        ':\)' => '<img src="templates/smiley/smile3.gif" alt="���������" border="0">',
        ':\(' => '<img src="templates/smiley/sad.gif" alt="��������" border="0">',
        ':shock:' => '<img src="templates/smiley/shok.gif" alt="� ����" border="0">',
        ':cool:' => '<img src="templates/smiley/cool.gif" alt="�������������" border="0">',
        ':blush:' => '<img src="templates/smiley/blush2.gif" alt="����������" border="0">',
        ':dance:' => '<img src="templates/smiley/dance.gif" alt="�������" border="0">',
        ':rad:' => '<img src="templates/smiley/happy.gif" alt="��������" border="0">',
        ':lol:' => '<img src="templates/smiley/lol.gif" alt="��� ������" border="0">',
        ':huh:' => '<img src="templates/smiley/huh.gif" alt="� ��������������" border="0">',
        ':rolly:' => '<img src="templates/smiley/rolleyes.gif" alt="����������" border="0">',
        ':thuf:' => '<img src="templates/smiley/threaten.gif" alt="����" border="0">',
        ':tongue:' => '<img src="templates/smiley/tongue.gif" alt="���������� ����" border="0">',
        ':smart:' => '<img src="templates/smiley/umnik2.gif" alt="��������" border="0">',
        ':wacko:' => '<img src="templates/smiley/wacko.gif" alt="���������" border="0">',
        ':yes:' => '<img src="templates/smiley/yes.gif" alt="�����������" border="0">',
        ':yahoo:' => '<img src="templates/smiley/yu.gif" alt="���������" border="0">',
        ':sorry:' => '<img src="templates/smiley/sorry.gif" alt="��������" border="0">',
        ':nono:' => '<img src="templates/smiley/nono.gif" alt="��� ���" border="0">',
        ':dash:' => '<img src="templates/smiley/dash.gif" alt="������ �� ������" border="0">',
        ':dry:' => '<img src="templates/smiley/dry.gif" alt="������������" border="0">',
    );

    foreach ($Smile as $key => $val)
        $string = eregi_replace($key, $val, $string);

    return $string;
}


function get_file_link($matches){
    $path_parts = pathinfo($matches[0]);
    $url=parse_url($matches[0]);
    
   if($url['scheme'] == 'file')
    return '<a href="'.chr(47).$GLOBALS['SysValue']['dir']['dir'].'UserFiles/Image/'.$_SESSION['chat_dir'].$path_parts['basename'].'" target="_blank">'.$path_parts['basename'].'</a>'; 
    else if($url['host'] != $_SERVER['SERVER_NAME'])
       return '<a href="'.$matches[0].'" target="_blank">'.$matches[0].'</a>'; 
      else 
    return '<a href="http://'.$url['host'].chr(47).$GLOBALS['SysValue']['dir']['dir'].'UserFiles/Image/'.$_SESSION['chat_dir'].$path_parts['basename'].'" target="_blank">'.$path_parts['basename'].'</a>'; 
}

function check_content($content){

    $str = smile($content);
    $str = preg_replace_callback('/((www|http:\/\/|file:\/\/)[^ ]+)/', 'get_file_link', $str);
    
    return $str;
}


// ������ ����
if (empty($_SESSION['mod_chat_user_session'])) {
    
    if (!empty($_REQUEST['name'])) {

        // �������� ����������� ���������
        $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_system"));
        $PHPShopOrm->debug = false;
        $data_system = $PHPShopOrm->select(array('*'), false, false, array('limit' => 1));
        
        
        // ������ ����
        if(!empty($data_system['skin']))
        $_SESSION['chat_skin']=$data_system['skin'];
        else $_SESSION['chat_skin']='default';
        
        // ����������
        $_SESSION['chat_dir']=$data_system['upload_dir'];
        
        if ($data_system['operator'] == 2) {
            $block = 'disabled';
            $content = $data_system['title_end'];
        } else {
            $block = null;

            // ����� ������������
            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_users"));
            $PHPShopOrm->debug = false;
            $insert = array();
            $insert['name_new'] = PHPShopString::utf8_win1251((string)$_REQUEST['name']);
            $insert['date_new'] = time();
            $insert['user_session_new'] = md5(time());
            $insert['ip_new'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['mod_chat_user_session'] = $insert['user_session_new'];
            $_SESSION['mod_chat_user_name'] = $insert['name_new'];
            $PHPShopOrm->insert($insert);

            // ����� ��������� ����� ������ ���
            unset($insert);
            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_jurnal"));
            $insert['user_session_new'] = $_SESSION['mod_chat_user_session'];
            $insert['content_new'] = htmlspecialchars('������������ ' . $_SESSION['mod_chat_user_name'] . ' ����� ������ ���');
            $insert['status_new'] = 1;
            $insert['name_new'] = $_SESSION['mod_chat_user_name'];
            $insert['date_new'] = time();
            $PHPShopOrm->insert($insert);
            
            // ����� ��������� System
            unset($insert);
            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_jurnal"));
            $insert['user_session_new'] = $_SESSION['mod_chat_user_session'];
            $insert['content_new']= htmlspecialchars($data_system['title_start']);
            $insert['status_new'] = 1;
            $insert['name_new'] = 'System';
            $insert['date_new'] = time();
            $PHPShopOrm->insert($insert);

        }
    } else {
        PHPShopParser::file('./templates/chat_window_go.tpl');
        exit();
    }
}

// ������ ���������
if(!empty($_SESSION['mod_chat_user_session'])){
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.chat.chat_jurnal"));
$PHPShopOrm->debug = false;
$data = $PHPShopOrm->select(array('*'), array('user_session' => "='" . $_SESSION['mod_chat_user_session'] . "'"), array('order' => 'id'), array('limit' => 100));
}
$time = time();
if (is_array($data)) {
    $content = null;
    foreach ($data as $row) {

        // ������
        if ($_SESSION['mod_chat_user_name'] == $row['name']) {
            $icon = 'user.png';
            $name = PHPShopText::b($row['name']);
            $div_class = 'text_user';
        } else {
            $icon = 'admin.png';
            $name = PHPShopText::b($row['name']);
            $div_class = 'text_admin';
        }

        $name = PHPShopText::img('./templates/' . $icon, 3, 'absmiddle') . $name;
        $content.=PHPShopText::div($name . ': ' . check_content($row['content']), "left", false, false, $div_class);

        $time = $row['date'];
    }
} else {
    $icon = 'admin.png';
    $name = PHPShopText::b('�������������');
    $div_class = 'text_admin';
    $name = PHPShopText::img('./templates/' . $icon, 3, 'absmiddle') . $name;
    $content=PHPShopText::div($name . ': ' .check_content($content), "left", false, false, $div_class);

}

PHPShopParser::set('chat_mod_product_name', $GLOBALS['SysValue']['license']['product_name']);
PHPShopParser::set('chat_mod_skin',$_SESSION['chat_skin']);
PHPShopParser::set('chat_mod_disable', $block);
PHPShopParser::set('chat_mod_time', $time);
PHPShopParser::set('chat_mod_dir', $_SESSION['chat_dir']);
PHPShopParser::set('chat_mod_content', $content);
PHPShopParser::set('chat_mod_sound', $PHPShopModules->getParam("templates.chat_sound"));
PHPShopParser::file('./templates/chat_window.tpl');
?>