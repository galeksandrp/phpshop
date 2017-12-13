<?php

/**
 * ������ ������ �������
 * @package PHPShopCoreDepricated
 */

// ������� ��������
include_once($SysValue['file']['rating']);

// ������� �����������
include_once($SysValue['file']['foto']);

if($SysValue['nav']['nav']=="CID" or $SysValue['nav']['nav']=="cid") {

    // ��������������� �� �����
    if($SysValue['nav']['id'] == "00")
        header("Location: ../map/");

    // ��������� �������� ������� � ����
    $SysValue['other']['thisCat'] = $LoadItems['Catalog'][$SysValue['nav']['id']]['parent_to'];

    // ������� ������� ��������
    if(empty($SysValue['other']['thisCat']))
        $SysValue['other']['thisCat'] = $SysValue['nav']['id'];

    // ���� 3� ����������� ��������
    $ParentTest=$LoadItems['Catalog'][$SysValue['other']['thisCat']]['parent_to'];
    if($ParentTest>0) {
        $SysValue['other']['thisCat']=$ParentTest;
        $SysValue['other']['thisPodCat']=$LoadItems['Catalog'][$SysValue['nav']['id']]['parent_to'];
    }

    // �������� �����������
    $podcatalog_id = array_keys($LoadItems['CatalogKeys'],$SysValue['nav']['id']);

    if(count($podcatalog_id)>0) {
        $SysValue['other']['DispShop']=DispCatalogTree($SysValue['nav']['id']);
        $SysValue['other']['DispShop'].=DispKratko($podcatalog_id,1,$SysValue['nav']['id']);
    } else $SysValue['other']['DispShop']=DispKratko($SysValue['nav']['id']);
    
    // ������� �������
    $newsCat=$SysValue['nav']['id'];
    
    // ������� ��������������� � ������� �������
    $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat." and spec='1'");
    if(!empty($SysValue['other']['specMainIcon']))
        $SysValue['other']['specMainTitle'] = $SysValue['lang']['specprod'];
    else {
        $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
        $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat." and newtip='1'");

        if(empty($SysValue['other']['specMainIcon']))
            $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$newsCat);
    }
    if(empty($SysValue['other']['specMainIcon']))
        $SysValue['other']['specMainIcon'] = DispNewIcon("and newtip='1'");

    if(empty($SysValue['other']['specMainIcon']))
        $SysValue['other']['specMainIcon'] = DispNewIcon("");

}
elseif($SysValue['nav']['nav']=="UID" or $SysValue['nav']['nav']=="uid") {

    // ����� ���������� �������� ������
    $SysValue['other']['DispShop']=DispPodrobno($SysValue['nav']['id']);

    // ��������� �������� ������� � ����
    $catID=$LoadItems['Product'][$SysValue['nav']['id']]['category'];
    $SysValue['other']['thisCat']=$LoadItems['Catalog'][$catID]['parent_to'];

    // ������� ��������������� � ���������� �������
    $SysValue['other']['specMainTitle'] =$SysValue['lang']['page_product'];
    $SysValue['other']['specMainIcon']=DispOdnotip($SysValue['nav']['id']);
    if(empty($SysValue['other']['specMainIcon'])) {
        $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
        $SysValue['other']['specMainIcon'] = DispNewIcon("and category=".$catID);
    }
}
else include("pages/error.php");

if($SysValue['other']['DispShop'] == 404) {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
    include("pages/error.php");
}

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>