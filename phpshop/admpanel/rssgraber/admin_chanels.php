<?
function RSSchanels()// Вывод 
{
global $SysValue;
$sql="select * from ".$SysValue['base']['table_name38']." order by id";
$result=mysql_query($sql);
while ($row = mysql_fetch_array($result))
    {
	$id=$row['id'];
	$link=$row['link'];
	$day_num=$row['day_num'];
	$news_num = $row['news_num'];
	$start_date = $row['start_date'];
	$end_date = $row['end_date'];
	
	if(($row['enabled'])=="1"){$checked="<img src=img/icon-activate.gif  width=\"16\" height=\"16\" alt=\"В наличии\">";}else{$checked="<img src=img/icon-deactivate.gif  width=\"16\" height=\"16\" alt=\"Отсутствует\">";};
	@$display.="
	<tr onmouseover=\"show_on('r".$id."')\" id=\"r".$id."\" onmouseout=\"show_out('r".$id."')\" class=row onclick=\"miniWin('rssgraber/adm_chanelsID.php?id=$id',400,270,event)\">
    <td align=center class=forma>$checked</td>
    <td class=forma>
	".$link."
	</td>
	<td class=forma>
	".$day_num."
	</td>
	<td class=forma>
	".$news_num."
	</td>
	<td class=forma>
	".$start_date."
	</td>
	<td class=forma>
	".$end_date."
	</td>
    </tr>
	";
	@$i++;
	}
if($i>20)$razmer="height:600;";
	return "
	
<div  id=interfacesWin name=interfacesWin align=\"left\" style=\"width:100%;".@$razmer.";overflow:auto\"> 
<form name=\"form_flag\">
<table width=\"50%\"  cellpadding=\"0\" cellspacing=\"0\" style=\"border: 1px;
	border-style: inset;\">
<tr>
	<td valign=\"top\">
<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" bgcolor=\"#808080\" class=\"sortable\" id=\"sort\">
<tr>
    <td width=\"50\" id=pane align=center><span name=txtLang id=txtLang>Статус</span></td>
	<td id=pane align=center><span name=txtLang id=txtLang>Адрес ленты</span></td>
	<td width=\"100\" id=pane align=center><span name=txtLang id=txtLang>Количество заборов в день</span></td>
    <td width=\"100\" id=pane align=center><span name=txtLang id=txtLang></span>Количество забираемых новостей</td>
    <td width=\"100\" id=pane align=center><span name=txtLang id=txtLang>Дата начала</span></td>
    <td width=\"100\" id=pane align=center><span name=txtLang id=txtLang>Дата конца</span></td>
</tr>

	".$display."

    </table>
	</form>
	</td>
</tr>
    </table>

<div align=\"right\" style=\"padding:10;width:50%\"><BUTTON style=\"width: 15em; height: 2.2em; margin-left:5\"  onclick=\"miniWin('rssgraber/adm_chanels_new.php',400, 270); return false;\">
<img src=\"icon/page_add.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" hspace=\"5\">
<span name=txtLang id=txtLang>Новый RSS канал</span>
</BUTTON></div>
</div>
	";
}
?>
