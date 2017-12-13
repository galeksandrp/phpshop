<?

$_classPath="../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("file");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("math");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("category");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();

//��������� ����� ������������� � �� ����������
function getChars($allCharsArray,$categoryID) {
    global $SysValue;
    $sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    $allCharsID=unserialize($row['sort']); //�������� ��� �������������� ��������

    foreach($allCharsID as $charID) {
        $sql2='select name from '.$SysValue['base']['table_name20'].' WHERE id='.$charID; //�������� �������� ���-�
        $result2=mysql_query($sql2);
        $row2 = mysql_fetch_array($result2);
        @$res.=PHPShopSecurity::CleanOut($row2['name']).';'; //��������� ���. ����� �������������
        $valuesArray=$allCharsArray[$charID]; //������ id �������� �������������
        $splitter=''; //��� ������ ������ ����������� - ����
        foreach ($valuesArray as $valueID) {
            $sql3='select name from '.$SysValue['base']['table_name21'].' WHERE id='.$valueID; //�������� �������� ��������
            $result3=mysql_query($sql3);
            $row3 = mysql_fetch_array($result3);
            @$res.=$splitter.PHPShopSecurity::CleanOut($row3['name']); //��������� ���. ����� �������������
            $splitter=' && '; //��� ���� ��������� �������� ������������� �����������
        }
        @$res.=';'; //������� ������ ����� ����� ��������
    }
    return $res;
}   

//��������� ���������� ������������� ��� ��������
function getCharsAmount($categoryID) {
    global $SysValue;
    $sql='select sort from '.$SysValue['base']['table_name'].' WHERE id='.$categoryID;
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    $allCharsID=unserialize($row['sort']); //�������� ��� �������������� ��������
    return count($allCharsID);
}


function pdsCat($id,$parent,$array) {
    if(!empty($parent[$id])) {
        @$str.=$array[$id]['name'].";";
        @$str.=pdsCat($parent[$id],$parent,$array);
    }
    else return $array[$id]['name'].";";
    return $str;
}



if(CheckedRules($UserStatus["csv"],1) == 1) {

    switch($_GET['DO']) {

        case("catalog"):// �������� ��������� ��� 1�
            $PHPShopOrm=&new PHPShopOrm($GLOBALS['SysValue']['base']['table_name']);
            $data=$PHPShopOrm->select(array('id','name','parent_to'),false,array('order'=>'id DESC'),array('limit'=>10000));
            if(is_array($data))
                foreach($data as $row) {
                    @$csv.="$row[id];$row[name];$row[parent_to];\n";
                }
            $csv="CatalogID;Name;Parent;\n".$csv;

            $file="../csv/catalog_".date("d_m_y_His").".csv";
            PHPShopFile::write($file,$csv);
            header("Location: ".$file);
            break;



        case("pdsprice"):// �������� ��� PDS-Price
            $PC = new PHPShopCategoryArray();
            $sql='select * from '.$GLOBALS['SysValue']['base']['table_name2']." order by id desc";
            $result=mysql_query($sql);
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $name=str_replace(";","|",trim($row['name']));
                $category=$row['category'];
                $price=$row['price'];
                $enabled=$row['enabled'];
                $items=trim($row['items']);

                // ������ ���������
                $pdsCat=pdsCat($category,$PC->getKey("id.parent_to"),$PC->getArray());
                $pds_cat_num=explode(";",$pdsCat);
                $pds_cat_num=count($pds_cat_num)-1;
                while($pds_cat_num<5) {
                    $pdsCat.=";";
                    $pds_cat_num++;
                }
                @$csv.="$pdsCat $id;$name;$price;$items;\n";
            }
            $csv="�������� ���������;�������� ������;�������� ���������;�������� �������;�������� ����������;ID ������;�������� ������;����;�����;\n".$csv;

            $file="../csv/pds_".date("d_m_y_His").".csv";
            PHPShopFile::write($file,$csv);
            header("Location: ".$file);
            break;


        case("base"):// �������� ���� ����
            $sql='select * from '.$GLOBALS['SysValue']['base']['table_name2']." order by id desc";
            $result=mysql_query($sql);
            $num=0;
            $amo=0;
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $name=html_entity_decode(($row['name']));
                $category=$row['category'];
                $content=PHPShopSecurity::CleanOut($row['content']);
                $description=PHPShopSecurity::CleanOut($row['description']);
                $price=$row['price'];
                $price2=trim($row['price2']);
                $price3=trim($row['price3']);
                $price4=trim($row['price4']);
                $price5=trim($row['price5']);
                $uid=trim($row['uid']);
                $enabled=$row['enabled'];
                $pic_small=$row['pic_small'];
                $pic_big=$row['pic_big'];
                $vendor_array=base64_encode($row['vendor_array']);
                $vendorArray=unserialize($row['vendor_array']);
                $num=$row['num'];
                $items=trim($row['items']);
                $weight=trim($row['weight']);
                $dop_cat = $row['dop_cat'];
                
                @$csv.="$id;\"$name\";\"$description\";$pic_small;\"$content\";$pic_big;$items;$price;$price2;$price3;$price4;$price5;$weight;$uid;$category;$dop_cat";
                @$csv.=';'.getChars($vendorArray,$category);
                @$csv.="\n"; //����� ������

                $newamo=getCharsAmount($category);
                if ($newamo>$amo) {
                    $amo=$newamo;
                }
            }

            for ($i=0; $i<$amo; $i++) { //������� � ��������� ����� ���
                @$charsFiller.=';��������������;��������';
            }

            $csv="��� ID;������������;������� ��������;��������� ��������;��������� ��������;������� ��������;�����;����1;����2;����3;����4;����5;���;�������;�a������� ID; ���. ��������$charsFiller\n".$csv;

            $sorce="../csv/base_".date("d_m_y_His").".csv";
            PHPShopFile::write($sorce,$csv);
            PHPShopFile::gzcompressfile($sorce);
            header("Location: ".$sorce.".bz2");
            break;

        case("stats1"):// �������� ����������
            $sql="select * from ".$GLOBALS['SysValue']['base']['table_name1']." where datas<'".$_GET['pole2']."' and datas>'".$_GET['pole1']."' order by id desc";
            $result=mysql_query($sql);
            $num=0;
            $csv="����;���-��;����� ".$PHPShopSystem->getDefaultValutaIso()."\n";
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $datas=PHPShopDate::dataV($row['datas']);
                $order=unserialize($row['orders']);
                $csv.="$datas;".$order['Cart']['num'].";".PHPShopMath::ReturnSumma($order['Cart']['sum'],$order['Person']['discount'])."\n";
                @$sum+=PHPShopMath::ReturnSumma($order['Cart']['sum'],$order['Person']['discount']);
                @$num+=$order['Cart']['num'];
            }
            $csv.="�����:;$num;$sum\n";
            $file="../csv/".date("d_m_y_His").".csv";
            PHPShopFile::write($file,$csv);
            header("Location: ".$file);

            break;

        // �������� ������
        default:
            if($_GET['IDS']=="all") $string="or id>'0'";
            else {
                $IdsArray=split(",",$_GET['IDS']);
                foreach ($IdsArray as $v)
                    @$string.="or id='$v' ";
            }
            $sql="select * from ".$GLOBALS['SysValue']['base']['table_name2']." where id='0' $string";
            $result=mysql_query($sql);
            $num=0;
            $csv="��� ������;�������;������������;����1;����2;����3;����4;����5;�������;���������������;�����;���;����������\n";
            while($row = mysql_fetch_array($result)) {
                $id=$row['id'];
                $name=str_replace("|",";",trim($row['name']));
                $price=trim($row['price']);
                $price2=trim($row['price2']);
                $price3=trim($row['price3']);
                $price4=trim($row['price4']);
                $price5=trim($row['price5']);
                $uid=trim($row['uid']);
                $spec=trim($row['spec']);
                $items=trim($row['items']);
                $newtip=trim($row['newtip']);
                $num=trim($row['num']);
                $weight=trim($row['weight']);
                $csv.="$id;$uid;\"$name\";$price;$price2;$price3;$price4;$price5;$newtip;$spec;$items;$weight;$num\n";
            }

            $file="../csv/".date("d_m_y_His").".csv";
            PHPShopFile::write($file,$csv);
            header("Location: ".$file);
    }
}else $UserChek->BadUserFormaWindow();

?>