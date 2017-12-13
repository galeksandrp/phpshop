<?php

/**
 * ����������� ������
 * @package PHPShopIncDepricated
 * @author PHPShop Software
 * @param int $usersesid SID ������������
 * @return array
 */
function CacheReturnBase($usersesid=false) {
    global $SysValue,$sid;
    switch($SysValue['cache']['cache_mod']) {

        // ��� ��������, ��������� �������� �������
        case(0):
            $LoadItems=array(
                    "Catalog"=>Catalog(),
                    "CatalogKeys"=>CatalogKeys(),
                    "CatalogPageKeys"=>CatalogPageKeys(),
                    "Product"=>Product(),
                    "System"=>DispSystems(),
                    "Valuta"=>DispValuta(),
                    "Sort"=>Sorts(),
                    "CatalogSort"=>CatalogSorts(),
                    "CatalogPage"=>CatalogPage()
            );
            break;


        // ��� �������� � ���� ������
        case(1):

            // ��������� ��� � �������
            $sql="select cache,datas from ".$SysValue['base']['table_name16']." limit 1";
            $result=mysql_query($sql);
            $SysValue['sql']['num']++;
            $num_rows=mysql_num_rows($result);
            $row = mysql_fetch_array($result);
            $mydata=date("U")-$SysValue['cache']['time'];
            if($num_rows>0 && $row['datas']>$mydata) {
                $LoadItems = unserialize($row['cache']);
            }else {
                $sql="delete from ".$SysValue['base']['table_name16'];
                $result=mysql_query($sql);
                $sql="OPTIMIZE TABLE ".$SysValue['base']['table_name16'];
                $result=mysql_query($sql);
                $SysValue['sql']['num']++;

                // ����� ���
                $LoadItems=array(
                        "Catalog"=>Catalog(),
                        "CatalogKeys"=>CatalogKeys(),
                        "CatalogPageKeys"=>CatalogPageKeys(),
                        "Product"=>Product(),
                        "System"=>DispSystems(),
                        "Valuta"=>DispValuta(),
                        "Sort"=>Sorts(),
                        "CatalogSort"=>CatalogSorts(),
                        "CatalogPage"=>CatalogPage()
                );

                $sql="INSERT INTO ".$SysValue['base']['table_name16']." VALUES ('$usersesid','".serialize($LoadItems)."','".date("U")."')";
                $result=mysql_query($sql);
                $SysValue['sql']['num']++;
            }
            break;

        // ��� �������� � �����
        case(2):
            $LoadItems=CacheReturnFromFile($SysValue['cache']['file']);
            break;

        // ��� ��������, ��������� ���������� ������� (���������������)
        case(3):

            switch(@$SysValue['nav']['nav']) {

                case(""):
                    $str="none";
                    break;

                case("CID"):
                    if($SysValue['nav']['path'] == "shop")
                        $str=" where (category=".$SysValue['nav']['id']." or dop_cat LIKE '%#".$SysValue['nav']['id']."#%') and enabled='1'";
                    else $str="none";
                    break;

                case("UID"):
                    $str=" where id=".$SysValue['nav']['id']." and enabled='1'";
                    break;

                default:
                    $str="none";
                    break;


            }

            $LoadItems=array(
                    "Catalog"=>Catalog(),
                    "CatalogKeys"=>CatalogKeys(),
                    "CatalogPageKeys"=>CatalogPageKeys(),
                    "Product"=>Product($str),
                    "System"=>DispSystems(),
                    "Valuta"=>DispValuta(),
                    "Sort"=>Sorts(),
                    "CatalogSort"=>CatalogSorts(),
                    "CatalogPage"=>CatalogPage()
            );
            break;


    }
    return $LoadItems;
}

/**
 * ������ ���� � ����
 * @package PHPShopIncDepricated
 * @param string $file ���� ��� ������
 * @return array
 */
function CacheReturnFromFile($file)// �������� ���� mod=2
{
    global $SysValue,$SCRIPT_NAME;

    @$fp = fopen($file, "r");
    if($fp) {
        $fstat = fstat($fp);
        fclose($fp);
        if((time("U") - $fstat['mtime'])>$SysValue['cache']['time']) {

            // ����� ���
            $LoadItems=array(
                    "Catalog"=>Catalog(),
                    "CatalogKeys"=>CatalogKeys(),
                    "CatalogPageKeys"=>CatalogPageKeys(),
                    "Product"=>Product(),
                    "System"=>DispSystems(),
                    "Valuta"=>DispValuta(),
                    "Sort"=>Sorts(),
                    "CatalogSort"=>CatalogSorts(),
                    "CatalogPage"=>CatalogPage()
            );
            @$fp = fopen($file, "w+");
            if ($fp) {
                //stream_set_write_buffer($fp, 0);
                fputs($fp, serialize($LoadItems));
                fclose($fp);
            }
        }
        else {
            @$fp = fopen($file, "r");
            if ($fp) {
                $fstat = fstat($fp);
                $LoadItems=unserialize(fread($fp,$fstat['size']));
                fclose($fp);
            }
        }
    }
    else {
        // ����� ���
        $LoadItems=array(
                "Catalog"=>Catalog(),
                "CatalogKeys"=>CatalogKeys(),
                "CatalogPageKeys"=>CatalogPageKeys(),
                "Product"=>Product(),
                "System"=>DispSystems(),
                "Valuta"=>DispValuta(),
                "Sort"=>Sorts(),
                "CatalogSort"=>CatalogSorts(),
                "CatalogPage"=>CatalogPage()
        );
        @$fp = fopen($file, "w+");
        if ($fp) {
            //stream_set_write_buffer($fp, 0);
            fputs($fp, serialize($LoadItems));
            fclose($fp);
        }
    }

    return $LoadItems;
}
?>