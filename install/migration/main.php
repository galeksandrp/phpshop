<? 
//��� �������� ������ 
?>
<HTML>
<HEAD><TITLE>�������� �� ShopScript � PHPSHOP</TITLE></HEAD>
<BODY>
<CENTER>
<H1>�������� � ShopScript �� PHPSHOP</H1>
<FORM METHOD=POST>
������� ����� �� ��������� (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srchost]" value="localhost"><BR>
������� ��� ������������ �� ��������� (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcuser]" value="root"><BR>
������� ������ �� ��������� (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpass]" value=""><BR>
������� ��� ����� �� ��������� (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcname]" value="shopbase"><BR>
������� ������� ������ �� ��������� (ShopScript): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpre]" value="SS_"><BR>
������� ������������� ���� �������� ��������� (ShopScript). ������ ������� &laquo;<?echo GetEnv("DOCUMENT_ROOT"); ?>&raquo;. <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[srcpath]" value="/products_pictures/"><BR>

<HR>
������� ����� �� ���������� (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trghost]" value="localhost"><BR>
������� ��� ������������ �� ���������� (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trguser]" value="root"><BR>
������� ������ �� ���������� (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgpass]" value=""><BR>
������� ��� ����� �� ���������� (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgname]" value="shopbasephp"><BR>
������� ������� ������ �� ���������� (PHPSHOP): <BR>
<INPUT SIZE=60 TYPE=TEXT name="us[trgpre]" value="phpshop_"><BR>

<INPUT TYPE=hidden name="act" value="do"><BR>
<input name="submit" type="submit" value="��������� &raquo;">
</FORM>
</CENTER>


<?
// ������� ��
@extract($_GET);
@extract($_POST);
@extract($_FORM);
@extract($_FILES);
$DOCUMENT_ROOT=GetEnv("DOCUMENT_ROOT");

set_time_limit (1800);

if (isset($act)) {

  echo '<HR>����������:<BR>';

//���������� � �������� ��
  @mysql_connect($us['srchost'],$us['srcuser'],$us['srcpass']) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ����������� � �������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CONNECT_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>'.mysql_errno().mysql_error());
  @mysql_select_db ($us['srcname']) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CHOISE_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>');
  @mysql_query( 'set names cp1251' );

//���������
  $sql='select categoryID, name, parent, description, sort_order, meta_description, meta_keywords from '.$us['srcpre'].'categories';
  $result=mysql_query($sql);
  $sqlcat='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($f['name']=='ROOT') {continue;}
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumcat[$nn]++;
    if (count($f['meta_description'])) {$descrip_enabled=1;} else {$descrip_enabled=0;}
    if (count($f['meta_keywords'])) {$keywords_enabled=1;} else {$keywords_enabled=0;}
    if ($f['parent']==='1') {$f['parent']=0;}
    @$sqlcat[$nn].='(\''.$f['categoryID'].'\',\''.addslashes($f['name']).'\',\''.$f['sort_order'].'\',\''.$f['parent'].'\',\''.addslashes($f['description']).'\',\''.addslashes($f['meta_description']).'\',\''.$descrip_enabled.'\',\''.addslashes($f['meta_keywords']).'\',\''.$keywords_enabled.'\'),';
  }

//������
  $sql='select productID, categoryID, name, description, Price, in_stock, enabled, brief_description, list_price, product_code, sort_order, default_picture, weight, meta_description, meta_keywords from '.$us['srcpre'].'products';
  $result=mysql_query($sql);
  $sqlprod='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumprod[$nn]++;
    if (count($f['meta_description'])) {$descrip_enabled=1;} else {$descrip_enabled=0;}
    if (count($f['meta_keywords'])) {$keywords_enabled=1;} else {$keywords_enabled=0;}
    if ($f['in_stock']) {$in_stock=0;} else {$in_stock=1;}
    @$sqlprod[$nn].='(\''.$f['productID'].'\',\''.$f['categoryID'].'\',\''.addslashes($f['name']).'\',\''.addslashes($f['brief_description']).'\',\''.addslashes($f['description']).'\',\''.$f['Price'].'\',\''.$f['list_price'].'\',\''.$in_stock.'\',\''.$f['enabled'].'\',\''.$f['enabled'].'\',\''.$f['product_code'].'\',\''.$f['sort_order'].'\',\''.addslashes($f['meta_description']).'\',\''.$descrip_enabled.'\',\''.addslashes($f['meta_keywords']).'\',\''.$keywords_enabled.'\',\'\',\'\',\''.$f['weight'].'\'),';
  }


//��������
  $sql='select productID, filename, thumbnail from '.$us['srcpre'].'product_pictures';
  $result=mysql_query($sql);
  $sqlfoto='';
  $i=0;
  $nn=0;
  $lim=-1;

  
  while ($f=mysql_fetch_array($result)) {
    $pic_s=$us['srcpath'].$f['thumbnail'];
    $pic_b=$us['srcpath'].$f['filename'];
    $n=$f['productID'];
    $myRName=substr(abs(crc32(uniqid($f['productID']))),0,5);
    if(file_exists($DOCUMENT_ROOT.$pic_s) and file_exists($DOCUMENT_ROOT.$pic_b)){
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumfoto[$nn]++;

// �������
      $pathinfo=pathinfo($pic_b);
      $path=$pathinfo['dirname'].'/';
      $pic_b_ext = $pathinfo['extension'];
      $pic_b_name_new = "img".$n."_".$myRName.".".$pic_b_ext;
      $pic_b_name_old=$pathinfo['basename'];
      $pic_b_new=str_replace($pic_b_name_old,$pic_b_name_new,$pic_b);
      $oldWD = getcwd();
      $dirWhereRenameeIs=$DOCUMENT_ROOT.$pathinfo['dirname'];
      $oldFilename=$pathinfo['basename'];
      $newFilename=$pic_b_name_new;
      chdir($dirWhereRenameeIs);
      rename($oldFilename, $newFilename);
      chdir($oldWD); 

// ���������
      $pathinfo=pathinfo($pic_s);
      $pic_s_ext = $pathinfo['extension'];
      $pic_s_name_new = "img".$n."_".$myRName."s.".$pic_s_ext;
      $pic_s_name_old=$pathinfo['basename'];
      $pic_s_new=str_replace($pic_s_name_old,$pic_s_name_new,$pic_s);
      $oldFilename=$pathinfo['basename'];
      $newFilename=$pic_s_name_new;
      chdir($dirWhereRenameeIs);
      rename($oldFilename, $newFilename);
      chdir($oldWD); 
//id parent name
      $name=$pic_b_new;
      @$sqlfoto[$nn].='(\''.$f['photoID'].'\',\''.$f['productID'].'\',\''.$name.'\',\'0\'),';
      @$sqlfotoold[$nn].='SET pic_small=\''.$path.$pic_s_name_new.'\', pic_big=\''.$pic_b_new.'\'  WHERE (id=\''.$f['productID'].'\')';

    }

  }


//��������
  $sql='select aux_page_ID, aux_page_name, aux_page_text, meta_keywords, meta_description from '.$us['srcpre'].'aux_pages';
  $result=mysql_query($sql);
  $sqlpages='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumpages[$nn]++;
    @$sqlpages[$nn].='(\''.$f['aux_page_ID'].'\',\''.$f['aux_page_name'].'\',\'page'.$i.'\',\'1000\',\''.$f['meta_keywords'].'\',\''.$f['aux_page_text'].'\',\''.$f['aux_page_text'].'\',\'1\'),';
  }


//�������
  $sql='select NID,add_date,title,picture,textToPublication from '.$us['srcpre'].'news_table';
  $result=mysql_query($sql);
  $sqlnews='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumnews[$nn]++;
    $date=substr(".","-",$f['add_date']);
    @$sqlnews[$nn].='(\''.$f['NID'].'\',\''.$date.'\',\''.addslashes($f['title']).'\',\''.addslashes($f['textToPublication']).'\'),';
  }

//������� �������������
//SS_custgroups 
//custgroupID custgroup_name custgroup_discount
//phpshop_shopusers_status 
//id name discount price enabled 
  $sql='select custgroupID, custgroup_name, custgroup_discount from '.$us['srcpre'].'custgroups';
  $result=mysql_query($sql);
  $sqlstatus='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumstatus[$nn]++;
    @$sqlstatus[$nn].='(\''.$f['custgroupID'].'\',\''.$f['custgroup_name'].'\',\''.$f['custgroup_discount'].'\',\'1\',\'1\'),';
  }


//������������
//SS_customers 
//customerID Login cust_password Email first_name last_name custgroupID addressID reg_datetime
//SS_customer_addresses 
//addressID customerID countryID zip city address 
//SS_countries 
//countryID country_name country_iso_2 country_iso_3 
//SS_customer_reg_fields 

//reg_field_ID reg_field_name 

//SS_customer_reg_fields_values 
//reg_field_ID customerID reg_field_value 


//phpshop_shopusers 
//id login password datas mail name adres enabled status

  $sql='select customerID,Login, cust_password, Email, first_name, last_name, custgroupID, addressID, reg_datetime from '.$us['srcpre'].'customers';
  $result=mysql_query($sql);
  $sqlshopusers='';
  $i=0;
  $nn=0;
  $lim=500;

  
  while ($f=mysql_fetch_array($result)) {
    if ($i>$lim) {$nn++; $i=0;} else {$i++;}
    @$sumshopusers[$nn]++;

	$sql2='select addressID, customerID, countryID, zip, city, address from '.$us['srcpre'].'customer_addresses WHERE customerID='.$f['customerID'];
	$result2=mysql_query($sql2);
	$f2=mysql_fetch_array($result2);

	if ($f2['countryID']) {
		$sql3='select country_name from '.$us['srcpre'].'countries WHERE countryID='.$f2['countryID'];
		$result3=mysql_query($sql3);
		$f3=mysql_fetch_array($result3);
		$country=$f3['country_name'];
	} else {
		$country='';
	}

	$addfields='';
	$adres='';
	$sql4='select reg_field_ID, reg_field_value  from '.$us['srcpre'].'customer_reg_fields_values WHERE customerID='.$f['customerID'];
	$result4=mysql_query($sql4);
	while ($f4=mysql_fetch_array($result4)) {
		$sql5='select reg_field_name from '.$us['srcpre'].'customer_reg_fields WHERE reg_field_ID='.$f4['reg_field_ID'];
		$result5=mysql_query($sql5);
		$f5=mysql_fetch_array($result5);
		$addfields.=$f5['reg_field_name'].': '.$f4['reg_field_value']."\n\r";
	}



	$adres=addslashes($country."\n\r".$f2['zip']."\n\r".$f2['city']."\n\r".$f2['address']."\n\r".$addfields);
    $datetime=strtotime($f['reg_datetime']);
    $string='(\''.$f['customerID'].'\',\''.addslashes($f['Login']).'\',\''.addslashes($f['cust_password']).'\',\''.$datetime.'\',\''.addslashes($f['Email']).'\',\''.addslashes($f['first_name']).' '.addslashes($f['last_name']).'\',\''.$adres.'\',\'1\',\''.$f['custgroupID'].'\'),';
    @$sqlshopusers[$nn].=$string;
  }







//���������� �  �� ����������
  @mysql_connect($us['trghost'],$us['trguser'],$us['trgpass']) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ����������� � �������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CONNECT_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>'.mysql_errno().mysql_error());
  @mysql_select_db ($us['trgname']) or die ('<P class=text>�������� ���� ���������, �� �� ����������� �������� ���� �� ������ ������ �� ��������.</P>�������: ���������� ������� ���� ������.<BR>����������, ������� �� <A href="mailto:'.$devmail.'?Subject=DB_CHOISE_ERROR">���� ������</A>, ����� �������� �������������� ����� � ������ �������������. ����� �������� ��� ������� ���� ����� ������ ���������������.</CENTER>');
  @mysql_query( 'set names cp1251' );


//������ ����
$query='TRUNCATE `'.$us['trgpre'].'categories`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'products`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'foto`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'page`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'news`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'shopusers`;';
$res = mysql_query($query);
$query='TRUNCATE `'.$us['trgpre'].'shopusers_status`;';
$res = mysql_query($query);


$packsum=count($sqlfoto)+count($sqlprod)+count($sqlcat);

  echo '������������: '.$packsum.' ��������<BR>';

//����� ���������
foreach ($sqlcat as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'categories` (id, name, num, parent_to, content, descrip, descrip_enabled, keywords, keywords_enabled) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (���������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumcat[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//����� �������
foreach ($sqlprod as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'products` (id, category, name, description, content, price, price_n, sklad, p_enabled, enabled, uid, num, descrip, descrip_enabled, keywords, keywords_enabled, pic_small, pic_big, weight) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumprod[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

if (isset($sqlfoto) && (count($sqlfoto)>0)) {
//����� �����
foreach ($sqlfoto as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'foto` (id,parent, name,num) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (����) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumfoto[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}
}

if (isset($sqlfotoold) && (count($sqlfotoold)>0)) {
//����� ����� �� �������
foreach ($sqlfotoold as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='UPDATE `'.$us['trgpre'].'products` '.$sql.');';
  $suc=mysql_query($sql);
  echo '�������� (���� �� �������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumfoto[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}
}

//����� �������
foreach ($sqlpages as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'page` (id,name, link, category, keywords, description, content, enabled) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (��������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumpages[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//����� �������
foreach ($sqlnews as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'news` (id,datas,zag,kratko) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (�������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumnews[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//����� ��������
//phpshop_shopusers_status 
//id name discount price enabled 
foreach ($sqlstatus as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'shopusers_status` (id, name, discount, price, enabled) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (������� �������������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumstatus[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}

//���� �������������
//phpshop_shopusers 
//id login password datas mail name adres enabled status

foreach ($sqlshopusers as $nn=>$sql) {
  $sql=substr($sql,0, strlen($sql)-1);
  $sql='INSERT INTO `'.$us['trgpre'].'shopusers` (id, login, password, datas, mail, name, adres, enabled, status) VALUES '.$sql.';';
  $suc=mysql_query($sql);
  echo '�������� (������������) �'.$nn.' �������: "'.$suc.'". � ��� '.$sumshopusers[$nn].' �������.<BR>';
  if (!$suc) {
    echo $sql;
  }
}




//SRC TABLES
//SS_categories 
//cells: categoryID name parent description sort_order meta_description meta_keywords 
//SS_products 
//cells:  productID categoryID name description Price in_stock enabled brief_description list_price product_code sort_order default_picture weight meta_description meta_keywords
//SS_product_pictures
//cells: photoID, productID, filename, thumbnail
//SS_aux_pages 
//cells:aux_page_ID aux_page_name aux_page_text meta_keywords meta_description 
//SS_news_table 
//cells:NID  add_date  title  picture  textToPublication
//21.03.2008

//TRG TABLES
//phpshop_categories 
//cells: id name num parent_to content descrip descrip_enabled keywords keywords_enabled
//phpshop_products 
//cells: id category name description content price price_n sklad p_enabled enabled uid num descrip descrip_enabled keywords keywords_enabled pic_small pic_big weight
//phpshop_foto 
//cells: id parent name
//phpshop_page 
//cells: id name link category keywords description content enabled
//phpshop_news 
//cells:id  datas  zag  kratko  podrob  
//21-03-2008
 
}


?>


</BODY>
</HTML>
