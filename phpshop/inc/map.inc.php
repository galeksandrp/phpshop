<?php

/**
 * ����������� �������� ��������� �������
 * @package PHPShopCoreDepricated
 * @param int $cat �� ��������
 * @return string 
 */
function CheckReversCatPage($cat) {
    global $LoadItems;
    
    $dis=null;
    $cat=TotalClean($cat,1);
    $podcatalog_id = array_keys($LoadItems['CatalogPageKeys'],$cat);
    if(count($podcatalog_id)>0) {
        $dis.="<strong><a href=\"/page/CID_$cat.html\">".$LoadItems['CatalogPage'][$cat]['name']."</a></strong><ul>";
        
        foreach($podcatalog_id as $key) {
            $podcatalog_cid = array_keys($LoadItems['CatalogPageKeys'],$key);
            if(count($podcatalog_cid)>0) {
                $dis.=" ".CheckReversCatPage($key)." ";
            }
            else {
                $dis.="<li><a href=\"/page/CID_$key.html\">".$LoadItems['CatalogPage'][$key]['name']."</a></li>";
            } 
        }
        
        $dis.="</ul>";
    }
    return $dis;
}

/**
 * ����� ���������
 * @package PHPShopCoreDepricated
 * @return string
 */
function Vivod_map_page() {
    global $SysValue,$LoadItems;
    
    $sql="select id,name,parent_to from ".$SysValue['base']['table_name29']." where parent_to=0 order by num";
    $result=mysql_query($sql);
    $i=0;
    $num_cow=$system['num_cow'];
    
    $dis=" <p><strong><a href=\"/page/CID_1000.html\">���������</a></strong></p>";
    
    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        $parent_to=$row['parent_to'];
        $podcatalog_id = array_keys($LoadItems['CatalogPageKeys'],$id);
        
        if(count($podcatalog_id)>0) {
            $dis.=CheckReversCatPage($id);
        }else {
            $parent_to=$LoadItems['CatalogPage'][$id]['parent_to'];
            $dis.="
	  <p><a href=\"/page/CID_$id.html\">".$name."</a></strong></p>
	";
        }
    }
    return $dis;
}

/**
 * ����������� �������� ��������� �������
 * @package PHPShopCoreDepricated
 * @param int $cat �� ��������
 * @return string
 */
function CheckReversCat($cat) {
    global $LoadItems;

    $cat=TotalClean($cat,1);
    $podcatalog_id = array_keys($LoadItems['CatalogKeys'],$cat);
    $dis=null;

    if(count($podcatalog_id)>0) {
        $dis.="<strong><a href=\"/shop/CID_$cat.html\">".$LoadItems['Catalog'][$cat]['name']."</a></strong><ul>";
        foreach($podcatalog_id as $key) {
            
            $podcatalog_cid = array_keys($LoadItems['CatalogKeys'],$key);
            
            if(count($podcatalog_cid)>0) {
                $dis.=" ".CheckReversCat($key)." ";
            }
            else {
                $dis.="<li><a href=\"/shop/CID_$key.html\">".$LoadItems['Catalog'][$key]['name']."</a></li>";
            }
        }
        $dis.="</ul>";
    }
    return $dis;
}

/**
 * ���-�� ��������� �������
 * @package PHPShopCoreDepricated
 * @param string $table ��� ������� ��
 * @return Int 
 */
function TotalMach($table) {
    global $SysValue,$LoadItems;
    
    $sql="select COUNT(id) as n  from ".$SysValue['base'][$table];
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    
    return $row['n'];
}

/**
 * ����� ���������
 * @package PHPShopCoreDepricated
 * @return string
 */
function Vivod_map(){
    global $SysValue,$LoadItems;
    
    $sql="select id,name,parent_to from ".$SysValue['base']['table_name']." where parent_to=0 order by num";
    $result=mysql_query($sql);
    $i=0;
    $num_cow=$system['num_cow'];
    $dis=null;

    while($row = mysql_fetch_array($result)) {
        $id=$row['id'];
        $name=$row['name'];
        $parent_to=$row['parent_to'];
        $podcatalog_id = array_keys($LoadItems['CatalogKeys'],$id);
        
        if(count($podcatalog_id)>0) {
            $dis.=CheckReversCat($id);
        }else {
            $parent_to=$LoadItems['Catalog'][$id]['parent_to'];
            $dis.="
	  <p><strong><a href=\"/shop/CID_$id.html\">".$name."</a></strong></p>
	";
        }
    }
    
    $dis.="<p><strong><a href=\"/newtip/\">�����</a></strong>
<ul>
<li><a href=\"/newtip/\">�������</a></li>
<li><a href=\"/spec/\">���������������</a></li>
<li><a href=\"/newprice/\">����������</a></li>
</ul>
</p>
".Vivod_map_page()."
<p><strong><a href=\"/news/\">�������</a></strong></p>
<p><strong><a href=\"/links/\">������</a></strong></p>
";
    
    // ���������� ����������
    $SysValue['other']['catalog']= $SysValue['lang']['catalog'];
    $SysValue['other']['producFound']= $SysValue['lang']['found_of_products'];
    $SysValue['other']['catalFound']= $SysValue['lang']['found_of_catalogs'];
    $SysValue['other']['podcatalFound']= $SysValue['lang']['found_of_podcatalogs'];
    $SysValue['other']['catalNum']= count($LoadItems['Catalog']);
    $SysValue['other']['productNum']= TotalMach('table_name2');
    $SysValue['other']['productNumOnPage']=$SysValue['lang']['row_on_page'];
    $SysValue['other']['productNumRow']=$LoadItems['System']['num_row'];
    $SysValue['other']['productPage']=$SysValue['lang']['page_now'];
    $SysValue['other']['productPageThis']=$p;
    $SysValue['other']['productPageDis']=$dis;
    
    // ���������� ������
    $disp=ParseTemplateReturn($SysValue['templates']['map_page_list']);
    return $disp;
}
?>