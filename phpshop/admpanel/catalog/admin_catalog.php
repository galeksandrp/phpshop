<?php

function Catalog() {

    $GetSystems = GetSystems();
    $option = unserialize($GetSystems['admoption']);

    if ($option['prevpanel_enabled'] == 1)
        $prevpanel_enabled = "checked";




    return "

<table cellpadding=\"0\" cellspacing=\"1\" width=\"100%\" border=\"0\" height=\"85%\">
    <tr>
        <td align=center valign=top width=\"300\" height=\"85%\">
         <div id=\"pane\"><img src=\"img/arrow_d.gif\" width=\"7\" height=\"7\" border=\"0\" hspace=\"5\">��������</div>
            <iframe src=\"catalog/tree.php\" width=\"300\"  height=\"85%\" frameborder=\"0\" scrolling=\"Auto\" name=\"frame1\" id=\"frame1\"></iframe>
             <div align=\"center\" style=\"padding:5\">
                <table cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                        <td id=\"but381\" class=\"butoff\" onmouseover=\"PHPShopJS.button_on(this)\" onmouseout=\"PHPShopJS.button_off(this)\"><img name=imgLang src=\"icon/chart_organisation_add.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.openAll()\">
                        </td>
                        <td width=\"5\"></td>
                        <td width=\"1\" bgcolor=\"#ffffff\"></td>
                        <td width=\"1\" bgcolor=\"#808080\"></td>
                        <td width=\"5\"></td>
                        <td  id=\"but382\" class=\"butoff\" onmouseover=\"PHPShopJS.button_on(this)\" onmouseout=\"PHPShopJS.button_off(this)\"><img name=imgLang src=\"icon/chart_organisation_delete.gif\" alt=\"������� ���\" width=\"16\" height=\"16\" border=\"0\"  onclick=\"window.frame1.d.closeAll()\"></td>
                    </tr>
                </table>
            </div>
</td>
        <td valign=top  width=\"100%\" height=\"90%\">
            <iframe src=\"catalog/admin_cat_content.php\" width=\"100%\" height=\"85%\"  name=\"frame2\" id=\"frame2\" frameborder=\"0\" scrolling=\"Auto\"></iframe>

            <div style=\"padding:5px\">
                <input type=\"hidden\" value=\"\" id=\"prevpanel_mem\">
                <FIELDSET>
                    <LEGEND class=titlelegend><input type=\"checkbox\" id=\"prevpanel_act\" value=\"1\" onclick=\"ClosePanelProductDisp()\" $prevpanel_enabled>���������� ������, �������� � �������������� ������</LEGEND>
                    <div id='prevpanel' style=\"padding:5px;width:100%\">

                    </div>
                </FIELDSET>
        </td>
    </tr>
</table>
            ";
}

function Disp_cat_new($category) {// ����� ��������� � ��������
    global $table_name;
    $sql = "select name from $table_name where id='$category'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $name = $row['name'];
    return $name;
}

function Cat_prod_disp_new() {// ������� ���������
    global $table_name;
    $sql = "select * from $table_name where parent_to='0' order by num";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        @$dis_cat.="$name/pid=$id" . Cat_prod_disp_pod_new($id) . "#";
    }
    $leng = strlen($dis_cat);
    $dis_cat = substr($dis_cat, 0, $leng - 1);
    $dis_cat = eregi_replace("t", "�", $dis_cat);
    return @$dis_cat;
}

function Cat_prod_disp_pod_new($parent) {// ������� ������������
    global $table_name;
    $sql = "select * from $table_name where parent_to='$parent' order by num";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        @$name_cat.="&$name (" . Cat_prod_disp_num_new($id) . ")/pid=$id";
    }
    return @$name_cat;
}

function Cat_prod_disp_num_new($n) {// ����� ���-�� ������� �� ������� �����������
    global $table_name2;
    $sql = "select id from $table_name2 where category='$n'";
    $result = mysql_query($sql);
    $num = mysql_num_rows($result);
    return $num;
}

function CategoryID($categoryID) {// ������� ��������� � ����� � ������ ����
    global $SysValue;

    if ($categoryID == "all")
        $sql = "select * from " . $SysValue['base']['products'] . " order by datas desc";
    else
        $sql = "select * from " . $SysValue['base']['products'] . " where category=" . intval($categoryID) . " order by num desc";

    $result = mysql_query($sql);
    $num = 0;
    $numRows = 0;
    $dis = null;
    while (@$row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $parent_enabled = $row['parent_enabled'];
        if (($row['enabled']) == "1") {
            $checked = "<img src=../img/icon-activate.gif name=imgLang  title=\"� �������\">";
        } else {
            $checked = "<img src=../img/icon-deactivate.gif name=imgLang  title=\"�����������\">";
        };
        if (($row['spec']) == "1") {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-acl.gif  title=\"���������������\">";
        }
        if (($row['yml']) == "1") {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-duplicate-banner.gif   title=\"YML �����\">";
        }

        if (!empty($row['pic_small'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-filetype-jpg.gif   title=\"�����������\">";
        }

        if (!empty($row['description'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/page_code.gif   title=\"��������\">";
        }

        if (($row['newtip']) == "1")
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-move-banner.gif   title=\"�������\">";
        if (($row['sklad']) == "1")
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/cart_error.gif   title=\"�����������, ��� �����\">";
        if ($parent_enabled == 1)
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/plugin.gif   title=\"������ ������\" >";
        $uid = $row['uid'];
        $items = $row['items'];
        $ed_izm = $row['ed_izm'];

        if (empty($ed_izm))
            $ed_izm = "��.";

        $baseinputvaluta = $row['baseinputvaluta'];

        $vsql = "select dengi from " . $SysValue['base']['table_name3'];
        $vresult = mysql_query($vsql);
        $vrow = mysql_fetch_array($vresult);
        $defaultvaluta = $vrow['dengi'];

        if ($defaultvaluta == $baseinputvaluta) {
            $baseinputvaluta = '';
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
            $sqlv = "select * from " . $SysValue['base']['table_name24'] . " WHERE id=\"" . $baseinputvaluta . "\"";
            $resultv = mysql_query($sqlv);
            $vrow = mysql_fetch_array($resultv);
            $viso = ' ' . $vrow['code'];
        } else {
            $viso = '';
        }

        // ��������� ������ �����
        $numRows++;
        if ($numRows % 2 == 0) {
            $style_r = ' line2';
        } else {
            $style_r = null;
        }

        if($id==$_SESSION['editProductId']) {
            $style_r = ' prod_hover';
        }

        $dis.="
	<tr class='row $style_r' id=\"r" . $id . "\" onmouseover=\"PHPShopJS.rowshow_on(this)\" onmouseout=\"PHPShopJS.rowshow_out(this,'" . $style_r . "')\">
          <td align=center>
	  <input type=\"checkbox\" value=\"" . $id . "\">
	  </td>	  
          <td align=center   align=\"left\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
                $checked
	  </td>
	  <td width=\"55\"  align=\"center\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
                $id
	  </td>
	  <td width=\"500\"  onmouseover=\"DoUpdateProductDisp(" . $id . ");\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;$name
	  </td>
	  <td width=\"100\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;" . $items . " " . $ed_izm . "
	  </td>
	  <td width=\"100\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;" . ($price * 1) . $viso . "
	  </td>
	</tr>
	";
        $num++;
    }


    $disp = "
<form name=\"form_flag\">
<table cellpadding=0 cellspacing=1 width=100% class=\"sortable\" id=\"sort\">
<tr valign=\"top\">
	<td width=\"25\" id=pane align=center>&plusmn;</td>
	<td width=\"100\" id=pane align=center><img  src=\"../icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\" ><span name=txtLang  id=txtLang>�����</span></td>
    <td width=\"55\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>ID</td>
	<td width=\"540\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
   <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�����</td>
    <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����</td>
</tr>
" . $dis . "



</table>
</form>
<input type=\"hidden\" value=\"" . $_GET['pid'] . "\" id=\"catalog_products\" name=\"catalog_products\">
<input type=\"hidden\" value=\"" . $_GET['pid'] . "\" id=\"catal\" name=\"catal\">
<input type=\"hidden\" value=\"" . $_GET['pid'] . "\" id=\"catal_chek\" name=\"catal_chek\">
";
    return $disp;
}

// ����� �� ���������������
function getSort($words) {
    global $SysValue;
    $array = explode(":", $words);
    $sort_name = $array[0];
    $sort_value = $array[1];

    $sql = "select * from " . $SysValue['base']['sort_categories'] . " where name = '$sort_name' limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $sort_name_id = $row['id'];


    $sql = "select * from " . $SysValue['base']['sort'] . " where name = '$sort_value' and category=$sort_name_id limit 1";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    $sort_value_id = $row['id'];

    $hash = $sort_name_id . "-" . $sort_value_id;
    $sort = " or vendor REGEXP 'i" . $hash . "i' ";
    return $sort;
}

function CategorySearch($words) { //�����
    global $SysValue;

    // ����� �� ���������������
    if (strstr($words, ':'))
        $sort = getSort($words);

    $sql = "select * from " . $SysValue['base']['products'] . " where name LIKE '%$words%' or id='$words' or uid='$words' $sort order by num";

    $result = mysql_query($sql);
    $num = 0;
    $numRows = 0;
    while (@$row = mysql_fetch_array($result)) {
        $id = $row['id'];
        $name = $row['name'];
        $price = $row['price'];
        $items = $row['items'];
        $ed_izm = $row['ed_izm'];

        if (empty($ed_izm))
            $ed_izm = "��.";
        $scategory = $row['category'];
        $low = 0;
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

        if (($row['enabled']) == "1") {
            $checked = "<img src=../img/icon-activate.gif  title=\"� �������\">";
        } else {
            $checked = "<img src=../img/icon-deactivate.gif   title=\"�����������\">";
        };
        if (($row['spec']) == "1") {
            $checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-acl.gif  title=\"���������������\">";
        }
        if (($row['yml']) == "1") {
            $checked.="&nbsp;&nbsp;<img src=../img/icon-duplicate-banner.gif   title=\"YML �����\">";
        }
        if (($row['newtip']) == "1")
            $checked.="&nbsp;&nbsp;<img src=../img/icon-move-banner.gif   title=\"�������\">";

        if (!empty($row['pic_small'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../img/icon-filetype-jpg.gif   title=\"�����������\">";
        }

        if (!empty($row['description'])) {
            $checked.="&nbsp;&nbsp;<img name=imgLang src=../icon/page_code.gif   title=\"��������\">";
        }
        $uid = $row['uid'];
        // ��������� ������ �����
        $numRows++;
        if ($numRows % 2 == 0) {
            $style_r = ' line2';
        } else {
            $style_r = null;
        }

        $dis.="
	<tr class='row $style_r' id=\"r" . $id . "\" onmouseover=\"PHPShopJS.rowshow_on(this)\" onmouseout=\"PHPShopJS.rowshow_out(this,'" . $style_r . "')\">
	  <td align=center   align=\"left\" onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
                $checked
	  </td>
	  <td width=\"55\"  align=\"center\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
                $id
	  </td>
	  <td width=\"500\"  onmouseover=\"DoUpdateProductDisp(" . $id . ");\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;$name
	  </td>
	  <td width=\"100\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;" . $items . " " . $ed_izm . "
	  </td>
	  <td width=\"100\"  onclick=\"miniWin('../product/adm_productID.php?productID=$id',720,650)\">
	  &nbsp;" . ($price * 1) . $viso . "
	  </td>
	  <td align=center>
	  <input type=\"checkbox\" value=\"" . $id . "\">
	  </td>
	</tr>
	";
        $num++;
    }




    $disp = "
<form name=\"form_flag\" id=>
<table cellpadding=0 cellspacing=1 width=100% class=\"sortable\" id=\"sort\">
<tr valign=\"top\">
	<td width=\"100\" id=pane align=center><img  src=\"../icon/blank.gif\"  width=\"1\" height=\"1\" border=\"0\"><span name=txtLang  id=txtLang>�����</span></td>
    <td width=\"55\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>ID</td>
	<td width=\"540\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>������������</td>
   <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>�����</td>
    <td width=\"100\" id=pane align=center><img src=../img/arrow_d.gif width=7 height=7 border=0 hspace=5>����</td>
	<td width=\"25\" id=pane align=center>&plusmn;</td>
</tr>
" . $dis . "

</form>

</table>
";
    return $disp;
}

?>