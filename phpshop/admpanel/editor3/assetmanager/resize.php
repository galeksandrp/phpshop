<?
session_start();
$SysValue=parse_ini_file("../../../../phpshop/inc/config.ini",1);

// ���������� ����������
$host=$SysValue['connect']['host'];             
$user_db=$SysValue['connect']['user_db'];       
$pass_db=$SysValue['connect']['pass_db'];       
$dbase=$SysValue['connect']['dbase'];   
$table_name19=$SysValue['base']['table_name19'];

@mysql_connect ("$host", "$user_db", "$pass_db")or @die("���������� �������������� � ����");
mysql_select_db("$dbase")or @die("���������� �������������� � ����");


require("../../watermark/watermarkFunc.php");
require("../../connect.php");
require("../../enter_to_admin.php");
include("settings.php");


function SaveImg2($img, $option)

{
$font="../../../../phpshop/lib/font/norobot_font.ttf";
				if ((!$img)or(!$img[utmpname]))
				{
					$err=1;
					$errinfo[] = "��� ������";
					$type = false;
				}

				if ($img[ufiletyle]=="image/gif")
				{
					$ftype = "gif";
					$f = $img[path] . $img[name].".gif";
					$b = $img[path] . $img[name_big].".gif";
					$t = $img[path] . $img[tname].".gif";
					$type = true;
				}
				elseif (($img[ufiletyle]=="image/pjpeg")OR($img[ufiletyle]=="image/jpeg"))
				{
					$ftype = "jpeg";
					$f = $img[path] . $img[name].".jpg";
					$b = $img[path] . $img[name_big].".jpg";
					$t = $img[path] . $img[tname].".jpg";
					$type = true;
				}
				elseif(!$err) 
					{
						$err=1;
						$errinfo[] = "������������ ������ ����� (���������: GIF � JPEG)";
						$type = false;
					}
					
				


// ���� ���� ������ �� ��������� - �� ����� :)	
	if (($img[tpath])&&($img[tw])&&($img[th]))
		{
			$tumb = 1; // ����� ��������: 1/0
		}


// ���� ��������
if ($type)
{
if (move_uploaded_file($img[utmpname], $f))
{
 //----------------------------------------- ������ --------------------
		$realsize = getimagesize($f);

	// ------------------------------------------------------------ ������ �������� �������� � ����� ---------------------------------		
		// ��������
		if ((($realsize[0]<=$img[w])&&($realsize[1]<=$img[h]))OR($img[realsize]))
			{
			$fsize=1;
			$new_w = $realsize[0];
			$new_h = $realsize[1];
			}
			else 
				{				 
				// ��������� ������� ��������� ���� ��� ������ �������
					// ���� ������ ������
						if ($realsize[0]>=$realsize[1])
							{
								// ����������� ����� ������
								 $new_h =  (int)$new_h =  $realsize[1]/$realsize[0]*$img[w];
								 $new_w = (int)$new_w = $img[w];
											 // ���� ������������ ������ ������ �����������, ������������� 
											 if ($new_h>$img[h])
												{
												$new_w = (int)$new_w =  $realsize[0]/$realsize[1]*$img[h];
												$new_h =  (int)$new_h =  $img[h];
												}
							}

						  if ($realsize[0]<$realsize[1])
							{
							 	$new_w = (int)$new_w =  $realsize[0]/$realsize[1]*$img[h];
								$new_h =  (int)$new_h =  $img[h];
											  // ���� ������������ ������ ������ �����������, �������������
											 if ($new_w>$img[w])
												{
												$new_h =  (int)$new_h =  $realsize[1]/$realsize[0]*$img[w];
												$new_w = (int)$new_w = $img[w];
												}
							}


			
				}

			if ($tumb)
			{
					// �������� (���� �����)	
					if (($realsize[0]<=$img[tw])&&($realsize[1]<=$img[th]))
						{
						$tsize=1;
						$new_t_w = $realsize[0];
						$new_t_h = $realsize[1];
						}
						else
							{
							// ��������� ������� ��������  ���� �������� ������ ������������ �������� ������ �������
								// ���� ������ ������
									if ($realsize[0]>=$realsize[1])
										{
											// ����������� ����� ������
											 $new_t_h =  (int)$new_t_h =  $realsize[1]/$realsize[0]*$img[tw];
											 $new_t_w = (int)$new_t_w = $img[tw];
											 // ���� ������������ ������ ������ �����������, ������������� 
											 if ($new_t_h>$img[th])
												{
												$new_t_w = (int)$new_t_w =  $realsize[0]/$realsize[1]*$img[th];
												$new_t_h =  (int)$new_t_h =  $img[th];
												}
										}

									  if ($realsize[0]<$realsize[1])
										{
											$new_t_w = (int)$new_t_w =  $realsize[0]/$realsize[1]*$img[th];
											$new_t_h =  (int)$new_t_h =  $img[th];
											 // ���� ������������ ������ ������ �����������, �������������
											 if ($new_t_w>$img[tw])
												{
												$new_t_h =  (int)$new_t_h =  $realsize[1]/$realsize[0]*$img[tw];
												$new_t_w = (int)$new_t_w = $img[tw];
												}
										}
						
							}
				}
					else
					{
					//$errinfo[] = "�������� �� �����";
					}
					
								// � ����������� �� ���� ����� ������� img
									// GIF ======= GIF ======= GIF ======= GIF ======= GIF ======= GIF ======= GIF ======= GIF 
											if ($ftype == "gif")
												{
												$src_img = imagecreatefromgif("$f");
												
												// �������� �������� ��������
					
																if ($option['image_save_source'] == 1){																																	
																	$src_img1 = imagecreatefromgif("$f");
																    $dst_img1 = WatermarkFactory($src_img1, $option, 3);
																	imagegif($dst_img1, "$b");
																	@chmod("$b", 0644); 
																	imagedestroy ($src_img1); 
																}
																
												$dst_img = imagecreatetruecolor($new_w,$new_h);
												
												imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 										
												

												$dst_img = WatermarkFactory($dst_img, $option, 1);

												imagegif($dst_img, "$f");
                                                @chmod("$f", 0644); 
													if ($tumb)
														{
															$dst_imgt = imagecreatetruecolor($new_t_w,$new_t_h);
															imagecopyresampled($dst_imgt,$src_img,0,0,0,0,$new_t_w,$new_t_h,imagesx($src_img),imagesy($src_img));
													
															$dst_imgt = WatermarkFactory($dst_imgt, $option, 2);

															imagegif($dst_imgt, "$t");
															imagedestroy ($dst_imgt);
														}
												imagedestroy ($src_img); 
												imagedestroy ($dst_img);

												}
									// JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG 
											if ($ftype == "jpeg")
												{											
												
												$src_img = imagecreatefromjpeg("$f");
												
												// �������� �������� ��������
					
																if ($option['image_save_source'] == 1){																																	
																	$src_img1 = imagecreatefromjpeg("$f");
																    $dst_img1 = WatermarkFactory($src_img1, $option, 3);
																	imagejpeg($dst_img1, "$b",100);
																	@chmod("$b", 0644); 
																	imagedestroy ($src_img1); 
																}
																
												$dst_img = imagecreatetruecolor($new_w,$new_h);
												
												imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 										
												

												$dst_img = WatermarkFactory($dst_img, $option, 1);

												imagejpeg($dst_img, "$f",$img[q]);
                                                @chmod("$f", 0644); 
													if ($tumb)
														{
															$dst_imgt = imagecreatetruecolor($new_t_w,$new_t_h);
															imagecopyresampled($dst_imgt,$src_img,0,0,0,0,$new_t_w,$new_t_h,imagesx($src_img),imagesy($src_img));
													
															$dst_imgt = WatermarkFactory($dst_imgt, $option, 2);

															imagejpeg($dst_imgt, "$t",$img[tq]);
															imagedestroy ($dst_imgt);
														}
												imagedestroy ($src_img); 
												imagedestroy ($dst_img);
												}

// �� ������ ����� ����� ��������� ������ ��������� ������, �� ������ �� �������?

			$fsize = filesize($f);
			if ($fsize>$img[maxsize])
				{
				 @unlink($f);
				 @unlink($t);
				$err=1;
				$errinfo[] = "������ ����� ��������� ����������";

				}


 //----------------------------------------- ������ --------------------							
	
	} else
		// ���� ���� �� UPLOAD
		{			 unlink($img[utmpname]);
					$err=1;
					$errinfo[] = "������ �������";
		}
}

// �������� ������ �� �����
$out[err] = $errinfo;
$out[filename] = $img[name].".".$ftype;
$out[fullfile] =$f; 
$out[fulltumb] =$t;
$out[type] = $ftype;
$out[fsize] = $fsize;
$out[w] = $new_w;
$out[h] = $new_h;


return ($out);
}


Function writeFolderSelections()
	{
	global $sBase0;
	global $sBase1;
	global $sBase2;
	global $sBase3;
	global $sName0;
	global $sName1;	
	global $sName2;
	global $sName3;	
	global $currFolder;
	
	echo "<select name='selCurrFolder' id='selCurrFolder' class='inpSel'>";
	recursive($sBase0,$sBase0,$sName0);
	if($sBase1!="")recursive($sBase1,$sBase1,$sName1);
	if($sBase2!="")recursive($sBase2,$sBase2,$sName2);
	if($sBase3!="")recursive($sBase3,$sBase3,$sName3);
	echo "</select>";
	}

Function recursive($sPath,$sPath_base,$sName)
	{
	global $sBase0;
	global $sBase1;
	global $sBase2;
	global $sBase3;
	global $currFolder;

	if($sPath==$sBase0 ||$sPath==$sBase1 ||$sPath==$sBase2 ||$sPath==$sBase3)
		{
		if($currFolder==$sPath)
			echo "<option value='$sPath' selected>$sName</option>";
		else
			echo "<option value='$sPath'>$sName</option>";
		}
		
	$oItem=opendir($sPath);   
	while($sItem=readdir($oItem)) 
		{   
		if($sItem=="."||$sItem=="..") 
			{
			} 
		else 
			{ 
			$sCurrent=$sPath."/".$sItem;
			$fIsDirectory=is_dir($sCurrent);
			
			$sDisplayed=ereg_replace($sBase0,"",$sCurrent);
			if($sBase1<>"") $sDisplayed=ereg_replace($sBase1,"",$sDisplayed);
			if($sBase2<>"") $sDisplayed=ereg_replace($sBase2,"",$sDisplayed);
			if($sBase3<>"") $sDisplayed=ereg_replace($sBase3,"",$sDisplayed);
			$sDisplayed=$sName.$sDisplayed;
			
			if($fIsDirectory) 
				{
				if($currFolder==$sCurrent)
					echo "<option value='$sCurrent' selected>$sDisplayed</option>";
				else
					echo "<option value='$sCurrent'>$sDisplayed</option>";
					 
				recursive($sCurrent,$sPath,$sName);
				}				
			} 
		}  
	closedir($oItem); 
	}
$GetSystems=GetSystems();
?>
<base target="_self">
<html>
<head>
<title>�����. �������</title>
<meta http-equiv="Content-Type" content="text-html; charset=Windows-1252">
<meta http-equiv="MSThemeCompatible" content="Yes">
<LINK href="../../css/texts.css" type=text/css rel=stylesheet>
<script language="JavaScript" src="../../java/javaMG.js" type="text/javascript"></script>
<SCRIPT language="JavaScript" src="/phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>

<script> 
DoResize(<? echo $GetSystems['width_icon']?>,350,200);
</script>
<body style="margin:0px;">
<?
if(!isset($load)){
?>


<FORM name="upload"  method="post" encType="multipart/form-data">
<table width="100%"  align=center cellpadding=5 cellspacing=5 border=0>
<tr>
<td>
<span>����������</span><br>
<?writeFolderSelections()?>
</td>
</tr>
<tr>
  <td valign=top>
	<span>�������� ���� � �����������</span> *.gif, *.jpg<br>
	<INPUT type=file name="userfile" style="width: 300px"><br>
</td>
</tr>
</table>
<hr>
<table width="100%" align=center cellpadding=0 cellspacing=0 border=0>
<tr>
  <td valign=top align="right" style="padding:10px">
<input type="submit" value="���������" class="but">
<INPUT class=but name="btnLang" onclick="self.close()" type=reset value=������> 
<input type="hidden" name="load" value="<?=@$id?>">
</td>
</tr>
</table>
</FORM>
<?
}
else {


$Admoption=unserialize($GetSystems['admoption']);

$mycF=$_POST["selCurrFolder"];
$mycReturn=ereg_replace($_SERVER['DOCUMENT_ROOT'],"",$_POST["selCurrFolder"]);

// ������� ���
$myRName=substr(abs(crc32(uniqid($_REQUEST['id']))),0,5);

$img[ufiletyle] = $_FILES['userfile']['type'];	// ��� �����
$img[utmpname] = $_FILES['userfile']['tmp_name'];	  // ��������� ����
$img[path] = $mycF."/";  // ���� ���������
$img[tpath] = $mycF."/"; // ���� ��������� ��������
$img[name] = "img".$_REQUEST['id']."_$myRName";// ��� ��� ������� ��������� (��� ����������)
$img[name_big] = "img".$_REQUEST['id']."_".$myRName."_big";// ��� ��� ������� ��������� �������� �������� (��� ����������)
$img[tname] = "img".$_REQUEST['id']."_".$myRName."s";	  // ��� ��������� (��� ����������)
$img[q] = $Admoption[width_podrobno]; // ��������
$img[tq] = $Admoption[width_kratko]; // �������� �����
$img[wm] = $Admoption[img_wm];	// ��������� �������� (!!! ������ ���������� !!!)
$img[size]=13; // ������ ������
$img[sizet]=10; // ������ ������ ��������
$img[wmargin] = 20; // ������
$img[twm] = 1; // ������� watermark �� ��������
$img[twmargin] = 10; // ������ �� �����
$img[minwater] = 50;	 // ����������� ������ ������ ��� ��������� �� ��������
$img[tminwater] = 50; // ����������� ������ ������ ��� ��������� �� �����
$img[w] = $Admoption[img_w];						// ����. ������ ���������
$img[h] = $Admoption[img_h];						// ����. ������ ���������
$img[realsize] = false;					// ��������� ������������ ������
$img[tw] = $Admoption[img_tw];						// ����. ������ ���������
$img[th] = $Admoption[img_th];							// ����. ������ ���������
$img[maxsize] = 1024000;		// ����. ������ � ��


$SaveImg=SaveImg2($img,$Admoption);


if ($img[ufiletyle]=="image/gif") $ftype = "gif";
				elseif (($img[ufiletyle]=="image/pjpeg")OR($img[ufiletyle]=="image/jpeg"))
					$ftype = "jpg";
					

					
mysql_query("INSERT INTO ".$SysValue['base']['table_name35']." VALUES ('','".$_REQUEST['id']."','$mycReturn/".$img[name].".".$ftype."','','')");
					
					

echo "
<script>


function DoUpdateFotoList(xid) {
var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
					window.opener.document.getElementById('fotolist').innerHTML = req.responseJS.interfaces;
// ����������� ����� ���������
window.opener.document.getElementById('pic_small').value='".$mycReturn."/".$img[name]."s.".$ftype."';
window.opener.document.getElementById('pic_big').value='".$mycReturn."/".$img[name].".".$ftype."';
			}
		}
		// �������������� ������.
		req.open(null, '".$SysValue['dir']['dir']."/phpshop/admpanel/product/action.php?do=update', true);
		req.send( {  xid: xid } );
}






DoUpdateFotoList(".$_REQUEST['id'].");
setTimeout('self.close()',1000);
</script>
";
}
?>

</body></html>