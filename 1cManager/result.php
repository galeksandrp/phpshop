<?php
/*
+-------------------------------------+
|  PHPShop Enterprise Pro 1C          |
|  ������ ���������� �������� 1�      |
+-------------------------------------+
*/

include("login.php");
PHPShopObj::loadClass("readcsv");

// ����������� ������� �������������� � ��������
function updateCatalog($parent_id,$charID) {
    global $SysValue;
    $sql2_3='select sort from '.$SysValue['base']['table_name'].' WHERE id="'.$parent_id.'"';
    $result2_3=mysql_query($sql2_3);
    $num2_3=mysql_num_rows(@$result2_3);
    if (!$num2_3) return false;
    $row2_3 = mysql_fetch_array($result2_3);
    $sorts=unserialize($row2_3['sort']);
    $sel="";

    if(is_array($sorts)) {
        foreach($sorts as $k=>$v) {
            if ($charID == $v) $sel="selected";
        }
    }

    // ��������� �� �������� �� � �������� ����� ID
    if ($sel!="selected") {
        $sorts[]=trim($charID);
        $ss=addslashes(serialize($sorts));
        $sql2_4='UPDATE '.$SysValue['base']['table_name'].' SET sort="'.$ss.'" WHERE id="'.$parent_id.'"';
        $result2_4=mysql_query($sql2_4);
    }
    return true;
} 

// ������� ���������� ����� ��������������
function charsGenerator($parent_id,$CsvToArray) {

    global $SysValue,$testValue;
    for ($i=17;$i<count($CsvToArray); $i=$i+2) { //�������� ������������ ��� ������ ����� ��������������� ��������
        $charName=trim($CsvToArray[$i]);
        $charValues=trim($CsvToArray[$i+1]);
        $charValues=split("&&",$charValues);

        //�������� ������������� ��������������
        $sql2='select id,name from '.$SysValue['base']['table_name20'].' WHERE name like "'.$charName.'"';
        $result2=mysql_query($sql2);
        $row2 = mysql_fetch_array($result2);
        $charID=$row2['id'];

        if (strlen($charName)) {
            $go=false;
            foreach ($charValues as $charValue) {
                $charValue=trim($charValue);
                if (strlen($charValue)) {
                    $go=true;
                }
            }
            unset($charValue);
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

                } else {//���� �������������� �������, ������ ������� ��������� �� � �������� �������
                    if (!(updateCatalog($parent_id,$charID))) {
                        $charID=false;
                    }
                }
            }
        } else {
            $charID=false;
        }


        if ($charID) { //���� ������� ��������  id �������������� (��� �������) - �������� ������ ��� ����������

            foreach ($charValues as $charValue) {
                $charValue=trim($charValue);
                if (strlen($charValue)) {
                    $sql3='select id,name from '.$SysValue['base']['table_name21'].' WHERE (name like "'.$charValue.'") AND (category="'.$charID.'")'; //�������� �������� ���-�
                    $result3=mysql_query($sql3);
                    $row3 = mysql_fetch_array($result3);
                    $id=$row3['id'];
                    if (!$id) { //���� �� ������� �������� id �������� ��������, ������ ���� �������� �����
                        $sql4='INSERT INTO '.$SysValue['base']['table_name21'].' (name,category) VALUES("'.$charValue.'","'.$charID.'")'; //�������� ����. ���-�
                        $result4=mysql_query($sql4);
                        $id=mysql_insert_id(); //�������� ��������� ����������� id � �� ����� id ����������� � ������
                    }
                    if ($id) {
                        $resCharsArray[$charID][]=$id;
                    }

                }
            }
        }
    }
    return $resCharsArray;
}




// ��������� ���������
class ReadCsvCatalog extends PHPShopReadCsv {
    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $CsvToArray;
    var $ItemCreate=0;

    function ReadCsvCatalog($file) {
        $this->CsvContent = parent::readFile($file);
        $this->TableName = $GLOBALS['SysValue']['base']['table_name'];
        parent::PHPShopReadCsv();
    }


    // ������� ����� ������
    function CreateCatalog($id) {
        $CsvToArray=$this->CsvToArray[$id];
        if(is_array($CsvToArray)) {
            $sql="INSERT INTO ".$this->TableName." SET
     id = '".trim($CsvToArray[0])."',
     name = '".parent::CleanStr($CsvToArray[1])."', 
     parent_to = '".trim($CsvToArray[2])."' ";
            $result=mysql_query($sql);
            $this->ItemCreate++;
        }
    }


    function GetItemCreate() {
        return $this->ItemCreate;
    }

    // ��������� �������� ������ ���������
    function ChekTree($id) {
        $row=$this->CsvToArray;
        $parent=$row[$id][2];
        $CheckId=parent::CheckId($id);
        if(empty($CheckId)) $this->CreateCatalog($id);
        if($parent != 0) {
            $CheckIdParent=parent::CheckId($parent);
            if(empty($CheckIdParent)) $this->ChekTree($parent);
        }
    }

}



// ��������� �������
class ReadCsv1C extends PHPShopReadCsv {
    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $Sklad_status;
    var $ObjCatalog,$ObjSystem;
    var $ItemCreate=0;
    var $ItemUpdate=0;
    var $ImageSrc="jpg";


    function ReadCsv1C($CsvContent,$ObjCatalog,$ObjSystem) {
        $this->ImagePath=$GLOBALS['SysValue']['dir']['dir']."/UserFiles/Image/";
        $this->CsvContent = $CsvContent;
        $this->TableName = $GLOBALS['SysValue']['base']['table_name2'];
        $this->TableNameFoto = $GLOBALS['SysValue']['base']['table_name35'];
        $this->Sklad_status = $ObjSystem->getSerilizeParam("admoption.sklad_status");
        $this->ObjCatalog = $ObjCatalog;
        $this->ObjSystem = $ObjSystem;
        $this->GetIdValuta = PHPShopValuta::getAll();
        parent::PHPShopReadCsv();
        $this->DoUpdatebase();
    }

    // ���-�� ��������� �������
    function GetItemCreate() {
        return $this->ItemCreate;
    }

    // ���-�� ���������� �������
    function GetItemUpdate() {
        return $this->ItemUpdate;
    }

    // ���-�� ��������� ���������
    function GetCatalogCreate() {
        if($this->ObjCatalog) $num = $this->ObjCatalog->GetItemCreate();
        else $num=0;
        return $num;
    }


    // ���� � ��������
    function ImagePlus($img) {
        if(!empty($img))
            return $this->ImagePath.$img;
    }

    // ������� ��������
    function DoUpdatebase() {
        $CsvToArray = $this->CsvToArray;
        if(is_array($CsvToArray)) {
            foreach ($CsvToArray as $v) {
                $this->UpdateBase($v);
                $this->UpdateBaseCatalog($v[15]);
            }
        }
    }

    // ������� ��������
    function UpdateBaseCatalog($category) {
        if($this->ObjCatalog) $this->ObjCatalog->ChekTree($category);
    }

    // �������� ���-�� ����
    function GetNumFoto($id) {
        $sql="select id from ".$this->TableNameFoto." where parent=$id";
        $result=mysql_query($sql);
        return mysql_num_rows($result);
    }

    // ��������� �� ������ �� ��������
    function getIdForImages($uid) {
        $sql="select id from ".$this->TableName." where uid='$uid' limit 1";
        $result=mysql_query($sql);
        $row = mysql_fetch_array($result);
        return $row['id'];
    }

    function UpdateBase($CsvToArray) {

        // ���� �� ������ � ����
        if($_REQUEST['create']=="true")
            $CheckBase=parent::CheckUid($CsvToArray[0]);
        else $CheckBase=true;

        // ���������
        if(!empty($CheckBase)) {

            $sql="UPDATE ".$this->TableName." SET ";

            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_name")==1 and !empty($CsvToArray[2]))
                $sql.="name='".$CsvToArray[1]."', ";// ��������

            if(@$this->ObjSystem->getSerilizeParam('1c_option.update_content')==1 and !empty($CsvToArray[4]))
                $sql.="content='".$CsvToArray[4]."', ";// ������� ��������

            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_description")==1 and !empty($CsvToArray[2]))
                $sql.="description='".$CsvToArray[2]."', ";// ��������� ��������

            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_category")==1 and !empty($CsvToArray[15]))
                $sql.="category='".trim($CsvToArray[15])."', ";// ��������� ��������

            $sql.="price='".@$CsvToArray[7]."', ";// ���� 1


            // �����
            switch($this->Sklad_status) {

                case(3):
                    if($CsvToArray[6]<1) $sql.="sklad='1', ";
                    else $sql.="sklad='0', ";
                    break;

                case(2):
                    if($CsvToArray[6]<1) $sql.="enabled='0', ";
                    else $sql.="enabled='1', sklad='0',";
                    break;

                default: $sql.="";

            }

            if(!empty($CsvToArray[3])) {
                $sql.="pic_small='".$this->ImagePlus($CsvToArray[3])."_1s.".$this->ImageSrc."',";
                $sql.="pic_big='".$this->ImagePlus($CsvToArray[3])."_1.".$this->ImageSrc."',";
            }

            $sql.="price2='".@$CsvToArray[8]."', ";// ���� 2
            $sql.="price3='".@$CsvToArray[9]."', ";// ���� 3
            $sql.="price4='".@$CsvToArray[10]."', ";// ���� 4
            $sql.="price5='".@$CsvToArray[11]."', ";// ���� 5
            $sql.="items='".@$CsvToArray[6]."', ";// �����
            

            // ����������� ������
            if(is_numeric($CsvToArray[16]) and $CsvToArray[16]==1){
                $sql.="parent_enabled='1', ";
            }else {
                $sql.="parent_enabled='0', ";
                $sql.="parent='".$CsvToArray[16]."', ";
            }

            $sql.="weight='".@$CsvToArray[12]."' ";// ���
            $sql.=" where uid='".$CsvToArray[0]."'";

            $result=mysql_query($sql);
            $this->ItemUpdate++;


            // ��������� �������� � �������
            if(!empty($CsvToArray[3])) {
                $last_id=$this->getIdForImages($CsvToArray[0]);
                $ready_num_img=$this->GetNumFoto($last_id);
                $img_num=$CsvToArray[5]-$ready_num_img;
                $img_num=+$ready_num_img;
                while($img_num<$CsvToArray[5]) {
                    $ImgName=$this->ImagePlus($CsvToArray[3])."_".($img_num+1).".".$this->ImageSrc;
                    $sql="INSERT INTO ".$this->TableNameFoto." VALUES ('',$last_id,'$ImgName','$img_num','')";
                    $result=mysql_query($sql);
                    $img_num++;
                }
            }

            // ��������� ��������������
            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_category")==1 and !empty($CsvToArray[17])) {
                $resCharsArray='';

                // ��������� �������������
                $resCharsArray=charsGenerator($CsvToArray[15],$CsvToArray);
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
                $sql.=" where uid='".$CsvToArray[0]."'";
                $result=mysql_query($sql);

            }


        }
        else {
            // ������� ����� �����

            // �����
            switch($this->Sklad_status) {

                case(3):
                    if($CsvToArray[6]<1) {
                        $sklad=1;
                        $enabled=1;
                    }
                    else {
                        $sklad=0;
                        $enabled=1;
                    }
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

            // ��������� ��������������
            $vendor='';
            $vendor_array='';
            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_category")==1 and !empty($CsvToArray[17])) {
                $resCharsArray='';

                //��������� �������������
                $resCharsArray=charsGenerator($CsvToArray[15],$CsvToArray);
                $resSerialized=serialize($resCharsArray);
                if(is_array($resCharsArray)) {
                    foreach($resCharsArray as $k=>$v) {
                        if(is_array($v)) {
                            foreach($v as $o=>$p) {
                                $vendor.="i".$k."-".$p."i";
                            }
                        } else {
                            $vendor.="i".$k."-".$v."i";
                        }
                    }
                }
                $vendor_array=serialize($resCharsArray);
            }


            $sql="INSERT INTO ".$this->TableName." SET ";

            // ������������ ���������
            if(@$this->ObjSystem->getSerilizeParam("1c_option.update_category")==1 and !empty($CsvToArray[15]))
            $sql.="category='".trim(@$CsvToArray[15])."',";

            $sql.="name='".trim(@$CsvToArray[1])."',
            description='".@$CsvToArray[2]."',
            content='".@$CsvToArray[4]."',
            price='".@$CsvToArray[7]."',
            sklad='".$sklad."',
            p_enabled='".PHPShopMath::Zero(@$CsvToArray[9])."',
            enabled='".$enabled."',
            uid='".@$CsvToArray[0]."',
            yml='1',
            datas='".date("U")."',
            vendor='".$vendor."',
            vendor_array='".$vendor_array."',";

            if(!empty($CsvToArray[3]))
                $sql.="pic_small='".$this->ImagePlus($CsvToArray[3])."_1s.".$this->ImageSrc."',
            pic_big='".$this->ImagePlus($CsvToArray[3])."_1.".$this->ImageSrc."',";


            // ����������� ������
            if(is_numeric($CsvToArray[16]) and $CsvToArray[16]==1){
                $sql.="parent_enabled='1', ";
            }else {
                $sql.="parent_enabled='0', ";
                $sql.="parent='".$CsvToArray[16]."', ";
            }


            $sql.="items='".@$CsvToArray[6]."',
            weight='".@$CsvToArray[12]."',
            price2='".@$CsvToArray[8]."',
            price3='".@$CsvToArray[9]."',
            price4='".@$CsvToArray[10]."',
            price5='".@$CsvToArray[11]."',
            baseinputvaluta='".@$this->GetIdValuta[$CsvToArray[14]]."',
            ed_izm='".@$CsvToArray[13]."'";
            $result=mysql_query($sql);
            $this->ItemCreate++;

            // ��������� �������� � �������
            $img_num=1;
            if(!empty($CsvToArray[3])) {
                //$last_id=$this->getIdForImages($CsvToArray[0]);
                $last_id=mysql_insert_id();
                while($img_num<=$CsvToArray[5]) {
                    $ImgName=$this->ImagePlus($CsvToArray[3])."_".$img_num.".".$this->ImageSrc;
                    $sql="INSERT INTO ".$this->TableNameFoto." VALUES ('',$last_id,'$ImgName','$img_num','')";
                    $result=mysql_query($sql);
                    $img_num++;
                }
            }
        }
    }
}


if(preg_match("/[^(0-9)|(\-)]/",@$_GET['date'])) $date="";
else $date=@$_GET['date'];





$path="sklad";
$dir=$path."/".$date;


// ������ ���������
if(@$_GET['create_category'] == "true") $ReadCsvCatalog = new ReadCsvCatalog($dir."/tree.csv");
else $ReadCsvCatalog=false;

// ���������� ��������� �� ����
$PS = new PHPShopSystem();


// ������� �����
if ($_GET['files']=="all" and is_dir($dir)) 
    if (@$dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {

            if($file!="." and $file!=".." and $file!="tree.csv")
                @$list_file[]= $file;
        }
        closedir($dh);
    }
if(is_file("./".$dir."/".$_GET['files'])) {
    $list_file[]=$_GET['files'];
}


// ������������
if(isset($error)) {
    if(is_array($list_file))
        $list_file[$error]="";
}



if(is_array($list_file))
    foreach($list_file as $val) {

// �������� ������
        $time=explode(' ', microtime());
        $start_time=$time[1]+$time[0];

        @$fp = fopen($dir."/".$val, "r");
        if ($fp) {
            $fstat = fstat($fp);
            $CsvContent=fread($fp,$fstat['size']);
            fclose($fp);

            // ������ ����
            $ReadCsv = new ReadCsv1C($CsvContent,$ReadCsvCatalog,$PS);
            @$F_done.=$val.";";
            @$GetItemCreate+=$ReadCsv->GetItemCreate();
            @$GetItemUpdate+=$ReadCsv->GetItemUpdate();
            @$GetCatalogCreate+=$ReadCsv->GetCatalogCreate();

            // ���������
            if($_GET['files']!="all")
                echo $date.";".$F_done."
".$GetItemCreate.";".$GetItemUpdate.";".$GetCatalogCreate.";";

            // ��������� ������
            $time=explode(' ', microtime());
            $seconds=($time[1]+$time[0]-$start_time);
            $seconds=substr($seconds,0,6);

            // ����� ���
            mysql_query("INSERT INTO ".$PHPShopBase->getParam('base.table_name12')." VALUES ('','".date("U")."','$date','$val ','$seconds')");
        }
    }
else exit("�� ���� ��������� ���� ".$dir."/".$val);

if($_GET['files']=="all")
    echo $date.";".$F_done."
".$GetItemCreate.";".$GetItemUpdate.";".$GetCatalogCreate.";";
?>