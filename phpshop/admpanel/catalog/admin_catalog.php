<?
function Catalog() {
    global $table_name,$PHP_SELF,$categoryID,$systems,$pid;

    $GetSystems=GetSystems();
    $systems=$GetSystems;
    $option=unserialize($GetSystems['admoption']);

    if($option['prevpanel_enabled'] == 1) $prevpanel_enabled="checked";




    return "

<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
<tr>
	<td id=pane align=center width=\"295\"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5 ><span name=txtLang id=txtLang>��������</span></td>
    <td rowspan=2 valign=top width=\"100%\">
<iframe id=interfacesWin1 src=\"catalog/admin_cat_content.php\" width=\"100%\" height=\"400\"  name=\"frame2\" id=\"frame2\" frameborder=\"0\" scrolling=\"Auto\"></iframe>

<div style=\"padding:5px\">
<input type=\"hidden\" value=\"\" id=\"prevpanel_mem\">
<FIELDSET>
	  <LEGEND><input type=\"checkbox\" id=\"prevpanel_act\" value=\"1\" onclick=\"ClosePanelProductDisp()\" $prevpanel_enabled> ���������� ������, �������� � �������������� ������</LEGEND>
<div id='prevpanel' style=\"padding:5px;width:100%\">

</div>
	 </FIELDSET>
	</td>
</tr>
</div>


<tr valign=\"top\">
	<td id=\"catalog_products\"><iframe id=interfacesWin2  src=\"catalog/tree.php\" width=\"300\"  height=\"550\"  scrolling=\"Auto\" name=\"frame1\" id=\"frame1\"></iframe>

<div align=\"center\" style=\"padding:5\">
<table cellpadding=\"0\" cellspacing=\"0\">
  <tr>
  <td class=\"butoff\"><img name=imgLang src=\"icon/chart_organisation_add.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.openAll()\">
    </td>
   	<td width=\"10\"></td>
	<td width=\"1\" bgcolor=\"#ffffff\"></td>
	<td width=\"1\" bgcolor=\"#808080\"></td>
   <td width=\"5\"></td>
	<td  class=\"butoff\"><img name=imgLang src=\"icon/chart_organisation_delete.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.closeAll()\"></td>
  </tr>
</table>
</div>

</td>
</tr>
</table>
            ";
}

function Disp_cat_new($category)// ����� ��������� � ��������
{
    global $table_name;
    $sql="select name from $table_name where id='$category'";
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name=$row['name'];
    return $name;
}

function Cat_prod_disp_new()// ������� ���������
{
    global $table_name;
    $sql="select * from $table_name where parent_to='0' order by num";
    $result=mysql_query($sql);
    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        @$dis_cat.="$name/pid=$id".Cat_prod_disp_pod_new($id)."#";
    }
    $leng=strlen($dis_cat);
    $dis_cat=substr($dis_cat,0,$leng-1);
    $dis_cat=eregi_replace("t","�",$dis_cat);
    return @$dis_cat;
}

function Cat_prod_disp_pod_new($parent)// ������� ������������
{
    global $table_name,$PHP_SELF;
    $sql="select * from $table_name where parent_to='$parent' order by num";
    $result=mysql_query($sql);
    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        @$name_cat.="&$name (".Cat_prod_disp_num_new($id).")/pid=$id";
    }
    return @$name_cat;
}

function Cat_prod_disp_num_new($n)// ����� ���-�� ������� �� ������� �����������
{
    global $table_name2;
    $sql="select id from $table_name2 where category='$n'";
    $result=mysql_query($sql);
    $num=mysql_num_rows($result);
    return $num;
}

function CategoryID($categoryID)// ������� ��������� � ����� � ������ ����
{
    global $SysValue,$table_name2,$pid,$_SESSION,$UserStatus;
    if($categoryID=="all") $sql="select * from $table_name2 order by datas desc";
    else $sql="select * from $table_name2 where category='$categoryID' order by num desc";
    $result=mysql_query($sql);
    $num=0;
    while(@$row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        $price=$row['price'];
        $sklad=$row['sklad'];
        $parent=$row['parent'];
        $parent_enabled=$row['parent_enabled'];
        if(($row['enabled'])=="1") {
            $checked="<img src=../img/icon-activate.gif name=imgLang  title=\"� �������\">";
        }else {
            $checked="<img src=../img/icon-deactivate.gif name=imgLang  title=\"�����������\">";
        };
        if(($row['spec'])=="1") {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-acl.gif  title=\"���������������\">";
        }
        if(($row['yml'])=="1") {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-banner.gif   title=\"YML �����\">";
        }

        if(!empty($row['pic_small'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-filetype-jpg.gif   title=\"�����������\">";
        }

        if(!empty($row['description'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/page_code.gif   title=\"��������\">";
        }

        if(($row['newtip'])=="1") $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-move-banner.gif   title=\"�������\">";
        if(($row['sklad'])=="1") $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/cart_error.gif   title=\"�����������, ��� �����\">";
        if($parent_enabled==1) $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/plugin.gif   title=\"������ ������\" >";
        $uid=$row['uid'];
        $items =$row['items'];
        $ed_izm=$row['ed_izm'];

        if(empty($ed_izm)) $ed_izm="��.";

        $baseinputvaluta=$row['baseinputvaluta'];

        $vsql="select dengi from ".$SysValue['base']['table_name3'];
        $vresult=mysql_query($vsql);
        $vrow = mysql_fetch_array($vresult);
        $defaultvaluta=$vrow['dengi'];

        if ($defaultvaluta==$baseinputvaluta) {
            $baseinputvaluta='';
        }


        //���� ��������� �������� ������ ������ ������������ ���� ���� � ����������� if ����)
        /*
	if (!$baseinputvaluta) {
		$vsql="select dengi from ".$SysValue['base']['table_name3'];
		$vresult=mysql_query($vsql);
		$vrow = mysql_fetch_array($vresult);
		$baseinputvaluta=$vrow['dengi'];

	}
        */
        if ($baseinputvaluta) {
            $sqlv="select * from ".$SysValue['base']['table_name24']." WHERE id=\"".$baseinputvaluta."\"";
            $resultv=mysql_query($sqlv);
            $vrow = mysql_fetch_array($resultv);
            $viso=' '.$vrow['code'];
        } else {
            $viso='';
        }

        @$dis.="
	<tr class=row3 id=\"r".$id."\">
	  <td align=center   align=\"left\"  id=Nws class=Nws  onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\">
                $checked
	  </td>
	  <td width=\"55\"  align=\"center\"  id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\">
                $id
	  </td>
	  <td width=\"500\"   id=Nws class=Nws onmouseover=\"show_on('r".$id."');DoUpdateProductDisp(".$id.");\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;$name  
	  </td>
	  <td width=\"100\"   id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;".$items ." ".$ed_izm."
	  </td>
	  <td width=\"100\"   id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;".($price*1).$viso."
	  </td>
	  <td align=center>
	  <input type=\"checkbox\" value=\"".$id."\">
	  </td>
	</tr>
	";
        $num++;
    }


    $disp="
<form name=\"form_flag\">
<table cellpadding=0 bgcolor=808080 border=0 cellspacing=1 width=100% class=\"sortable\" id=\"sort\">
<tr valign=\"top\">
	<td width=\"100\" id=pane align=center><img  src=\"../icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\" onLoad=\"starter('product');\"><span name=txtLang  id=txtLang>�����</span></td>
    <td width=\"55\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>ID</td>
	<td width=\"540\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
   <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�����</td>
    <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����</td>
	<td width=\"25\" id=pane align=center>&plusmn;</td>
</tr>
".@$dis."



</table>
</form>
<input type=\"hidden\" value=\"$pid\" id=\"catal\" name=\"catal\">
    <input type=\"hidden\" value=\"$pid\" id=\"catal_chek\" name=\"catal_chek\">
            ".'
<div class=cMenu id=cMenuNws> 
	<TABLE style="width:260px;"  border="0" cellspacing="0" cellpadding="0">

	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>��������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews14>��������� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews9>������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews23>������� �� ��������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews24>������� � ���������������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews8>������� � Excel (1C)</A></TD></TR>	
	</TABLE>

	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>�������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A  name="tarurl" id=nameNews10>�������� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews11>������ �� �������</A></TD></TR>	
	</TABLE>
	
	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>���������������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews2>�������� � ���������������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews3>������ �� ���������������</A></TD></TR>	
	</TABLE>
	
	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>�����</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews27>��� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews28>���� � �������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews4>��������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews5>�������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews1>������� �� ����</A></TD></TR>	
	</TABLE>

	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>YML ������ ������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews6>������ �� YML ������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews7>�������� � YML �����</A></TD></TR>	
	</TABLE>
</div>

';
    return $disp;
}


function CategorySearch($words) //�����
{
    global $table_name,$table_name2,$pid;
    $sql="select * from $table_name2 where name LIKE '%$words%' or id='$words' or uid='$words' order by num";
    $result=mysql_query($sql);
    $num=0;
    while(@$row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        $price=$row['price'];

        $scategory=$row['category'];
        $low=0;
        /*
	while ($scategory!=="0") {
		$sqlcat="select parent_to,secure_groups from $table_name where id=$scategory";
		$resultcat=mysql_query($sqlcat);
		$rowcat = mysql_fetch_array($resultcat);
		$secure_groups=$rowcat['secure_groups'];
		$scategory=$rowcat['parent_to'];
		if (strlen($secure_groups)) {
			$ider=trim($_SESSION['idPHPSHOP']);
			$string='i'.$ider.'-1i';
			if (strpos($secure_groups,$string) ===false) {
				    $low=1; break;
			}
		}
	}
	if ($low) {continue;}
        */

        if(($row['enabled'])=="1") {
            $checked="<img src=../img/icon-activate.gif  title=\"� �������\">";
        }else {
            $checked="<img src=../img/icon-deactivate.gif   title=\"�����������\">";
        };
        if(($row['spec'])=="1") {
            $checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-acl.gif  title=\"���������������\">";
        }
        if(($row['yml'])=="1") {
            $checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-banner.gif   title=\"YML �����\">";
        }
        if(($row['newtip'])=="1") $checked.="&nbsp;&nbsp;<img src=../img/icon-move-banner.gif   title=\"�������\">";

        if(!empty($row['pic_small'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-filetype-jpg.gif   title=\"�����������\">";
        }

        if(!empty($row['description'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/page_code.gif   title=\"��������\">";
        }
        $uid=$row['uid'];
        @$dis.="
	<tr class=row3 bgcolor=ffffff   id=\"r".$id."\" >
	  <td align=center width=\"93\"  align=\"left\"  id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\">
<A id='ID$id'></A>
                $checked
	  </td>
	  <td width=\"55\"  align=\"center\"  id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\">
                $id
	  </td>
	  <td width=\"540\"   id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;$name
	  </td>
	  <td width=\"100\"   id=Nws class=Nws onmouseover=\"show_on('r".$id."')\" onmouseout=\"show_out('r".$id."')\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',650,630)\"> 
	  &nbsp;$price
	  </td>
	  <td >
	  <input type=\"checkbox\" value=\"".$id."\">
	  </td>
	</tr>
	";
        $num++;
    }

    


    $disp="
<table cellpadding=0 bgcolor=808080 border=0 cellspacing=1 width=100% class=\"sortable\" id=\"sort\">
<form name=\"form_flag\">
<tr valign=\"top\">
	<td width=\"100\" id=pane align=center><img  src=\"../icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\" onLoad=\"starter('product');\"><span name=txtLang  id=txtLang>�����</span></td>
    <td width=\"55\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>ID</td>
	<td width=\"540\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
    <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����</td>
	<td width=\"25\" id=pane align=center>&plusmn;</td>
</tr>
".@$dis."

</form>

</table>
".'
<div class=cMenu id=cMenuNws> 
	<TABLE style="width:260px;"  border="0" cellspacing="0" cellpadding="0">

	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>��������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews14>��������� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews9>������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews23>������� �� ��������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews24>������� � ���������������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews8>������� � Excel (1C)</A></TD></TR>	
	</TABLE>

	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>�������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A  name="tarurl" id=nameNews10>�������� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews11>������ �� �������</A></TD></TR>	
	</TABLE>
	
	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>���������������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews2>�������� � ���������������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews3>������ �� ���������������</A></TD></TR>	
	</TABLE>
	
	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>�����</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews27>��� � �������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews28>���� � �������</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews4>��������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews5>�������� �����</A></TD></TR>	
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews1>������� �� ����</A></TD></TR>	
	</TABLE>

	<TABLE style="width:260px;" border="0" cellspacing="0" cellpadding="0">
	<TR><TD id="txtLang" STYLE="background: #C0D2EC;"><B>YML ������ ������</B></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews6>������ �� YML ������</A></TD></TR>
	<TR><TD id="txtLang" STYLE="background: #fff"><A name="tarurl" id=nameNews7>�������� � YML �����</A></TD></TR>	
	</TABLE>
</div>

';
    return $disp;
}
?>