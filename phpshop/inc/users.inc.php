<?


// ����� �������
function GetUsersOrders($n){
global $SysValue;
$n=TotalClean($n,1);
$sql="select * from ".$SysValue['base']['table_name27']." where id=$n and enabled='1'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
return $row;
}


// ����� ���� � ������������ ��� ������
function GetUsersInfo($n){
global $SysValue;
$n=TotalClean($n,1);
$sql="select * from ".$SysValue['base']['table_name27']." where id=$n and enabled='1'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
return $row;
}

// �������� ������������
function ChekUsersBase($log,$pas){
global $SysValue;
$return=0;
if(true_login($log) and true_login($pas)){
$pas=base64_encode($pas);
$sql="select id,status from ".$SysValue['base']['table_name27']." where login='$log' and password='$pas' and enabled='1' LIMIT 0, 1";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$num=mysql_num_rows(@$result);

if($num>0){
$sql="UPDATE ".$SysValue['base']['table_name27']."
     SET
     datas='".date("U")."'
     where id='".$row['id']."'";
$result=mysql_query($sql);
$return=array(@$row['id'],@$row['status']);
         }else $return=0;
}

return $return;
}

// ������� ������ ������������
function SendUserPassword(){
global $SysValue,$_POST,$LoadItems,$SERVER_NAME,$REMOTE_ADDR;


if($_POST['pas_send']==1){
$login=CleanSearch($_POST['login']);

$sql="select * from ".$SysValue['base']['table_name27']." where login='".htmlspecialchars($login)."' and enabled='1'";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$num=mysql_num_rows($result);

if($num>0) {

// ���� ���� 
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <support@".str_replace("www.","",$SERVER_NAME).">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." - �������������� ������ ������������ ".$_POST['login'];
$content_adm="
������� �������!
--------------------------------------------------------

���������(��) ������������ ".$_POST['login'].", �� ��������� ������� �� ��� ����� ������ ��� ������� 
� ������� �������� �� ����� ".$SERVER_NAME."

���� ������
---------------
������������: ".$row['login']."
������: ".base64_decode($row['password'])."
����: ".date("d-m-y H:s a")."
IP �����������:".$REMOTE_ADDR."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($_POST['mail'],$zag_adm, $content_adm, $header_adm);

$disp='
<div id=allspec>
<img src="images/shop/icon_security.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�������������� ������</b>
</div>
<p>
������ ������������ <b>'.$row['login'].'</b> ��������� �� <b>'.$row['mail'].'</b>.<br>
� ������ �� ��������� ��������� � ������� ���������� ���������� � ������ ���������.
 </p>';
}
else{
$disp='
<div id=allspec>
<img src="images/shop/icon_security.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�������������� ������</b>
</div>
<p>
������ ������������ <b>�� ����������</b>, ��� �� ������������ �������������� �����.<br>
�������� ��������� <a href="/users/register.html" class="b">�����������</a> ��� ��������� ����������� ������������ ������ � ��������-���������.
 </p>';
}
}
else{
$disp='
<div id=allspec>
<img src="images/shop/icon_security.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�������������� ������</b>
</div>
<p>
<table>
<form method="post" name="userpas_forma">
<tr>
	<td>�����:</td>
	<td><input type="text" name="login" maxlength="20"></td>
	<td><input type="button" value="�������" onclick="ChekUserSendForma()">
	<input type="hidden" value="1" name="pas_send"></td>
</tr>
</form>
</table>
<div  id=allspecwhite><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������� ���� <b>����� </b>��� ��������� ������ �� ��� ����� ����������� �����.<br>
'.$UserAddData.'
</div>
 </p>';
}
return $disp;
}

// ��������� ������������ �� �����
function CheckUserName($login){
global $SysValue;
$login=CleanSearch($login);
$sql="select id from ".$SysValue['base']['table_name27']." where login='".htmlspecialchars($login)."'";
$result=mysql_query($sql);
$num=mysql_num_rows($result);
return @$num;
}


// ����� � ���� ������������
function UserAddData(){
global $SysValue,$_POST,$_SESSION,$LoadItems;
$admoption=unserialize($LoadItems['System']['admoption']);
$flag="";

if($_POST['key']!=$_SESSION['text']){
$flag="<li>������������ ����";
return $flag;
}

$CheckUserName=CheckUserName($_POST['login_new']);
if($CheckUserName>0) $flag.="<li>������������ � ����� ������� ��� ����������";



if($_POST['password_new'] != $_POST['password_new2']) $flag.="<li>������ �� ���������";
if(!true_login($_POST['login_new'])) $flag.="<li>������������ �����";
if(!true_passw($_POST['password_new'])) $flag.="<li>������������ ������";
if(!true_email($_POST['mail_new'])) $flag.="<li>������������ e-mail";
if(strlen($_POST['name_new']) <3) $flag.="<li>������������ ���";

if($admoption['user_mail_activate'] != 1){
$user_mail_activate = 1;
$user_status=$admoption['user_status'];
}
 else {
 $user_mail_activate = 0;
 $user_status=md5($_SESSION['sid']);
 }


if($flag==""){
$sql="INSERT INTO ".$SysValue['base']['table_name27']."
VALUES ('','".$_POST['login_new']."','".base64_encode($_POST['password_new'])."','".date("U")."','".$_POST['mail_new']."','".htmlspecialchars($_POST['name_new'])."','".htmlspecialchars($_POST['company_new'])."','".htmlspecialchars($_POST['inn_new'])."','".htmlspecialchars($_POST['tel_new'])."','".htmlspecialchars($_POST['adres_new'])."','$user_mail_activate','$user_status','".htmlspecialchars($_POST['kpp_new'])."','".htmlspecialchars($_POST['tel_code_new'])."')";
$result=mysql_query($sql);
return "DONE";
}
else return $flag;
}

function GetUserActivite($userID){
global $SysValue,$LoadItems;
$admoption=unserialize($LoadItems['System']['admoption']);
$userID=stripslashes($userID);

$nowData=date("U")-432000;
$sql="delete from ".$SysValue['base']['table_name27']."
where datas<'$nowData' and enabled='0'";
$result=mysql_query($sql);
$sql="select name from ".$SysValue['base']['table_name27']." where status='$userID' LIMIT 0, 1";
$result=mysql_query($sql);
@$row = mysql_fetch_array(@$result);
$name=$row['name'];
if(!empty($name)){

// ���������� ������
$sql="UPDATE ".$SysValue['base']['table_name27']."
SET
enabled='1',
status='".$admoption['user_status']."' 
where status='$userID'";
$result=mysql_query($sql);


$disp='
<div id=allspec>
<img src="images/shop/icon_security.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������������� �����������</b>
</div>
<p>
��������� ������������ <b>'.$name.'</b> ���������. �������� ����������� ��� ��������� ����������� ������������ ������ � ��������-���������.
 </p>';
} else {
$disp='
<div id=allspec>
<img src="images/shop/icon_security.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������������� �����������</b>
</div>
<p>
��������� ������������ �� ���������. �������� ��������� <a href="/users/register.html" class="b">�����������</a> ��� ��������� ����������� ������������ ������ � ��������-���������.
 </p>';
}
return $disp;
}

// ����������� ������ ������������
function GetUserRegister(){
global $SysValue,$SERVER_NAME,$LoadItems,$REMOTE_ADDR;
$admoption=unserialize($LoadItems['System']['admoption']);

if($_POST['add_user']==1)
$UserAddData=UserAddData();


if($UserAddData=="DONE" and $admoption['user_mail_activate'] == 1){
  $disp='
<div id=allspec>
<img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�����������</b>
</div>
<p>
�� ��� ����� <b>'.$_POST['mail_new'].'</b> ���� ���������� ��������� ��� ��������� ����������� ������������ <b>'.$_POST['name_new'].'</b>.<br>
����� ��������� ��� ����� �������� �������������� ����������� ������ � ��������-���������.
 </p>';
 
// ���� ���� ���������
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:  User Activation <donotreply@".str_replace("www.","",$SERVER_NAME).">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." - ��������� ����������� ������������ ".$_POST['name_new'];
$content_adm="
������� �������!
--------------------------------------------------------

��� ��������� ����������� ������������ '".$_POST['name_new']."' �������� �� ������
http://".$SERVER_NAME.$SysValue['dir']['dir']."/users/useractivite.html?key=".md5($_SESSION['sid'])."
����� ��������� ��� ����� �������� �������������� ����������� ������ � ��������-���������. 

������ �������
--------------

�����: ".$_POST['login_new']."
������: ".$_POST['password_new']."


����/�����: ".date("d-m-y H:i a")."
IP:".$REMOTE_ADDR."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($_POST['mail_new'],$zag_adm, $content_adm, $header_adm);
}
elseif($UserAddData=="DONE" and $admoption['user_mail_activate'] != 1){
  $disp='
<div id=allspec>
<img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�����������</b>
</div>
<p>
����������� ������ ������������ <b>'.$_POST['name_new'].'</b> ������ �������.<br>
���������� ������������� ��� ������� � ����������� ������������ ��������-��������.
 </p>';
}
else {
$disp='
<div id=allspec>
<img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�����������</b>
</div>
<form name="users_data" method="post">
<p><table>
<tr>
	<td>�����:</td>
	<td width="10"></td>
	<td><input type="text" name="login_new" style="width:250px;" value="'.$_POST['login_new'].'"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
	<td rowspan="2" valign="top" style="padding-left:10">
	</td>
</tr>
<tr>
	<td>������:</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new" style="width:250px;" value="'.$_POST['password_new'].'"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td>��������� ������:</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new2" style="width:250px;" value=""><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
</table></p>
<div id=allspec>
<img src="images/shop/icon_user.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������ ������</b>
</div>
<table width=\"99%\" cellpadding=\"5\">
<tr>
   <td colspan="2"><p><br></p></td>
</tr>
<tr>
	<td>���������� ����:&nbsp;&nbsp;&nbsp;
	</td>
	<td><input type="text" name="name_new" style="width:300px" value="'.$_POST['name_new'].'"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td>E-mail:
	</td>
	<td><input type="text" name="mail_new" style="width:300px" value="'.$_POST['mail_new'].'"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td>��������: </td>
	<td><input type="text" name="company_new" style="width:300px;" value="'.$_POST['company_new'].'"></td>
</tr>
<tr>
	<td>���:</td>
	<td><input type="text" name="inn_new" style="width:300px;" value="'.$_POST['inn_new'].'"></td>
</tr>
<tr>
	<td>���:</td>
	<td><input type="text" name="kpp_new" style="width:300px;" value="'.$_POST['kpp_new'].'"></td>
</tr>
<tr>
	<td>�������:</td>
	<td><input type="text" name="tel_code_new" style="width:50px;" value="'.$_POST['tel_code_new'].'"> - 
<input type="text" name="tel_new" style="width:240px;" value="'.$_POST['tel_new'].'"></td>
</tr>
<tr>
	<td>�����:</td>
	<td><textarea style="width:300px; height:100px;" name="adres_new">'.$_POST['adres_new'].'</textarea>

</td>
</tr>
</table>
<table>
<tr>
	<td align="right"><IMG id="captcha" src="../phpshop/captcha.php" border=0><br>
	<a href="javascript:CapReload()">�������� ��������</a>
	</td>
	<td>������� ���, ��������� �� ��������<br><input type="text" name="key" style="width:220px;"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
   <td colspan="2">	<br>
<div  id=allspec><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>
<ol>
'.$UserAddData.'
</ol>

</div>
<br></td>
</tr>
<tr>
	<td></td>
	<td>
	<input type="hidden" value="1" name="add_user">
<input type="button" value="����������� ������������" onclick="CheckNewUserForma()"></td>
</tr>
</table>
</form>
';
}
return $disp;
}


function GetUsersStatus($n){
global $SysValue;
$n=TotalClean($n,1);
$sql="select name,discount from ".$SysValue['base']['table_name28']." where id=$n";
$result=mysql_query($sql);
$row = mysql_fetch_array(@$result);
$num=mysql_num_rows(@$result);
if($num>0) return $row['name']." - ".$row['discount']."% ������";
else return "�������������� ������������";
}

// ��������� ������
function UserUpdateData($UsersId){
global $SysValue,$_POST;
$UsersId=TotalClean($UsersId,1);
$flag="";

if(!true_email($_POST['mail_new'])) $flag.="<li>������������ e-mail";
if(strlen($_POST['name_new']) <3) $flag.="<li>������������ ���";

if($flag==""){
$sql="UPDATE ".$SysValue['base']['table_name27']."
SET
mail='".$_POST['mail_new']."',
name='".htmlspecialchars($_POST['name_new'])."',
company='".htmlspecialchars($_POST['company_new'])."',
inn='".htmlspecialchars($_POST['inn_new'])."',
tel='".htmlspecialchars($_POST['tel_new'])."',
adres='".htmlspecialchars($_POST['adres_new'])."',
kpp='".htmlspecialchars($_POST['kpp_new'])."',
tel_code='".htmlspecialchars($_POST['tel_code_new'])."' 
where id='$UsersId'";
$result=mysql_query($sql);
$flag="<li class=done>������ ��������</font>";
}
return $flag;
}


// ��������� ������
function UserUpdatePassword($UsersId){
global $SysValue,$_POST;
$UsersId=TotalClean($UsersId,1);
$flag="";

if($_POST['password_new'] != $_POST['password_new2']) $flag.="<li>������ �� ���������";
if(!true_login($_POST['login_new'])) $flag.="<li>������������ �����";
if(!true_passw($_POST['password_new'])) $flag.="<li>������������ ������";

if($flag==""){
$sql="UPDATE ".$SysValue['base']['table_name27']."
SET
login='".$_POST['login_new']."',
password='".base64_encode($_POST['password_new'])."'
where id='$UsersId'";
$result=mysql_query($sql);
$flag="<li class=done>������ ��������</font>";
}
return $flag;
}

// ��������� �������
function UsersMessage($UsersId){
$UsersId=TotalClean($UsersId,1);
global $SysValue,$_POST,$LoadItems,$REMOTE_ADDR;
$sql="select * from ".$SysValue['base']['table_name27']." where id=$UsersId LIMIT 0, 1";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
      $id=$row['id'];
      $login=$row['login'];
	  $password=$row['password'];
	  $status=$row['status'];
	  $mail=$row['mail'];
	  $name=$row['name'];
	  $company=$row['company'];
	  $inn=$row['inn'];
	  $tel=$row['tel'];
	  $adres=$row['adres'];
	  
	  
// ���� ���� ���������
if(@$_POST['message']){
$codepage  = "windows-1251";     
$header_adm  = "MIME-Version: 1.0\n";
$header_adm .= "From:   <".$mail.">\n";
$header_adm .= "Content-Type: text/plain; charset=$codepage\n";
$header_adm .= "X-Mailer: PHP/";
$zag_adm=$LoadItems['System']['name']." - ��������� ��������� �� ������������ ".$name;
$content_adm="
������� �������!
--------------------------------------------------------

�������� ������ � ��������-�������� '".$LoadItems['System']['name']."'
�� ������������ ".$name."

�����: ".$login."
������: ".GetUsersStatus($status)."
---------------------------------------------------------

".TotalClean($_POST['message'],2)."

����/�����: ".date("d-m-y H:i a")."
IP:".$REMOTE_ADDR."
---------------------------------------------------------


Powered & Developed by www.PHPShop.ru
".$SysValue['license']['product_name'];
mail($LoadItems['System']['adminmail2'],$zag_adm, $content_adm, $header_adm);
$statusMail='
<div id=allspecwhite>
<img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><font color="#008000"><b>��������� ��������� ����������</b></font></div>
';
}
	  
	  
$disp='
<p><br></p>

<div id=allspec>
<img src="images/shop/icon_info.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������ ������ ��������� �� �����</b> 
</div>
<p>
<table>
<tr>
  <td >
  <form method="post" name="forma_message">
  <textarea style="width:400px;height:100px;" name="message" id="message"></textarea>
  '.@$statusMail.'<br>
  <div>
  <input type="button" value="������ ������ ���������" onclick="CheckMessage()">
  </div>
  </form>
  </td>
</tr>
</table>

</p>
<p><br></p>
';
return $disp;
}


// ������ ������
function UsersRom($UsersId){
global $SysValue,$_POST;

$UsersId=TotalClean($UsersId,1);

// ��������� ������
if(@$_POST['update_user']==1)
   $UserUpdate=UserUpdateData($UsersId);


if(@$_POST['update_password']==1)
  if(@$_POST['password_chek']==1) $UserUpdatePassword=UserUpdatePassword($UsersId);



$sql="select * from ".$SysValue['base']['table_name27']." where id=$UsersId LIMIT 0, 1";
$result=mysql_query($sql);
$row = mysql_fetch_array($result);
      $id=$row['id'];
      $login=$row['login'];
	  $password=$row['password'];
	  $status=$row['status'];
	  $mail=$row['mail'];
	  $name=$row['name'];
	  $company=$row['company'];
	  $inn=$row['inn'];
	  $kpp=$row['kpp'];
	  $tel=$row['tel'];
	  $tel_code=$row['tel_code'];
	  $adres=$row['adres'];
	  
$disp='
<p><br></p>

<div id=allspec>
<img src="images/shop/rosette.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������</b>
</div>
<p>'.GetUsersStatus($status).'
</p>
<div id=allspec>
<img src="images/shop/icon_key.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>�����������</b>
</div>
<form name="users_password" method="post">
<p><table>
<tr>
	<td>�����:</td>
	<td width="10"></td>
	<td><input type="text" name="login_new" value="'.$login.'" style="width:250px;" ><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
	<td rowspan="2" valign="top" style="padding-left:10">
	</td>
</tr>
<tr>
	<td>������:</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new" style="width:250px;" value="'.base64_decode($password).'"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr id="password" style="display: none;">
	<td>��������� ������:</td>
	<td width="10"></td>
	<td><input type="Password" name="password_new2" style="width:250px;" value=""><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td></td>
	<td width="10"></td>
	<td><input type="checkbox" id="password_chek" value="1" name="password_chek" onclick="DispPasDiv()"> �������� �����������&nbsp;&nbsp;&nbsp;
<input type="hidden" value="1" name="update_password">
<input type="button" value="��������" onclick="UpdateUserPassword()">
</td>
</tr>
</table></p>
</form>
<form name="users_data" method="post">
<div id=allspec>
<img src="images/shop/icon_user.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"><b>������ ������</b>
</div>
<table width=\"99%\" cellpadding=\"5\">
<tr>
   <td colspan="2"><p><br></p></td>
</tr>
<tr>
	<td>���������� ����:&nbsp;&nbsp;&nbsp;
	</td>
	<td><input type="text" name="name_new" value="'.$name.'" style="width:300px"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td>E-mail:
	</td>
	<td><input type="text" name="mail_new" value="'.$mail.'" style="width:300px"><img src="images/shop/flag_green.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle"></td>
</tr>
<tr>
	<td>��������: </td>
	<td><input type="text" name="company_new" style="width:300px;" value="'.$company.'"></td>
</tr>
<tr>
	<td>���:</td>
	<td><input type="text" name="inn_new" style="width:300px;" value="'.$inn.'"></td>
</tr>
<tr>
	<td>���:</td>
	<td><input type="text" name="kpp_new" style="width:300px;" value="'.$kpp.'"></td>
</tr>
<tr>
	<td>�������:</td>
	<td><input type="text" name="tel_code_new" style="width:50px;" value="'.$tel_code.'"> -
<input type="text" name="tel_new" style="width:240px;" value="'.$tel.'"></td>
</tr>
<tr>
	<td valign="top">�����:</td>
	<td><textarea style="width:300px; height:100px;" name="adres_new">'.$adres.'</textarea>
</td>
</tr>
<tr>
	<td valign="top" colspan="2">
<br>
<div  id=allspec><img src="images/shop/comment.gif" alt="" width="16" height="16" border="0" hspace="5" align="absmiddle">������, ���������� <b>��������</b> ����������� ��� ����������.<br>
<ol>'.@$UserUpdate.@$UserUpdatePassword.'</ol>
</div><br>
<input type="hidden" value="1" name="update_user">
<input type="button" value="�������� ������" onclick="UpdateUserForma()">
</td>
</tr>
</form>
</table>
<p><br></p>
';
return $disp;
}
?>
