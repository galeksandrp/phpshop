<?
$dir=GetEnv("DOCUMENT_ROOT").'/install/migration/';


$a=glob($dir.'*.php');            //��������� ������� � ������� ����� � ���������
//uasort($a,"cmp");           // ��������� ���� ������


echo '<HEAD><TITLE>������ ���������� �����</TITLE></HEAD><BODY>';

$ii=0;
foreach ($a as $aa=>$bb) {
  if (!(is_dir($bb))) { //���� ������
    $ii++;
    $file1=$dir.basename($bb);
    $f1 = fopen($file1, "r+t");    // ��������� ���� ��������
    $black = fread($f1, filesize($file1));     // ������ ��������, ����������� � �����
    fclose($f1);                  // ��������� ����
    $black=explode("\n",$black);

    if (basename($bb)!=="index.php") {
      echo $ii.'. <A href="/install/migration/'.basename($bb).'">'.basename($bb).'</A> - '.$black[1].'<BR>';
    }
  }
}

echo '</BODY>';

?>