<?php

/**
 * ������ ����� �������
 * @package PHPShopDepricated
 * @param int $id_charact �� �������������
 * @param int $id_good �� ������
 * @return int
 */
function GetVoteValue($id_charact, $id_good) {
    global $SysValue,$link_db;

    $sql = 'select AVG(rate) as avg,COUNT(rate) as count from ' . $SysValue['base']['table_name52'] . ' where ((id_charact=' . $id_charact . ') AND (id_good=' . $id_good . ') AND (enabled="1"))';
    $result = mysqli_query($link_db,$sql);
    @$row = mysqli_fetch_array(@$result);
    $SysValue['sql']['num']++;
    $result2['avg'] = $row['avg'];
    $result2['count'] = round($row['count'], 1);

    return $result2;
}

/**
 * �������������� ����� � ����������� ���������
 * @package PHPShopDepricated
 * @param int $n
 * @param int $id
 * @param int $id_good
 * @return string
 */
function ShowStars($n, $id, $id_good) {

    $result = null;
    for ($y = 0; $y < 10; $y++) {
        $di = ceil($y / 2) * 2;
        $yy = $y + 1;
        if ($y < $n) {
            $cc = "";
        } else {
            $cc = "c";
        } //��������� ������ ���������
        if ($di == $y) { //�������� �� ��������� (���������� ������� ���������)
            $adder = '<IMG
				onMouseOver="rreplace(' . $id . ',' . $yy . '); darker(' . $id . ',' . $y . ');" 
				onMouseOut=""
				onMouseUp="rswitch(' . $id . ',' . $id_good . ')" 
				id="chim' . $id . $y . '" 
				src="images/shop/astara' . $cc . '.gif">';
        } else {
            $adder = '<IMG
				onMouseOver="rreplace(' . $id . ',' . $yy . '); darker(' . $id . ',' . $y . ');" 
				onMouseOut=""
				onMouseUp="rswitch(' . $id . ',' . $id_good . ')" 
				id="chim' . $id . $y . '" 
				src="images/shop/astarb' . $cc . '.gif">';
        }
        $result.=$adder;
    }
    return $result;
}

/**
 * �������������� ����� � ���������
 * @package PHPShopDepricated
 * @param int $n
 * @param int $id
 * @return string
 */
function ShowStars2($n, $id = false) {
    $result = null;
    for ($y = 0; $y < 10; $y++) {
        $di = ceil($y / 2) * 2;
        $yy = $y + 1;
        if ($y < $n) {
            $cc = "";
        } else {
            $cc = "c";
        } //��������� ������ ���������
        if ($di == $y) { //�������� �� ��������� (���������� ������� ���������)
            $adder = '<IMG id="chim' . $id . $y . '" src="images/shop/astara' . $cc . '.gif">';
        } else {
            $adder = '<IMG id="chim' . $id . $y . '" src="images/shop/astarb' . $cc . '.gif">';
        }
        $result.=$adder;
    }

    return $result;
}

/**
 * ����� ���� ������ ��� ������, � �������� ����� � ������������ ���������������
 * @package PHPShopElementsDepricated
 */
function rating($obj, $row) {
    global $SysValue,$link_db;

    $id_good = $row['id'];
    $ids_dir = $row['category'];

    $disp = $id_category = $script = $script2 = $all = $total2 = $votedate = null;

    // ����������� ����������
    if (!empty($_SESSION['UsersId']))
        $id_user = $_SESSION['UsersId'];
    else $id_user=null;

    if (!$ids_dir) {
        return "��� ������� ������ ������� �� ������������";
    }

    // �������� ������������� ������� ��������
    $sql = 'SELECT id_category,revoting FROM ' . $SysValue['base']['table_name50'] . ' WHERE ((ids_dir REGEXP ",' . $ids_dir . ',") AND (enabled="1"))';
    $result = mysqli_query($link_db,$sql);
    $SysValue['sql']['num']++;

    while (@$row = mysqli_fetch_array($result)) {
        $id_category.=',' . $row['id_category'];
        $revoting = $row['revoting'];
    }
    $id_category = substr($id_category, 1);

    if (!$id_category) {
        return "��� ������� ������ ������� �� ������������";
    }

    // �������� ������ ��������������
    $sql = 'SELECT id_charact,name FROM ' . $SysValue['base']['table_name51'] . ' WHERE ((id_category IN (' . $id_category . ')) AND (enabled="1")) ORDER BY num';
    $result = mysqli_query($link_db,$sql);
    $SysValue['sql']['num']++;

    @$chars_amount = mysqli_num_rows($result);
    if (!$chars_amount) {
        return "��� ������� ������ ������� �� ������������";
    }
    $i = 0;
    while (@$row = mysqli_fetch_array(@$result)) {
        $id_charact = $row['id_charact'];
        $disp.='<TR><TD>' . $row['name'] . '</TD>';

        // �������� ���������� �������, ��� ������ ��������������
        $avgcount = GetVoteValue($id_charact, $id_good);
        $amo = trim($avgcount['count']);
        if (!$amo) {
            $amo = "0";
        }

        $avgclean = trim($avgcount['avg']);
        $avg = ceil($avgclean);

        if (!empty($id_user)) {
            $sqlc = 'select rate,date from ' . $SysValue['base']['table_name52'] . ' where ((id_charact=' . $id_charact . ') AND (id_good=' . $id_good . ') AND (id_user=' . $id_user . '))';
            $resultc = mysqli_query($link_db,$sqlc);
            $yes = mysqli_num_rows($resultc);
            $SysValue['sql']['num']++;
        }

        if (!empty($yes)) {
            $rowc = mysqli_fetch_array($resultc);
            $rate = $rowc['rate'];
            $ratetxt = $rowc['rate'] / 2;
            $total2+=$rate;
            $votedate = date("d.m.Y H:i", $rowc['date']);
        } else {
            $rate = "0";
            $ratetxt = "���";
        }

        // ����������� ��������� ������ ������������������
        if ($id_user && ((!$yes) || ($yes && $revoting))) {
            $starsvote = ShowStars($rate, $id_charact, $id_good);
        } else {
            $starsvote = ShowStars2($rate);
        }

        $disp.='<TD>' . ShowStars2($avg) . ' ' . ($avg / 2) . '</TD>';
        $disp.='<TD>' . $starsvote . '
		<INPUT TYPE="TEXT" onMouseUp="switch' . $id_charact . '()" style="width:30px;" readonly disabled id="r' . $id_charact . '" name="ratechar[' . $id_charact . ']" value="' . $ratetxt . '">
		<IMG id="ok' . $id_charact . '" style="visibility:hidden;" SRC="images/shop/icon-activate.gif">
		</TD>';
        $disp.='</TR>';
        $script.='oknum[' . $i . ']="' . $id_charact . '";' . "\n";
        $script2.='oknum2[' . $i . ']="' . $id_charact . '";' . "\n";
        $i++;
        $all+=$avgclean;
    }

    $total = $all / $chars_amount;
    $total = round($total, 2);
    $total2 = $total2 / $chars_amount;
    $total2 = round($total2, 1);

    //���� ��� ����������
    if ($votedate) {
        $done = '�� ��� ���������� <BR>' . $votedate . '<BR>';
        if ($revoting) {
            $done.='������ ��������������.';
        } else {
            $done.='��������������� ���������';
        }
    } else {
        $done = '&nbsp;<BR>&nbsp;';
    }

    $disp = '<SCRIPT>
function checker(idc,idgood) {
oknum=new Array();
' . $script . '
bad=0;
for (i=0; i<oknum.length;i++) {
	curokname="ok"+oknum[i];
	if (document.getElementById(curokname).style.visibility == "hidden") {bad=1;}
}

if (bad==1) {
	document.getElementById("okfinal").style.visibility = "hidden";
	document.getElementById("rateit").style.visibility = "hidden";
} else {
	badbad=0;
	for (i=0; i<oknum.length;i++) {
		enabled=1;
		rate=0;
		idc=oknum[i];
		//���������� � ��
		var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					result=(req.responseJS.result||"");
					if (result=="7") {

					} else if(result=="0") {
						document.getElementById("statusdiv").innerHTML="�� ������� ���������!";
						badbad=1;
					}  
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		var dir=dirPath();// �������� ����������
		req.open("POST", "phpshop/ajax/ratingvote.php", true);
		req.send({ idc: idc,idgood:idgood,rate:rate,enabled:enabled });
		
		if (badbad==1) {
			document.getElementById("okfinal").style.visibility = "visible";
			document.getElementById("rateit").innerHTML = "�� ������� ���������!";

		} else {
			document.getElementById("rateit").style.visibility = "visible";
			window.location.reload();
		}

	}

}
}

function counttotal() {
oknum2=new Array();
' . $script2 . '
totalsum=0;
for (i2=0; i2<oknum2.length;i2++) {
	currname="r"+oknum2[i2];
	if (document.getElementById(currname).value=="���") {vale=0;} else {vale=document.getElementById(currname).value;}
	
        totalsum+=parseFloat(vale);
}

totalsum=totalsum/(oknum2.length);
tsum=Math.ceil(totalsum*10)/10;
//alert(oknum2.length);
document.getElementById("totalamount").innerHTML=tsum;
document.getElementById("r999").value =(tsum);
darker(999,totalsum*2);

}



function rreplace(idc,n) {
rname="r"+idc;
if (document.getElementById(rname).disabled==true) {document.getElementById(rname).value = n/2;}
counttotal();
}


function darker(idc,n) {
var nameimg="";
if (document.getElementById("r"+idc).disabled==false) {return;}
for (y=0; y<10; y++) {
	di=Math.ceil(y/2)*2;
	nameimg="chim"+idc+y;
if (y<=n) {
	if (di==y) { //�������� �� ��������� (���������� ������� ���������)
		document.getElementById(nameimg).src=\'images/shop/astarao.gif\';
	}  else {
		document.getElementById(nameimg).src=\'images/shop/astarbo.gif\'; 
	}
} else {
	if (di==y) { //�������� �� ��������� (���������� ������� ���������)
		document.getElementById(nameimg).src=\'images/shop/astarac.gif\';
	}  else {
		document.getElementById(nameimg).src=\'images/shop/astarbc.gif\'; 
	}

}

} //for
}		  


function rswitch(idc,idgood) {
rname="r"+idc;
okname="ok"+idc;
	if (document.getElementById(rname).disabled==true) {
		var rate=document.getElementById(rname).value;
		rate=rate*2;
		enabled=0;
		//���������� � ��
		var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					result=(req.responseJS.result||"");
					if (result=="1") {
						document.getElementById(rname).disabled=false;
						document.getElementById(okname).style.visibility = "visible";
						document.getElementById("statusdiv").innerHTML="�� ������������. <BR>��� ����� �����!";
						checker(idc,idgood);
					} else if(result=="2") {
						document.getElementById(rname).disabled=false;
						document.getElementById(okname).style.visibility = "visible";
						document.getElementById("statusdiv").innerHTML="�� ��� ����������.<BR> ������ ���������.";
						checker(idc,idgood);
					} else if(result=="3") {
						document.getElementById(rname).disabled=false;
						document.getElementById(okname).style.visibility = "visible";
						document.getElementById("statusdiv").innerHTML="��������� ��������.<BR>&nbsp;";
						checker(idc,idgood);
					} else if(result=="0") {
						document.getElementById("statusdiv").innerHTML="�� �� ������������. ��������<BR> ����������� ��� ����������� ��������!";

					}  
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		var dir=dirPath();// �������� ����������
		req.open("POST", "phpshop/ajax/ratingvote.php", true);
		req.send({ idc: idc,idgood:idgood,rate:rate,enabled:enabled });
	} else {
		document.getElementById(rname).disabled=true;
		document.getElementById(okname).style.visibility = "hidden";
	}
checker(idc,idgood);
}



</SCRIPT>
<FORM>
<TABLE celpadding=1>
<TR><TD><B>��������������</TD><TD><B>������:</B></TD><TD><B>���� ������:</B></TD></TR>
' . $disp . '
<TR><TD>�����:</TD><TD>' . ShowStars2($total) . ' ' . ($total / 2) . '</TD><TD>
' . ShowStars2($total2, 999) . ' <B id="totalamount">' . ($total2 / 2) . '</B>
<INPUT TYPE="HIDDEN" disabled id="r999" value="���">
<IMG id="okfinal" style="visibility:hidden;" SRC="images/shop/icon-activate.gif">

</TD></TR>
<TR>
<TD colspan=2><I>����� ���������� ������: <B>' . $amo . '</B></I></TD>
<TD>
<DIV id="statusdiv">' . $done . '</DIV>';

    if ($id_user) {
        $disp.='<DIV id="rateit" style="color:green; visibility:hidden;" >���������</DIV>';
    } else {
        $disp.='������ <A href="/users/register.html">������������������ ������������</A><BR>
		 ����� ���������� ������ �������!';
    }
    $disp.='</TD></TR></TABLE></FORM>';
    $obj->set('ratingfull', $disp);
}

/**
 * ������ ����� ������
 * @package PHPShopDepricated
 * @param int $id �� ������
 * @return string
 */
function getgoodname($id) {
    global $SysValue,$link_db;

    $sql = "select name from " . $SysValue['base']['table_name2'] . " where id=$id and enabled='1'";
    $result = mysqli_query($link_db,$sql);
    @$amount = mysqli_num_rows($result);
    if (!$amount) {
        return false;
    } else {
        @$row = mysqli_fetch_array(@$result);
        return $row['name'];
    }
}

/**
 * ����� ���� ������ ��� ������, � �������� ����� � ������������ ��������������
 * @package PHPShopElementsDepricated
 * @return string
 */
function ratingtop() {
    global $SysValue,$link_db;

    $top = null;
    $sql = 'select AVG(rate) as avg,COUNT(DISTINCT id_user) as count, (AVG(rate)*COUNT(DISTINCT id_user)*0.5) as ttr, id_good from ' . $SysValue['base']['table_name52'] . ' where ((enabled="1"))  GROUP BY id_good ORDER BY ttr DESC LIMIT 20';
    $result = mysqli_query($link_db,$sql);
    while (@$row = mysqli_fetch_array(@$result)) {
        $rate = round($row['avg'], 2) / 2;
        $id = $row['id_good'];
        $name = getgoodname($id);
        if ($name) {
            $top.='<TR><TD><A href="shop/UID_' . $id . '.html">' . $name . '</A></TD><TD>' . $rate . '</TD><TD>' . $row['count'] . '</TD><TD>' . $row['ttr'] . '</TD></TR>';
        }
    }

    return '<TABLE border=1><TR><TD>�����</TD><TD>������</TD><TD>���-�� �������</TD><TD>�������� �������</TD></TR>' . $top . '</TABLE>';
}

/**
 * ����� �������� � ������� ������ ������
 * @param int $id_good �� ������
 * @return string
 */
function ratingshort($id_good) {
    global $SysValue,$link_db;

    $sql = 'select AVG(rate) as avg,COUNT(DISTINCT id_user) as count from ' . $SysValue['base']['table_name52'] . ' where ((id_good=' . $id_good . ') AND (enabled="1"))';
    $result = mysqli_query($link_db,$sql);
    @$row = mysqli_fetch_array(@$result);
    @$SysValue['sql']['num']++;
    $vote = round($row['avg'], 2);
    $amount = round($row['count'], 1);
    $voteshow = $vote / 2;
    $voteshow = round($voteshow, 3);
    $result2 = ShowStars2($vote, "0") . '(' . $voteshow . ')<BR>����� ����������:' . $amount;

    return $result2;
}

?>