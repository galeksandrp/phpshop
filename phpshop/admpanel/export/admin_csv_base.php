<?
require("../connect.php");
@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");
require("../enter_to_admin.php");

$GetSystems=GetSystems();
$option=unserialize($GetSystems['admoption']);

function updateCatalog($parent_id,$charID) { //������� ����������� ������� �������������� � ��������
    global $SysValue; //���������� ����������
    $sql2_3='select sort from '.$SysValue['base']['table_name'].' WHERE id="'.$parent_id.'"'; //�������� �������� ���-�
    $result2_3=mysql_query($sql2_3);
    $num2_3=mysql_num_rows(@$result2_3);
    if (!$num2_3) return false; //���� ��������� �����������, ������� �������
    $row2_3 = mysql_fetch_array($result2_3);
    $sorts=unserialize($row2_3['sort']);
    $sel="";//�������� ���������
    if(is_array($sorts)) {
        foreach($sorts as $k=>$v) {
            if ($charID == $v) $sel="selected";
        }
    }
    //��������� �� �������� �� � �������� ����� ID
    if ($sel!="selected") {
        $sorts[]=trim($charID);
        $ss=addslashes(serialize($sorts));
        $sql2_4='UPDATE '.$SysValue['base']['table_name'].' SET sort="'.$ss.'" WHERE id="'.$parent_id.'"'; //��������� ���-�
        $result2_4=mysql_query($sql2_4);
    } //���� �� ��������, �����������
    return true;
} //����� ������� ����������� ������� �������������� � ��������

function charsGenerator($parent_id,$CsvToArray,$addcats) {//������� ���������� ����� ��������������, �������� �������������, ������� ������ �������������, � ��������� �� � ����������. ������ ���������� ������ ������������� ��� ������


    global $_SESSION,$_REQUEST,$SysValue,$testValue; //���������� ����������


    $addcats=split("#",$addcats); //������� ������ �������������� ���������
    if (is_array($addcats)) {
        foreach ($addcats as $id=>$addcat) {
            $addcat=trim($addcat);
            if ($addcat=="") unset($addcats[$id]);
        }
    }

    for ($i=16;$i<count($CsvToArray); $i=$i+2) { //�������� ������������ ��� ������ ����� ��������������� ��������
        $charName=trim($CsvToArray[$i]);
        $charValues=trim($CsvToArray[$i+1]); //�������� ��������
        $charValues=split("&&",$charValues); //��������� && ������ � ������
        //�������� ������������� ��������������
        $sql2='select id,name from '.$SysValue['base']['table_name20'].' WHERE name like "'.$charName.'"'; //�������� �������� ���-�
        $result2=mysql_query($sql2);
        $row2 = mysql_fetch_array($result2);
        $charID=$row2['id'];

        //�������� ���! ���� � ���������� �����-���� ��������� �� ���� ������� ������ �������������� ��� ��������� �������� � ���� ������, ��� �� ����� �������. ���� ���-�� ����� ��������
        if ((strlen($charName)) && ($parent_id!="1000002")) { //���� ��� �������������� ����� ������ � ��������� �� ����� ���������
            //���������� ���! ��������� �� �������� ������������� � ����������, ��� ���� ������� ���� �� ���� �� ������ ��������
            $go=false;
            foreach ($charValues as $charValue) { //�������� � ������ ���������
                $charValue=trim($charValue);
                if (strlen($charValue)) { //���� ���������� �������� ����� �����
                    $go=true;
                }
            }
            unset($charValue); //������� ����������.
            if ($go) {//���� ���� ���� �� ���� �� ������ ��������
                if (!$charID) { //���� �������������� �� �������, ���� ������� ������ � ��������������
                    //������� ������
                    $sql2_1='INSERT INTO '.$SysValue['base']['table_name20'].' (name,category) VALUES("������ '.$charName.'","0")'; //������� ������
                    $result2_1=mysql_query($sql2_1);
                    $group_id=mysql_insert_id(); //�������� ��������� ����������� id - id ������
                    //������� ��������������, ����������� � ������
                    $sql2_2='INSERT INTO '.$SysValue['base']['table_name20'].' (name,category) VALUES("'.$charName.'","'.$group_id.'")'; //������� ���.
                    $result2_2=mysql_query($sql2_2);
                    $charID=mysql_insert_id(); //�������� ��������� ����������� id - id ��������� ��������������
                    if (!(updateCatalog($parent_id,$charID))) { //���� ��� ������� �������� � ��������� �������� ��� �� ��� ������, ���������� ���������� ������������� � ������� ���������
                        $sql2_3='DELETE FROM '.$SysValue['base']['table_name20'].' WHERE id='.$group_id;
                        $result2_3=mysql_query($sql2_3);
                        $sql2_4='DELETE FROM '.$SysValue['base']['table_name20'].' WHERE id='.$charID;
                        $result2_4=mysql_query($sql2_4);
                        $charID=false;
                    }

                } else {//���� �������������� �������, ������ ������� ��������� �� �  �������� �������
                    if (!(updateCatalog($parent_id,$charID))) {
                        $charID=false;
                    }//���� ��� ������� �������� � �������� ��� �� ��� ������, ���������� ���������� �������������
                }//����� ����  �������������� �������
            }//����� ���� ���� ���� �� ���� �� ������ ��������
        } else { //���� ���, �� ���������� ����������
            $charID=false;
        }//����� ���� �� (��� �������������� ����� ������ � ��������� �� ����� ���������)

        if ($charID) { //���� ������� ��������  id �������������� (��� �������) - �������� ������ ��� ����������
            if (count($addcats)>0) { //���� �������� �������������� ��������� (� �� �������� �� ��� ������� ���������)
                foreach ($addcats as $addcat) {
                    updateCatalog($addcat,$charID);
                }//����������� ���������� �������������� �  ������ �������������� ��������� �������
            }

            foreach ($charValues as $charValue) { //�������� � ������ ���������
                $charValue=trim($charValue);
                if (strlen($charValue)) { //���� ���������� �������� ����� �����
                    $sql3='select id,name from '.$SysValue['base']['table_name21'].' WHERE (name like "'.$charValue.'") AND (category="'.$charID.'")'; //�������� �������� ���-�
                    //					$sql3='select id,name from '.$SysValue['base']['table_name21'].' WHERE (name like "'.$charValue.'")'; //�������� �������� ���-�

                    $result3=mysql_query($sql3);
                    $row3 = mysql_fetch_array($result3);
                    $id=$row3['id'];
                    if (!$id) { //���� �� ������� �������� id �������� ��������, ������ ���� �������� �����
                        $sql4='INSERT INTO '.$SysValue['base']['table_name21'].' (name,category) VALUES("'.$charValue.'","'.$charID.'")'; //�������� ����. ���-�
                        $result4=mysql_query($sql4);
                        $id=mysql_insert_id(); //�������� ��������� ����������� id � �� ����� id ����������� � ������
                    }//����� ���� �� ������� �������� id �������� ��������, ������ ���� �������� �����
                    //$testValue2.='('.$id.')';	//DEBUG!!
                    //��������� ������ �� id
                    if ($id) {
                        $resCharsArray[$charID][]=$id;
                    }
                    //$ress=print_r($resCharsArray,1); //DEBUG!!
                    //$testValue2.='('.$ress.')';	//DEBUG!!
                }//����� ���� ���������� �������� ����� �����
            } //����� �������� �������� �������������
        } //����� ���� ������� �������� id ��������������
    } //����� ��������� ���� ����� ����� ������ �������������
    //*/
    return $resCharsArray;
}//����� ������� ���������� ����� ��������������...

class ReadCsv1C {
    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $Sklad_status;
    var $ImagePath="/UserFiles/Image/";
    var $TotalUpdate=0;
    var $TotalCreate=0;


    function ReadCsvRow() {
        $csv_lines  = $this->CsvContent;
        if(is_array($csv_lines)) {
            //������ csv
            $cnt = count($csv_lines);
            for($i = 0; $i < $cnt; $i++) {
                $line = $csv_lines[$i];
                $line = trim($line);
                //��������� �� ��, ��� ����� ���� �������� ������ ������ �������
                $first_char = true;
                //����� �������
                $col_num = 0;
                $length = strlen($line);
                for($b = 0; $b < $length; $b++) {
                    //���������� $skip_char ���������� ������������ �� ������ ������
                    if($skip_char != true) {
                        //���������� ������������/�� ������������ ������
                        $process = true;
                        //���������� ������ ��������� ������� �� ������� �������
                        if($first_char == true) {
                            if($line[$b] == '"') {
                                $terminator = '";';
                                $process = false;
                            }
                            else
                                $terminator = ';';
                            $first_char = false;
                        }

                        //������������� ������ �������, ��������� �� �������
                        if($line[$b] == '"') {
                            $next_char = $line[$b + 1];
                            //��������� �������
                            if($next_char == '"')
                                $skip_char = true;
                            //������ ����� �������
                            elseif($next_char == ';') {
                                if($terminator == '";') {
                                    $first_char = true;
                                    $process = false;
                                    $skip_char = true;
                                }
                            }
                        }

                        //���������� ������� ����� � �������
                        if($process == true) {
                            if($line[$b] == ';') {
                                if($terminator == ';') {

                                    $first_char = true;
                                    $process = false;
                                }
                            }
                        }

                        if($process == true)
                            $column .= $line[$b];

                        if($b == ($length - 1)) {
                            $first_char = true;
                        }

                        if($first_char == true) {

                            $this->CsvToArray[$i][$col_num] = $column;
                            $column = '';
                            $col_num++;
                        }
                    }
                    else
                        $skip_char = false;
                }
            }
        }

    }



    function CleanStr($str) {
        $a= str_replace("\"", "", $str);
        return str_replace("'", "", $a);
    }

    function PrintThis($name,$string) {
        echo"<br><u><em>".$name."</em></u><pre>";
        print_r($string);
        echo"</pre><br>";
    }

    function CsvToArray() {
        return $this->CsvToArray;
    }


    function ReadCsv1C($CsvContent,$table_name2,$sklad_status) {
        $this->CsvContent = $CsvContent;
        $this->TableName = $table_name2;
        $this->Sklad_status = $sklad_status;
        $this->ReadCsvRow();
    }

    function DoUpdatebase1() {
        $CsvToArray = $this->CsvToArray();
        foreach ($CsvToArray as $v)
            @$return.=$this->PrintResultDo($v);
        return $return;
    }

    function DoUpdatebase2() {
        $CsvToArray = $this->CsvToArray();
        foreach ($CsvToArray as $v)
            $this->UpdateBase($v);
    }

    function Zero($a) {
        if($a!=0 or !empty($a)) return 1;
        else return 0;
    }

    function Rip($a) {
        if($a==0) return 1;
        else return 0;
    }

    function CheckBase($uid) {// ��������� ���� �� �����
        $sql="select id from ".$this->TableName." where id='$uid'";
        $result=mysql_query($sql);
        @$num=mysql_num_rows(@$result);
        return @$num;
    }

    function ImagePlus($img) {// ���� � ��������
        $dis=$this->ImagePath.$img;
        return $dis;
    }



    function UpdateBase($CsvToArray) {
        global $_SESSION,$_REQUEST,$testValue;

        $CheckBase=$this->CheckBase($CsvToArray[0]);


        if(!empty($CheckBase) and $CsvToArray[0]!="") {// ���������

            $sql="UPDATE ".$this->TableName." SET ";

// ��������� ����

            if($_REQUEST['tip'][1] == 1) $sql.="name='".str_replace("|",";",trim($CsvToArray[1]))."', ";
            if($_REQUEST['tip'][14] == 1) {

                // ���������
                if(!empty($CsvToArray[14])) $parent_id = $CsvToArray[14];
                else $parent_id = "1000002";
                $sql.="category='".$parent_id."', ";// ���������

            }
// �������� �������
            if($_REQUEST['tip'][2] == 1) $sql.="description='".str_replace("|",";",$CsvToArray[2])."', ";
            if($_REQUEST['tip'][3] == 1) $sql.="pic_small='".$this->ImagePlus($CsvToArray[3])."', ";// ��������� ��������
// ��������� ��������
            if($_REQUEST['tip'][4] == 1) $sql.="content='".str_replace("|",";",$CsvToArray[4])."', ";
            if($_REQUEST['tip'][5] == 1) $sql.="pic_big='".$this->ImagePlus($CsvToArray[5])."', ";// ������� ��������
            if($_REQUEST['tip'][6] == 1) $sql.="price='".$CsvToArray[7]."', ";// ���� 1
            if($_REQUEST['tip'][17] == 1) {
                $sql.="dop_cat='".$CsvToArray[15]."', ";//  �������������� ��������
                $addcats=$CsvToArray[15];
            } else {
                $addcats=false;
            }
// �����
            if($_REQUEST['tip'][11] == 1) {
                switch($this->Sklad_status) {

                    case(3):
                        if($CsvToArray[6]<1) $sql.="sklad='1', ";
                        else $sql.="sklad='0', ";
                        break;

                    case(2):
                        if($CsvToArray[6]<1) $sql.="enabled='0', ";
                        else $sql.="enabled='1', ";
                        break;

                    default: $sql.="";

                }
            }

            if($_REQUEST['tip'][13] == 1) $sql.="uid='".trim($CsvToArray[13])."', ";// �������
            if($_REQUEST['tip'][7] == 1) $sql.="price2='".$CsvToArray[8]."', ";// ���� 2
            if($_REQUEST['tip'][8] == 1) $sql.="price3='".$CsvToArray[9]."', ";// ���� 3
            if($_REQUEST['tip'][9] == 1) $sql.="price4='".$CsvToArray[10]."', ";// ���� 4
            if($_REQUEST['tip'][10] == 1) $sql.="price5='".$CsvToArray[11]."', ";// ���� 5
            if($_REQUEST['tip'][11] == 1) $sql.="items='".$CsvToArray[6]."', ";// �����
            if($_REQUEST['tip'][12] == 1) $sql.="weight='".$CsvToArray[12]."', ";// ���

            $sql.=" datas ='".date("U")."' ";

            $sql.=" where id='".$CsvToArray[0]."'";
            $result=mysql_query($sql); //��������� ������!!
            $this->TotalUpdate++;

// $testValue2='start';
            if($_REQUEST['tip'][15] == 1) {// 16 �������������� 2.0
                $resCharsArray=''; //���������� ������
                $resCharsArray=charsGenerator($parent_id,$CsvToArray,$addcats); //�������� ��������� �������������
                //������������ ������������ ������
                $resSerialized=serialize($resCharsArray);
                $vendor='';
                if(is_array($resCharsArray)) {
                    foreach($resCharsArray as $k=>$v) {
                        if(is_array($v)) {
                            foreach($v as $o=>$p) {
                                @$vendor.="i".$k."-".$p."i";
                            }
                        } else {
                            @$vendor.="i".$k."-".$v."i";
                        }
                    }
                }
                $sql="UPDATE ".$this->TableName." SET ";
                $sql.="vendor='".$vendor."', ";
                $sql.="vendor_array='".$resSerialized."' ";
                $sql.=" where id='".$CsvToArray[0]."'";
//	$testValue2.=$sql.'<HR>'; //DEBUG!!!
                $result=mysql_query($sql); //��������� ������!!

            }//����� ���� �������������� 2.0
            //$testValue2.='end'; //DEBUG!!!


        }else {// ������� ����� �����

// �����
            if($_REQUEST['tip'][11] == 1) {
                switch($this->Sklad_status) {

                    case(3):
                        if($CsvToArray[6]<1) $sklad=1;
                        else $sklad=0;
                        break;

                    case(2):
                        if($CsvToArray[6]<1) $enabled=0;
                        else $enabled=1;
                        break;

                    default:
                        $sklad=0;
                        $enabled=1;
                        break;

                }
            }

// ��������� ����
            if($_REQUEST['tip'][2] != 1) $CsvToArray[2]="";// �������� �������
            if($_REQUEST['tip'][3] != 1) $CsvToArray[3]="";// ��������� ��������
            if($_REQUEST['tip'][4] != 1) $CsvToArray[4]="";// ��������� ��������
            if($_REQUEST['tip'][5] != 1) $CsvToArray[5]="";// ������� ��������
            if($_REQUEST['tip'][6] != 1) $CsvToArray[7]="";// ���� 1
            if($_REQUEST['tip'][7] != 1) $CsvToArray[8]="";// ���� 2
            if($_REQUEST['tip'][8] != 1) $CsvToArray[9]="";// ���� 3
            if($_REQUEST['tip'][9] != 1) $CsvToArray[10]="";// ���� 4
            if($_REQUEST['tip'][10] != 1) $CsvToArray[11]="";// ���� 5
            if($_REQUEST['tip'][11] != 1) $CsvToArray[6]="";// �����
            if($_REQUEST['tip'][12] != 1) $CsvToArray[12]="";// ���
            if($_REQUEST['tip'][13] != 1) $CsvToArray[13]="";// 13 �������
//if($_REQUEST['tip'][17] != 1) $CsvToArray[15]="";// �������������� ��������
            if($_REQUEST['tip'][17] == 1) {
                $addcats=$CsvToArray[15];
            } else {
                $addcats="";
                $CsvToArray[15]="";// �������������� ��������
            }
            if($_REQUEST['tip'][14] == 1) { // 14 ���������

                // ���������
                if(!empty($CsvToArray[14])) $parent_id = $CsvToArray[14];
                else $parent_id = "1000002";
            }else $parent_id = "1000002";

            if($_REQUEST['tip'][15] == 1) {// 16 �������������� 2.0
                $resCharsArray=''; //���������� ������
                $resCharsArray=charsGenerator($parent_id,$CsvToArray,$addcats); //�������� ��������� �������������
                //������������ ������������ ������
                $resSerialized=serialize($resCharsArray);
                $vendor='';
                if(is_array($resCharsArray)) {
                    foreach($resCharsArray as $k=>$v) {
                        if(is_array($v)) {
                            foreach($v as $o=>$p) {
                                @$vendor.="i".$k."-".$p."i";
                            }
                        } else {
                            @$vendor.="i".$k."-".$v."i";
                        }
                    }
                }
                $vendor_array=serialize($resCharsArray);
            }//����� ���� �������������� 2.0

            $sql="INSERT INTO ".$this->TableName."
VALUES ('','".$parent_id."','".trim($CsvToArray[1])."','".$CsvToArray[2]."','".$CsvToArray[4]."','".$CsvToArray[7]."','','','".$this->Zero($CsvToArray[9])."','".$enabled."','".$CsvToArray[13]."','','','".$vendor."','".$vendor_array."','1','','','','','".date("U")."','','".$_SESSION['idPHPSHOP']."','','','','','','','','".$this->ImagePlus($CsvToArray[3])."','".$this->ImagePlus($CsvToArray[5])."','','0','','".$CsvToArray[6]."','".$CsvToArray[12]."','".$CsvToArray[8]."','".$CsvToArray[9]."','".$CsvToArray[10]."','".$CsvToArray[11]."','','".$_REQUEST['tip'][16]."', '','".$CsvToArray[15]."')";

            //$testValue2.=$sql.'<HR>'; //DEBUG!!!
            //if (strlen($testValue)==0) {$testValue=$testValue2;}//DEBUG!!!
            $result=mysql_query($sql);
            $this->TotalCreate++;
        }
    }


    function PrintResultDo($CsvToArray) {
        static $n;
        $disp="
	<tr class='row' style=\"padding:3\" onmouseover=\"show_on('r".$CsvToArray[0]."')\" id=\"r".$CsvToArray[0]."\" onmouseout=\"show_out('r".$CsvToArray[0]."')\">
    <td align=center>".(@$n+1)."</td>
	 <td align=center>".$CsvToArray[0]."</td>
	 <td >".$CsvToArray[1]."</td>
	 <td align=center>".$CsvToArray[7]."</td>
	 <td align=center>".$CsvToArray[8]."</td>
	 <td align=center>".$CsvToArray[9]."</td>
	 <td align=center>".$CsvToArray[10]."</td>
	 <td align=center>".$CsvToArray[11]."</td>
	 <td align=center>".$CsvToArray[6]."</td>
	 <td align=center>".$CsvToArray[12]."</td>
	</tr>
	";
        $n++;
        return $disp;
    }
} //�����

function Ors($n) {
    if($n==0) return "<font color=FF0000>���</font>";
    elseif($n==1) return "��";
    else return "non";
}

// �������� ���������� �����
function getExt($sFileName)//ffilter
{
    $sTmp=$sFileName;
    while($sTmp!="") {
        $sTmp=strstr($sTmp,".");
        if($sTmp!="") {
            $sTmp=substr($sTmp,1);
            $sExt=$sTmp;
        }
    }
    $pos=stristr($sFileName, "php");
    if($pos === false) return strtolower($sExt);
}

require_once "../../lib/JsHttpRequest/JsHttpRequest.php";
$JsHttpRequest =& new JsHttpRequest("windows-1251");

// ����������
$_FILES['file']['ext']=getExt($_FILES['file']['name']);

if($_REQUEST['page']=="predload" and $_FILES['file']['ext']=="csv") {

// ���������
    $copy_file="../csv/".@$_FILES['file']['name'];
    if(move_uploaded_file(@$_FILES['file']['tmp_name'], $copy_file))


    if (is_file($copy_file)) {
        $CsvContent=file($copy_file);
        $ReadCsv = new ReadCsv1C($CsvContent,$table_name2,$option['sklad_status']);
        $interface.='
<div id=interfacesWin name=interfacesWin align="left" style="width:100%;height:580;overflow:auto"> 
<TABLE style="border: 1px;border-style: inset;" cellSpacing=0 cellPadding=0 width="100%"><TBODY>
<TR>
<TD vAlign=top>
<table width="100%" cellpadding="0" cellspacing="1" class="sortable" id="sort" bgcolor="#808080">
<tr>
    <td id="pane" width="50">�</td>
	<td id="pane"><span name=txtLangs id=txtLangs>ID ������</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>�������� ������</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���� 1</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���� 2</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���� 3</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���� 4</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���� 5</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>�����</span></td>
	<td id="pane"><span name=txtLangs id=txtLangs>���</span></td>
</tr>
'.$ReadCsv->DoUpdatebase1().'
</table>
</TD></TR><form method=post action="" encType=multipart/form-data name=forma2></TBODY></TABLE>
</div>
<div align="center" style="padding-top:20">
<button style="WIDTH: 17em; HEIGHT: 2.3em" onclick="DoReload(\'csv_base\')">
<img src="img/icon-setup2.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">
<span name=txtLangs id=txtLangs>������� ������ ����</span></button>
&nbsp;&nbsp;
<button style="WIDTH: 17em; HEIGHT: 2.3em" onclick="DoLoadBase(null,\'load\',\''.$_FILES['file']['name'].'\')">
<img src="img/icon-setup.gif" alt="" width="16" height="16" border="0" align="absmiddle" hspace="5">
<span name=txtLangs id=txtLangs>������� ���������</span></button>
<input type="hidden" id="tip_1" value="'.$_REQUEST['tip'][1].'">
<input type="hidden" id="tip_2" value="'.$_REQUEST['tip'][2].'">
<input type="hidden" id="tip_3" value="'.$_REQUEST['tip'][3].'">
<input type="hidden" id="tip_4" value="'.$_REQUEST['tip'][4].'">
<input type="hidden" id="tip_5" value="'.$_REQUEST['tip'][5].'">
<input type="hidden" id="tip_6" value="'.$_REQUEST['tip'][6].'">
<input type="hidden" id="tip_7" value="'.$_REQUEST['tip'][7].'">
<input type="hidden" id="tip_8" value="'.$_REQUEST['tip'][8].'">
<input type="hidden" id="tip_9" value="'.$_REQUEST['tip'][9].'">
<input type="hidden" id="tip_10" value="'.$_REQUEST['tip'][10].'">
<input type="hidden" id="tip_11" value="'.$_REQUEST['tip'][11].'">
<input type="hidden" id="tip_12" value="'.$_REQUEST['tip'][12].'">
<input type="hidden" id="tip_13" value="'.$_REQUEST['tip'][13].'">
<input type="hidden" id="tip_14" value="'.$_REQUEST['tip'][14].'">
<input type="hidden" id="tip_15" value="'.$_REQUEST['tip'][15].'">
<input type="hidden" id="tip_16" value="'.$_REQUEST['tip'][16].'">
<input type="hidden" id="tip_17" value="'.$_REQUEST['tip'][17].'">
</form></div>
    ';
    }
} elseif($_REQUEST['page']=="load") {
    $copy_file="../csv/".$_REQUEST['name'];
    if (is_file($copy_file)) {
        $CsvContent=file($copy_file);
        $ReadCsv = new ReadCsv1C($CsvContent,$table_name2,$option['sklad_status']);
        $Done2 = $ReadCsv->DoUpdatebase2();
        $interface.='

<TABLE cellSpacing=0 cellPadding=0 width="50%" align="center">
<TR>

<TD vAlign=top style="padding-top:25">
<div align="center"><h4><span name=txtLang2 id=txtLang2>�������� �������� ���� Excel ���������!</span></h4></div>
<FIELDSET id=fldLayout style="width: 60em; height: 8em;">
<table style="border: 1px;border-style: inset;background-color: White;" cellpadding="10" width="100%">
<tr>
	<td width="50%" ><h4><span name=txtLang2 id=txtLang2>��� ��������</span></h4>
<ol>
	<li><span name=txtLang2 id=txtLang2><strong>��� 1</strong> - ������� � ������ <a href="javascript:DoReload(\'cat_prod\')"><img src="img/i_eraser[1].gif" alt="" width="16" height="16" border="0" hspace="3" align="absmiddle">"�������</a> - ����������� ������ - Excel  ����"</span>
    <li><span name=txtLang2 id=txtLang2><strong>��� 2</strong> - �������� ������� ������ � �������� ����� ��� �������� ������ "� ����������� - ��������� � �������". ���� ���������,  ��������� ��������������� ��������.</span></span>
</ol></td>
</tr>
<tr>
	<td width="50%" ><h4><span name=txtLang2 id=txtLang2>�����:</span></h4>
<ol>
	<li>������� ����� �������: '. $ReadCsv->TotalCreate.'
	<li>��������� �������: '. $ReadCsv->TotalUpdate.'
</ol></td>
</tr>
</table>
</FIELDSET>
</TD></TR></TABLE>
    ';

    }
}
else @$interface.=$disp='
	  <table width="100%" height="100%" style="Z-INDEX:2;">
<tr>
	<td valign="middle" align="center">
		<div style="width:400px;height:100px;BACKGROUND: #C0D2EC;padding:10px;border: solid;border-width: 1px; border-color:#4D88C8;FILTER: alpha(opacity=80);" align="left">
<table width="100%" height="100%">
<tr>
	<td width="35" vAlign=center ><IMG 
            hspace=0 src="img/i_support_med[1].gif" align="absmiddle" 
            border=0 ></td>
	<td ><b>��������, �������� ���� � ����������� *.csv.
	���������  <a href="javascript:DoReload(\'csv1c\')" style="color:red">�������� �����</a>.</b></td>
</tr>
</table>

		</div>
</td>
</tr>
</table>
	  
	  ';
//$interface.='test value:<BR>'.$testValue; //DEBUG
$_RESULT = array(
        "name"   => @$_FILES['file']['name'],
        "content"=> @$interface,
        "size"   => @filesize($_FILES['file']['tmp_name']),
); 
?>
