<?

function SaveImg($img)
// ��������� ���������� �������� (GIF ��� JPEG) � ������ �������� + watermark
	//	$img[ufiletyle] = $_FILES['userfile']['type'];	// ��� �����
	//	$img[utmpname] = $_FILES['userfile']['tmp_name'];	  // ��������� ����
	//	$img[path] = '/home/mrm/www/upload/test/';  // ���� ���������
	//	$img[tpath] = '/home/mrm/www/upload/test/'; // ���� ��������� ��������
	//	$img[name] = "original";	  // ��� ��� ������� ��������� (��� ����������)
	//	$img[tname] = "tumba";	  // ��� ��������� (��� ����������)
	//	$img[q] = 60; // ��������
	//	$img[tq] = 60; // �������� �����
	//	$img[wm] = "mrm.ru";	// ��������� �������� (!!! ������ ���������� !!!)
	//	$img[wmargin] = 20; // ������
	//	$img[twm] = 1; // ������� watermark �� ��������
	//	$img[twmargin] = 10; // ������ �� �����
	//	$img[minwater] = 50;	 // ����������� ������ ������ ��� ��������� �� ��������
	//	$img[tminwater] = 50; // ����������� ������ ������ ��� ��������� �� �����
	//	$img[w] = 100;						// ����. ������ ���������
	//	$img[h] = 100;						// ����. ������ ���������
	//	$img[realsize] = false;					// ��������� ������������ ������
	//	$img[tw] = 100;						// ����. ������ ���������
	//	$img[th] = 100;							// ����. ������ ���������
	//	$img[maxsize] = 102400;		// ����. ������ � ��
{
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
					$t = $img[path] . $img[tname].".gif";
					$type = true;
				}
				elseif (($img[ufiletyle]=="image/pjpeg")OR($img[ufiletyle]=="image/jpeg"))
				{
					$ftype = "jpeg";
					$f = $img[path] . $img[name].".jpg";
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
												// ��������� ������
												if ($fsize==1)
													{
													// ��������� �������� � ������ �� ������� :)
													
																// ���� ����� ��������	  ��� ������������ ����
																  if ($tumb)
																	{
																			 
																			$src_img = @imagecreatefromgif("$f");
																			$tpcolor = imagecolorat($src_img, 0, 0);
																			$dst_imgt = imagecreate($new_t_w, $new_t_h);
																			imagepalettecopy($dst_imgt,$src_img);
																			imagecopyresized($dst_imgt,$src_img, 0, 0, 0, 0, $new_t_w, $new_t_h,imagesx($src_img),imagesy($src_img));
																			$pixel_over_black = imagecolorat($dst_imgt, 0, 0);         
																			$bg = imagecolorallocate($dst_imgt, 255, 255, 255);
																			imagefilledrectangle($dst_imgt, 0, 0, $new_t_w, $new_t_h,$bg);
																			imagecopyresized($dst_imgt, $src_img, 0, 0, 0, 0, $new_t_w, $new_t_h,imagesx($src_img),imagesy($src_img));												
																			imagegif($dst_imgt, "$t");
																			imagedestroy ($src_img); 
																			imagedestroy ($dst_imgt);	
																	}
													}
													else {
															//���������
														// ������������� � ������
																$src_img = imagecreatefromgif("$f");
																$dst_img =imagecreatetruecolor($new_w,$new_h);
																imagecolortransparent($dst_img);
																imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img));
														   /*	 // ���� c ���������� �������������, �� �� TrueColor
																$src_img = @imagecreatefromgif("$f");
																$tpcolor = imagecolorat($src_img, 0, 0);
																$dst_img = imagecreate($new_w, $new_h);
																imagepalettecopy($dst_img,$src_img);
																imagecopyresized($dst_img,$src_img, 0, 0, 0, 0, $new_w, $new_h,imagesx($src_img),imagesy($src_img));
																$pixel_over_black = imagecolorat($dst_img, 0, 0);         
																$bg = imagecolorallocate($dst_img, 255, 255, 255);
																imagefilledrectangle($dst_img, 0, 0, $new_w, $new_h,$bg);
																imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $new_w, $new_h,imagesx($src_img),imagesy($src_img));				
														*/							
												


													if (($img[wm])&&($new_h>=$img[minwater])&&($new_w>=$img[minwater]))
													{
													// WATERMARK
													
														$mark_v = $img[wmargin]/2;
														$mark_v1 = $mark_v-1;
														$mark_h = $new_h - $img[wmargin];
														$mark_h2 = $new_h - $img[wmargin]-1;

														$rgb = imagecolorat($dst_img,$mark_v,$mark_h);
														//$rgb = imagecolorsforindex($dst_img, $rgb);
														$r = ($rgb >> 16) & 0xFF;
														$g = ($rgb >> 8) & 0xFF;
														$b = $rgb & 0xFF;

														$max = min($r, $g, $b);
														$min = max($r, $g, $b);
														$lightness = (double)(($max + $min) / 2);

														if ($lightness >= 0.5)
															{													
															$tc = ImageColorAllocate($dst_img, 255, 255, 255);
															$tc2 = ImageColorAllocate($dst_img, 0, 0, 0);
															}
															else 
																{
																$tc = ImageColorAllocate($dst_img, 0, 0, 0);
																$tc2 = ImageColorAllocate($dst_img, 255, 255,255);
																}
														ImageString ($dst_img, 2, $mark_v, $mark_h, $img[wm], $tc);
														ImageString ($dst_img, 2, $mark_v1, $mark_h2, $img[wm], $tc2);
													}

													if ($tumb)
														{
															$dst_imgt = imagecreatetruecolor($new_t_w,$new_t_h);
															imagecopyresampled($dst_imgt,$src_img,0,0,0,0,$new_t_w,$new_t_h,imagesx($src_img),imagesy($src_img)); 
															 /* // ���� c ���������� �������������, �� �� TrueColor
															$dst_imgt = imagecreate($new_t_w,$new_t_h);
															imagepalettecopy($dst_imgt,$src_img);
															imagecopyresized($dst_imgt,$src_img, 0, 0, 0, 0, $new_t_w, $new_t_h,imagesx($src_img),imagesy($src_img));
															$pixel_over_black = imagecolorat($dst_imgt, 0, 0);         
															$bg = imagecolorallocate($dst_imgt, 255, 255, 255);
															imagefilledrectangle($dst_imgt, 0, 0, $new_t_w, $new_t_h,$bg);
															imagecopyresized($dst_imgt, $src_img, 0, 0, 0, 0, $new_t_w, $new_t_h,imagesx($src_img),imagesy($src_img));	
															 */
																	 if (($img[wm])&&($img[twm])&&($new_t_h>=$img[tminwater])&&($new_t_w>=$img[tminwater]))
																	{
																	// TUMBNAIL WATERMARK
																		$mark_v = $img[wmargin]/2;
																		$mark_v1 = $mark_v-1;
																		$mark_h = $new_h - $img[twmargin];
																		$mark_h2 = $new_h - $img[twmargin]-1;

																		$rgb = imagecolorat($dst_imgt,$mark_v,$mark_h);
																		$r = ($rgb >> 16) & 0xFF;
																		$g = ($rgb >> 8) & 0xFF;
																		$b = $rgb & 0xFF;

																		$max = min($r, $g, $b);
																		$min = max($r, $g, $b);
																		$lightness = (double)(($max + $min) / 510.0);

																		if ($lightness > 0.5)
																			{
																			$tc = ImageColorAllocate($dst_imgt, 255, 255, 255);
																			$tc2 = ImageColorAllocate($dst_imgt, 0, 0, 0);
																			}
																			else 
																				{
																				$tc = ImageColorAllocate($dst_imgt, 0, 0, 0);
																				$tc2 = ImageColorAllocate($dst_imgt, 255, 255,255);
																				}
																		ImageString ($dst_imgt, 1, $mark_v, $mark_h, $img[wm], $tc);
																		ImageString ($dst_imgt, 1, $mark_v1, $mark_h2, $img[wm], $tc2);
																	}

															imagegif($dst_imgt, "$t",$img[tq]);
															imagedestroy ($dst_imgt);
														}

												imagegif($dst_img, "$f");
												imagedestroy ($src_img); 
												imagedestroy ($dst_img);														
															}												

												}
									// JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG ======= JPEG 
											if ($ftype == "jpeg")
												{											
												$dst_img = imagecreatetruecolor($new_w,$new_h);
												$src_img = imagecreatefromjpeg("$f");
												imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,imagesx($src_img),imagesy($src_img)); 										
													if (($img[wm])&&($new_h>=$img[minwater])&&($new_w>=$img[minwater]))
													{
													// WATERMARK
														$mark_v = $img[wmargin]/2;
														$mark_v1 = $mark_v-1;
														$mark_h = $new_h - $img[wmargin];
														$mark_h2 = $new_h - $img[wmargin]-1;

														$rgb = imagecolorat($dst_img,$mark_v,$mark_h);
														$r = ($rgb >> 16) & 0xFF;
														$g = ($rgb >> 8) & 0xFF;
														$b = $rgb & 0xFF;

														$max = min($r, $g, $b);
														$min = max($r, $g, $b);
														$lightness = (double)(($max + $min) / 510.0);

														if ($lightness > 0.5)
															{
															$tc = ImageColorAllocate($dst_img, 255, 255, 255);
															$tc2 = ImageColorAllocate($dst_img, 0, 0, 0);
															}
															else 
																{
																$tc = ImageColorAllocate($dst_img, 0, 0, 0);
																$tc2 = ImageColorAllocate($dst_img, 255, 255,255);
																}
														ImageString ($dst_img, 2, $mark_v, $mark_h, $img[wm], $tc);
														ImageString ($dst_img, 2, $mark_v1, $mark_h2, $img[wm], $tc2);
													}
												imagejpeg($dst_img, "$f",$img[q]);

													if ($tumb)
														{
															$dst_imgt = imagecreatetruecolor($new_t_w,$new_t_h);
															imagecopyresampled($dst_imgt,$src_img,0,0,0,0,$new_t_w,$new_t_h,imagesx($src_img),imagesy($src_img));
													
																if (($img[wm])&&($img[twm])&&($new_t_h>=$img[tminwater])&&($new_t_w>=$img[tminwater]))
																	{
																	// TUMBNAIL WATERMARK
																		$mark_v = $img[twmargin]/2;
																		$mark_v1 = $mark_v-1;
																		$mark_h = $new_t_h - $img[twmargin];
																		$mark_h2 = $new_t_h - $img[twmargin]-1;

																		$rgb = imagecolorat($dst_imgt,$mark_v,$mark_h);
																		$r = ($rgb >> 16) & 0xFF;
																		$g = ($rgb >> 8) & 0xFF;
																		$b = $rgb & 0xFF;

																		$max = min($r, $g, $b);
																		$min = max($r, $g, $b);
																		$lightness = (double)(($max + $min) / 510.0);

																		if ($lightness > 0.5)
																			{
																			$tc = ImageColorAllocate($dst_imgt, 255, 255, 255);
																			$tc2 = ImageColorAllocate($dst_imgt, 0, 0, 0);
																			}
																			else 
																				{
																				$tc = ImageColorAllocate($dst_imgt, 0, 0, 0);
																				$tc2 = ImageColorAllocate($dst_imgt, 255, 255,255);
																				}
																		ImageString ($dst_imgt, 1, $mark_v, $mark_h, $img[wm], $tc);
																		ImageString ($dst_imgt, 1, $mark_v1, $mark_h2, $img[wm], $tc2);

																	}

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
?>