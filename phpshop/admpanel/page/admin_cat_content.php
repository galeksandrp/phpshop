<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

// �����
$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);
$Lang=$option['lang'];
require("../language/".$Lang."/language.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$SysValue['Lang']['System']['charset']?>">
<LINK href="../css/texts.css" type=text/css rel=stylesheet>
<LINK href="../css/contextmenu.css" type=text/css rel=stylesheet>
<script language="JavaScript" src="../java/contextmenu.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../language/<?
echo $Lang; ?>/language_windows.js"></script>
<script language="JavaScript1.2" src="../java/javaMG.js" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript1.2" src="../java/sorttable.js"></script>

</head>
<body style="background: threedface; color: windowtext;" topmargin="0" rightmargin="3" leftmargin="3"  onload="DoCheckLang(location.pathname,<?=$SysValue['lang']['lang_enabled']?>);preloader(0);">
<table id="loader">
<tr>
	<td valign="middle" align="center">
		<div id="loadmes" onclick="preloader(0)">
<table width="100%" height="100%">
<tr>
	<td id="loadimg"></td>
	<td ><b><?=$SysValue['Lang']['System']['loading']?></b><br><?=$SysValue['Lang']['System']['loading2']?></td>
</tr>
</table>
		</div>
</td>
</tr>
</table>

<SCRIPT language=JavaScript type=text/javascript>preloader(1);</SCRIPT>
<?
function PageList($pid,$words="")// ����� 
{
global $SysValue,$SERVER_NAME;
if(!empty($words))
$sql="select * from ".$SysValue['base']['table_name11']." where name REGEXP'".$words."' or link REGEXP'".$words."'";
elseif($pid=="all") $sql="select * from ".$SysValue['base']['table_name11']." order by name";
 else $sql="select * from ".$SysValue['base']['table_name11']." where category=$pid";
 
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$name=$row['name'];
	$link=$row['link'];
	if(($row['enabled'])=="1"){$checked="<img name=imgLang src=../img/icon-activate.gif name=imgLang  alt=\"� �������\">";}else{$checked="<img src=../img/icon-deactivate.gif name=imgLang  alt=\"�����������\">";};
    if(($row['secure'])=="1"){$checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-acl.gif name=imgLang alt=\"������ ��� ������������������ �������������\">";}
	@$display.="
	<tr class=row id=\"r".$id."\">
   <td class=\"forma\" id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" align=center onclick=\"miniWin('adm_pagesID.php?id=$id',650,600)\">$checked</td>
	<td class=\"forma\" id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('adm_pagesID.php?id=$id',650,600)\">
	$link
	</td>
	<td class=\"forma\" id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('adm_pagesID.php?id=$id',650,600)\">
	$name
	</td>
	<td class=\"forma\" id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" >
	<a href=\"".$SysValue['dir']['dir']."/page/".$link.".html\" target=\"_blank\" class=none><img src=\"../img/icon_world.gif\" alt=\"������� �� ������\" border=\"0\" align=\"absmiddle\" hspace=\"1\">".$SERVER_NAME.$SysValue['dir']['dir']."/page/".$link.".html</a>
	</td>
	<td class=forma style=\"padding:0px\">
	<input type=checkbox name='c".$id."' value=\"".$id."\">
	</td>
    </tr>
	";
	@$i++;
	}
if($i>20)$razmer="height:600;";
	$dis="
<div align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<form name=\"form_flag\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
    <td width=\"10%\" id=pane align=center><img  src=\"../icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\" onLoad=\"starter('pages');\" align=left><span name=txtLang id=txtLang>�����</span></td>
    <td width=\"10%\" id=pane align=center><span name=txtLang id=txtLang>������</span></td>
	<td width=\"45%\" id=pane align=center><span name=txtLang id=txtLang>��������</span> (Title)</td>
	<td width=\"35%\" id=pane align=center><span name=txtLang id=txtLang>�������� ����������</span></td>
     <td width=\"25\" id=pane align=center style=\"padding:0px\">
	<input type=checkbox value=1 name=DoAll onclick=\"SelectAllBox(this,form_flag)\"></td>
  
</tr>
	".$display."
    </table></form>
<input type=\"hidden\" value=\"$pid\" id=\"catal\" name=\"catal\">
</div>
	".'
<div class=cMenu id=cMenuNws> 
	<TABLE style="width:260px;"  border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>��������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews30>�������� �����</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews31>��������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews32>�������� �����������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews33>��������� �����������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews34>��������� � �������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews35>�������� ��������������� ������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews39>������� �� ����</A></TD></TR>		
	</TABLE>

</div>

';
return $dis;
}
	
if(isset($pid) or isset($words))
	{
	echo PageList($pid,$words);
	}

?>
</body>
</html>