<?php

$shopdir=$SysValue['other']['ShopDir'];
$limit=4; //�������� ������� ��� ���������
if(!empty($_SESSION['compare']))
$copycompare=$_SESSION['compare']; 
else $copycompare=array();

// API 2.1
$LoadItems['Valuta']=$PHPShopValutaArray->getArray();
$LoadItems['System']=$PHPShopSystem->getArray();

/**
 * ������ ��� ������ ��� ������ ���������
 * @package PHPShopCoreDepricated
 * @param int $id �� ������
 * @return string 
 */
function getfullname ($id=0) {
    global $SysValue;
    
    $sql='select name,parent_to from '.$SysValue['base']['table_name'].' where id='.$id;
    $result=mysql_query($sql);
    @$row = mysql_fetch_array(@$result);
    if ($row['parent_to']) {
        return getfullname($row['parent_to']).' / '.$row['name'];
    } else {
        return $row['name'];
    }
}


if (!($SysValue['nav']['id']=="ALL")) {
    $SysValue['nav']['id']=intval($SysValue['nav']['id']);
}

if ($SysValue['nav']['nav']=="COMCID") { 
    if (isset($SysValue['nav']['id']) && ($SysValue['nav']['id'])) {
        $COMCID=$SysValue['nav']['id'];
    }
}

// ���������� �������� ������� � ���������
if(is_array($copycompare))
    sort($copycompare); //��������� �� ����������
$oldcatid=''; //�������������� ������������� ���������

if(is_array($copycompare))
    foreach($copycompare as $id =>$val) { 
    
        //���� ������������� ��������� ������ ���������, ������ ���������
        if ($oldcatid!=$val['category']) { 
            
            $catid=$val['category'];
            $oldcatid=$catid; //������ �������������.
            $cats[$catid]=getfullname($catid);
        }
        $goods[$oldcatid][$id]['name']=$val['name'];
        $goods[$oldcatid][$id]['id']=$val['id'];
    } 


$COMCID=0;
$dis="";

if(empty($cats)) $cats=0;

if(is_array($cats))
    foreach ($cats as $catid => $name) {
        if ((count($goods[$catid])>1) && (count($goods[$catid])<=$limit)) {
            if ($catid!=$COMCID) {
                $as='<img src="images/shop/icon-activate.gif" alt="������ ����� �� ���������" width="19" height="15" border="0" hspace="0" align="absmiddle"><B style="color:green;">�������� � ���������:</B> <A href="'.$shopdir.'/compare/COMCID_'.$catid.'.html#list" style="font-weight:bold;" title="�������� � '.$name.'">';
                $ae='</A>';
            } else {
                $as='<B>������ ������������: ';
                $ae='</B>';
                
            }
            $dis.='
		<tr><td colspan="2" width="30"><br></td></tr>
		<TR><TD colspan="2" id=allspec >'.$as.$name.$ae.'</TD>
		<TD>&nbsp;</TD></TR>';
            $green[]=$catid; //�������� ������� � �����������
        } elseif(count($goods[$catid])>$limit) {
            $dis.='
		<TR><TD><BR><B>'.$name.'</B></TD>
		<TD><BR>&ndash; <FONT style="color:red;">������� ����� �������, ����� �������� <B>(MAX='.$limit.')</B>. ������� ������!</FONT></TD></TR>';
        } else {
            $dis.='
		<tr><td  width="30"><br></td></tr>
		<TR><TD  id=allspec><B>'.$name.'</B></TD>
		<TD id=allspec><FONT style="color:red;">������������ �������, ����� �������� <B>(MIN=2)</B>. �������� ��� ������ �� ���� ���������!</FONT></TD></TR>';
        }
        foreach ($goods[$catid] as $id => $val) {
            $dis.='<TR><TD class=sort_table>'.$val['name'].' </TD><TD class=sort_table><A href="'.$shopdir.'/compare/DID_'.$val['id'].'.html" title="������ ����� �� ���������"><img src="images/shop/icon-deactivate.gif" alt="������ ����� �� ���������" width="19" height="15" border="0" hspace="0" align="absmiddle">[������ ����� �� ���������]</A></TD></TR>';
        }
    }

// ���������� - �������� �� ���� ����������
if (count($cats)>1) { //���� ������ ���� ���������
    $name='�� ���� ����������';
    if ((count($compare)>1) && (count($compare)<=$limit)) {
        if ($COMCID!="ALL") {
            $as='<img src="images/shop/icon-activate.gif" alt="������ ����� �� ���������" width="19" height="15" border="0" hspace="0" align="absmiddle"><B style="color:green;">�������� </B> <A href="'.$shopdir.'/compare/COMCID_ALL.html#list" style="font-weight:bold;" title="�������� �� ���� ����������">';
            $ae='</A>';
        } else {
            $as='������ ������������:<B> ';
            $ae='</B>';
        }
        $dis.='
		<tr><td colspan="2" width="30"><br></td></tr>
		<TR><TD colspan="2" id=allspec>'.$as.$name.$ae.'</TD>
		<TD>&nbsp;</TD></TR>';
        $green[]="ALL"; //�������� ������� � �����������
    } elseif(count($compare)>$limit) {
        $dis.='
		<TR><TD><BR><B>'.$name.'</B></TD>
		<TD><BR>&ndash; <FONT style="color:red;">������� ����� �������, ����� �������� <B>(MAX='.$limit.')</B>. ������� ������!</FONT></TD></TR>';
    } else {
        $dis.='
		<TR><TD><BR><B>'.$name.'</B></TD>
		<TD><BR>&ndash; <FONT style="color:red;">������������ �������, ����� �������� <B>(MIN=2)</B>. �������� ��� ������ �� ���� ���������!</FONT></TD></TR>';
    }
}

// ����� ������������ ����������
$disp='<TABLE width="95%">'.$dis.'</TABLE>
<div style="padding-top: 10px;padding-bottom: 30px" align="center">
<A href="'.$shopdir.'/compare/DID_ALL.html" title="������� ��� ������ �� ������"><img src="images/shop/error.gif" alt="������� ��� ������ �� ������"  border="0" hspace="5" align="absmiddle" >[������� ��� ������ �� ������]</A></div>';

// ����� �������� ��� ������
if (!$COMCID) { //���� �� ������ �������
    if (@count($green)>0) {//���� ���� ���� ������� ����� ��������
        krsort($green);
        foreach ($green as $c) {
            $COMCID=$c;
            break;	
        }
    } else {
        $disp.='<P>��������� ��������� ���� ������� ����������. ������� ��� �������� ������ ���������� �������.</P>';
    }
}

// ��������� �������� �������������
if ($SysValue['nav']['nav']=="DID") {
    $id=$SysValue['nav']['id'];
    if ($id=="ALL") {
        $_SESSION['compare']=null;
        unset($_SESSION['compare']);
        echo '<SCRIPT>window.location.replace(\''.$shopdir.'/compare/\');</SCRIPT>';
    } else {
        unset($_SESSION['compare'][$id]);
        echo '<SCRIPT>window.location.replace(\''.$shopdir.'/compare/\');</SCRIPT>';
    }
}

$catid=$COMCID;

// ��������
if(!empty($_SESSION['compare']))
if (($COMCID && (count($goods[$catid])>1) && (count($goods[$catid])<=$limit)) || 
        ((($COMCID=="ALL") && (count($_SESSION['compare'])>1) && (count($_SESSION['compare'])<=$limit)))) { //���� ������ ������� ���������
   
    if ($COMCID=="ALL") {
        $comparing='��� ���������';
    } else {
        $comparing=getfullname($COMCID);
    }
    
    $disp.='<a name="list"></a><P><h5>��������� ������� � ���������:<br> '.$comparing.'</h5></P>';

    if ($COMCID!="ALL") {
        $sql='select sort from '.$SysValue['base']['table_name'].' where id='.$COMCID;
        $result=mysql_query($sql);
        @$row = mysql_fetch_array(@$result);
        $sorts=unserialize($row['sort']);
    } else {
        foreach ($cats as $catid => $name) {
            $sql='select sort from '.$SysValue['base']['table_name'].' where id='.$catid;
            $result=mysql_query($sql);
            @$row = mysql_fetch_array(@$result);
            $tempsorts=unserialize($row['sort']);
            if(is_array($tempsorts))
                foreach ($tempsorts as $curtempsort) {
                    $sorts[]=$curtempsort;
                }
        }
    }
    if(is_array($sorts))
        $sorts=array_unique($sorts);//��������� ������ ���������� ����������
    
    $sorts_name='';
    
    if(is_array($sorts))
        foreach ($sorts as $sort) {
            $sql='select name from '.$SysValue['base']['table_name20'].' where id='.$sort.' AND goodoption=0';
            $result=mysql_query($sql);
            @$row = mysql_fetch_array(@$result);
            $sorts_name[$sort]=$row['name'];
        }
        
    /*
     * ������ ����� ���� �� ������ ���������, � ������� ���������� �������������� ����� ����� ������ ��������
     * ������� ����������� ������. �������� ������ ���_�������������� = ������ ���������������
     */
    if(is_array($sorts_name))
        foreach ($sorts_name as $sort =>$name) {
            $sql='select id from '.$SysValue['base']['table_name20'].' where name LIKE \''.$name.'\'';
            $result=mysql_query($sql);
            while ($row = mysql_fetch_array(@$result)) {
                $sorts_name2[$name][$row['id']]=1;
            }
        }
    
    if(empty($sorts_name2)) $sorts_name2=0;
    
    // ���������� ������� ��� ������� �������
    $TDR[0][]='�����';
    $TDR[0][]='����';
    $TDR[0][]='����';
    if(is_array($sorts_name2))
        foreach ($sorts_name2 as $name=>$id) {
            $TDR[0][]=$name;
        }
    $TDR[0][]='��������';		
    $igood=0; 

    if ($COMCID!="ALL") {
        $goodstowork=$goods[$COMCID];
    } else {
        foreach ($cats as $catid => $name) {
            foreach ($goods[$catid] as $curtempgood) {
                $goodstowork[]=$curtempgood;
            }
        }
    }
    
    // �������� ������������ ������
    $sql="select dengi from ".$SysValue['base']['table_name3'];
    $result=mysql_query($sql);
    $row = mysql_fetch_array($result);
    $defvaluta=$row['dengi'];
    // �������� ������������ ������
    
    foreach ($goodstowork as $id => $val) {
        $igood++;
        $TDR[$igood][]='<A href="/shop/UID_'.$val['id'].'.html" title="'.$val['name'].'">'.$val['name'].'</A>';

        //�������� ����� �� ����
        $sql='select id,price,pic_small,vendor_array,content,baseinputvaluta from '.$SysValue['base']['table_name2'].' where id='.$val['id'];
        $result=mysql_query($sql);
        @$row = mysql_fetch_array(@$result);
        if (trim($row['pic_small'])) {
            $TDR[$igood][]='<IMG SRC="'.$row['pic_small'].'">';
        } else {
            $TDR[$igood][]='����������� �����������';
        }
        $baseinputvaluta=$row['baseinputvaluta'];
        $price=$row['price'];
        $id=$row['id'];

        //�������� �������� ����
        if ($baseinputvaluta) { //���� �������� ���. ������
            if ($baseinputvaluta!==$LoadItems['System']['dengi']) {//���� ���������� ������ ���������� �� �������
                $price=$price/$LoadItems['Valuta'][$baseinputvaluta]['kurs']; //�������� ���� � ������� ������
            }
        } 

        if(isset($_SESSION['valuta'])) {
            $valuta=$_SESSION['valuta'];
        } else {
            $valuta=$LoadItems['System']['dengi'];
        } 
        $kurs=$LoadItems['Valuta'][$valuta]['kurs'];
        $admoption=unserialize($LoadItems['System']['admoption']);
        $format=$admoption['price_znak'];
        $price=$price*$kurs;
           
        // ���� ���� ���������� ������ ����� ����������
        if($admoption['user_price_activate']==1 and !$_SESSION['UsersId']) {
            $price="-";
        }
        
        $price=($price+(($price*$LoadItems['System']['percent'])/100));
        $price=number_format($price,$format,'.', ' ');
        $TDR[$igood][]=$price;
        $chars=unserialize($row['vendor_array']);
        
        if(is_array($sorts_name2))
            foreach ($sorts_name2 as $name=>$ids) {
                $curchar='';
                foreach ($ids as $id=>$true) {
                    @$ca=$chars[$id];
                    if(is_array($ca))
                        foreach($ca as $charid) {
                            $sql2='select name from '.$SysValue['base']['table_name21'].' where id='.$charid;
                            $result2=mysql_query($sql2);
                            @$row2 = mysql_fetch_array(@$result2);
                            $curchar.=' '.$row2['name'].'<BR>';
                        }
                }
                $TDR[$igood][]=$curchar;
            }
        $TDR[$igood][]=stripslashes($row['content']);
    }
    
    //����� ������� �� �������
    $rows=count($TDR[0]);
    $cols=count($goodstowork)+1;
    $disp.='<TABLE class=sort_table cellpadding=3 width="95%">';
    
    for($row=0; $row<$rows; $row++) {
        $disp.='<TR>';
        for($col=0; $col<$cols; $col++) {
            $value=trim($TDR[$col][$row]);
            if (!$value) {
                $value='&nbsp;';
            }
            $disp.='<TD class=sort_table style="vertical-align:top;">'.$value.'</TD>';
        }
        $disp.='</TR>';
    }
    $disp.='</TABLE>';
}

//���� ��� �������, �������� �����. ������ ���� ��������� �������
if (count($cats)==0) {
    $disp='<P><h5>�� �� ������� ������ ��� ���������!</h5></P>';
}

// ���������� ���������
$SysValue['other']['pageTitle']=$SysValue['other']['pageTitl']="��������� �������";
$SysValue['other']['pageContent']= $disp;
$SysValue['other']['catalogCat']= "��������� �������";
$SysValue['other']['catalogCategory']= "������� ������ ��� ���������";
$SysValue['other']['DispShop']=ParseTemplateReturn($SysValue['templates']['page_page_list']);

// ���������� ������ 
ParseTemplate($SysValue['templates']['shop']);
?>