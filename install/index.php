<?
error_reporting(0);
$_classPath="../phpshop/";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
$version=substr($GLOBALS['SysValue']['upload']['version'],1,1);



// ����
if(eregi('Apache', $_SERVER['SERVER_SOFTWARE'])) $API="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else $API="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// ������ PHP
$phpversion=substr(phpversion(),0,1);
if($phpversion >= 4) $php="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else $php="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// ������ MySQL
@mysql_connect ($SysValue['connect']['host'], $SysValue['connect']['user_db'],  $SysValue['connect']['pass_db']);
@mysql_select_db($SysValue['connect']['dbase']);
@mysql_query("SET NAMES 'cp1251'");

if(@mysql_get_server_info()) {
    $mysqlversion=substr(@mysql_get_server_info(),0,1);
    if($mysqlversion >= 4) $mysql="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
    else $mysql="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";
}else $mysql="...............?";

// Rewrite
$path_parts = pathinfo($_SERVER['PHP_SELF']);
$filename =  "http://".$_SERVER['SERVER_NAME'].$path_parts['dirname']."/rewritemodtest/test.html";
if (@fopen($filename,"r")) $rewrite="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else $rewrite="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//GD Support
$GD=gd_info();
if($GD['GD Version']!="")
    $gd_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else  $gd_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//FreeType Support
if($GD['FreeType Support'] === true)
    $gd_freetype_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else  $gd_freetype_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

//FreeType Linkage
if($GD['FreeType Linkage'] == "with freetype")
    $gd_freetype_linkage="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else  $gd_freetype_linkage="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

// XML Support
if(function_exists("xml_parser_create"))
    $xml_support="............<img src=\"rewritemodtest/icon-activate.gif\" border=0 align=absmiddle> <b class='ok'>Ok</b>";
else  $xml_support="............<img src=\"rewritemodtest/errormessage.gif\"  border=0 align=absmiddle> <b class='error'>Error</b>";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <title>��������� <?= $SysValue['license']['product_name']." (������ ". $SysValue['upload']['version'].")"?></title>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <style>
            body, pre, html, td
            {
                font-family: Tahoma;
                height:100%;
                margin:10px;
                padding:0px;
                font-size: 12px;
                background-color: #FFFFFF;
            }

            a{
                color: #013784;
            }

            a:hover{
                text-decoration: none;
            }


            .title{
                background-image: url(rewritemodtest/logo.jpg);
                background-repeat: no-repeat;
                font-size: 12px;
                color: #FFFFFF;
                height: 60px;
                background-color: #2162A4;
                display: block;
            }

            .footer{
                background-image: url(rewritemodtest/logo.jpg);
                background-repeat: no-repeat;
                font-size: 12px;
                color: #FFFFFF;
                background-color: #2162A4;
                padding: 10px;
            }

            .menu{
                background-color: #F89A29;
                color: white;
                padding:3px;
                clear:both;
            }

            .menu a{
                color: white;
            }

            .title h1{
                font-size: 20px;
                margin: 0px;
            }



            h2{
                background: #2162A4;
                color: ffffff;
                font-weight: bold;
                font-size: 120%;
                padding: 3px 20px;
                margin-bottom: 10px;
                border-bottom: 1px solid black;
                letter-spacing: 2px;
            }

            .v{
                font-size: 30px;
                font-weight: bold;
            }

            li{
                text-decoration: none;
                list-style: square;
            }
            pre p, p.pre{
                background: #F5F5F5;
                border-left-width: 1px;
                border-left-color: #000000;
                border-left-style: dashed;
                padding: 10px;
                font-size: 12px;
            }

            .info{
                border-width: 1px;
                background: #F5F5F5;
                border-color: #660033;
                border-style: dashed;
                padding: 10px;
            }
            .ok{
                color: green;
                font-weight: bold;
            }
            .error{
                color: red;
                font-weight: bold;
            }
        </style>
        <script>
            function miniWin(url,w,h)
            {
                window.open(url,"_blank","left=300,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
            }
        </script>
    <body>
        <div class="title">
            <div style="float:left;padding: 10px;padding-left: 15px" >
                PHPShop&copy; Software -  PHPShop&copy; Enterprise
                <h1>��������� PHPShop Software</h1>
            </div><div style="float:right;padding: 10px; padding-right: 15px" >������&nbsp;&nbsp;&nbsp;<span class="v" >3.<?=$version;?></span></div>
        </div>

        <div align="right" class="menu">
            <a href="/" target="_blank" title="�����������">�����</a> | <a href="https://help.phpshop.ru/" target="_blank" title="����������� ���������">����������� ���������</a> | <a href="http://faq.phpshop.ru/" target="_blank" title="�������">������� ���������</a> | <a href="#" onclick="window.print();return false;" title="������">������ ��������</a>
        </div><div style="clear: both"></div>

        <table>
            <tr>
                <td><img src="rewritemodtest/box.gif" alt="PHPShop SoftWare Box" width="120" height="143" border="0" align="left" hspace="10"></td>
                <td>
                    <p><strong>���������� ����������� ���</strong>.<br>
	�� ���� �������� �� ������ ��� ����������� ����������, ������� ������� ��� ���������� � ��������� ��������-������� �� ����� �����.</p> 
	���� ��������� ���������� ��� ������ ��������� PHPShop Software �� ����������� �������.<br> ����� ���������� ����������� ������������ ��
        ������� <a href="http://phpshop.ru/docs/hosting.html/" target="_blank" title="��������">���������������� ���������</a> �� ������������ �
        ���������� ������������ PHPShop SoftWare.
                </td>
            </tr>
        </table>



        <h2>��������� ����������</h2>
        <p>
        <ol>
            <li> Apache <?=$API?>
            <li> MySQL <?=$mysql?>
            <li> PHP <?=$php?>
            <li>GD Support ��� PHP <?=$gd_support?>
            <li>FreeType Support ��� PHP <?=$gd_freetype_support?>
            <li>FreeType Linkage ��� PHP <?=$gd_freetype_linkage?>
            <li>XML Parser ��� PHP <?=$xml_support?>
                <p>
                    �����������: <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle> <b class='ok'>Ok</b> - ���� �������,
                    <img src="rewritemodtest/errormessage.gif"  border=0 align=absmiddle> <b class='error'>Error</b> - ���� �� ������� (�������� �������� ��� ������ �������, ���������� � ������������ ������� ��� ��������� � ��������������� �������)

                <p><img src="rewritemodtest/php.png" border=0 align=absmiddle> <a href="rewritemodtest/rewritemodtest.php" target="_blank">�������� ���������� � �������</a><br>
                    <img src="rewritemodtest/icon-activate.gif" border=0 align=absmiddle><a href="http://www.phpshop.ru/docs/hosting.html" target="_blank">������ ���������������� ��������� </a></p>

                </p>
                </p>
        </ol>


    </p>

    <h2>��������� ������� � ������ ������</h2>
    <ol>
        <p>���� �� �� ������ ��� �� �����-�� �������� �� ������ ��������������� <strong>������� ���������� ��� ���������</strong> <a href="http://wiki.phpshop.ru/index.php/PHPShop_EasyControl#PHPShop_Installer" target="_blank">Windows Installer</a> ��� <a href="http://install.phpshop.ru" target="_blank">Web Installer</a>, �� ����������� ���� ���������� ������� ��� ��������� ��������� � ������ ������ (��� ������� �������������).</p>
        <li>������������ � ������ ������� ����� FTP-������ (CuteFTP, Total Commander � ��.)
        <li>��������� ������������� ����� � <strong>��������/�������� ������</strong> (�������� � ���������� FTP �������)</a>
        <li>�������� ����� ���� MySQL �� ����� ������� ��� ������� ������ ������� � ��� ��������� ���� � ����-����������.
        <li>

            �������������� ���� ����� � ����� MySQL "<strong>config.ini</strong>", ������� � ����� "���_����/phpshop/inc/config.ini". �������� ������ � �������� " " �� ���� ������.

            <p class=pre>
                [connect]<br>
                host="localhost";             # ��� �����<br>
                user_db="user";         # ��� ������������<br>
                pass_db="mypas";            # ������ ����<br>
                dbase="mybase";           # ��� ����</p>

        </li>
        <li>
            �������������� ���������� PHP <img src="rewritemodtest/icon-setup.gif" border=0 align=absmiddle> <a href="javascript:miniWin('./install.php',600,570)">�������������</a> (���_�����/install/install.php) ��� ��������� ����.<br>
            ��������, ����������� ��������� ����������, � ��������� ������ �� ����� ������ ����� ��. <br><br>
        </li>
        <li>� ����� ������������ ������� ����� /install
        <li>���������� ����� CMOD 777 (UNIX �������) ��� �����:
            <br><br>
            <ol>
                <li>license
                <li>UserFiles/Image
                <li>UserFiles/File
                <li>phpshop/admpanel/csv
                <li>files/price
                <li>phpshop/admpanel/dumper/backup
                <li>payment/paymentlog.log
                <li>backup/backups
                <li>backup/cache
                <li>backup/temp
                <li>backup/upd_log.txt
                <li>backup/upd_log_backup.txt
            </ol>
            <br><br>
        <li>��� ����� � <b>���������������� ������</b> ������� ���������� ������ Ctrl + F12 ��� �� ������: ���_�����/phpshop/admpanel/<br>
            ������������ � ������ �������� ��� ��������� �������.<br>
            ��� ��������� ������������ � ������ �������� � ������ ������. �� �������, ��������������� ������ ���������� �� e-mail. ����� ����� ������ ��������� ���������� ��������.<br><br>

        <li>����������� ����������� <strong>���������� 2-� � ����� ����������� ��������-���������</strong> � ����� ����������� ������. ������ ����������� ��������� ��������� ������������ ������� � �������������,&nbsp;��������� ���� <A href="http://phpshop.ru/docs/license.html" target="_blanlk">��������</A>.<BR><BR>��� ������� ����� ���������� ��������� ��������� ����� ��������� �����:<BR><BR>

            <ol>
                <li>�������� ������ � ����� ����������, �������� /market/<br>
                    ��������, ������������� ������������������ ������ � ������� shop, news, gbook, spec, users -  <strong>���������.</strong>
                <li>���������� /market/phpshop/lib/ �������� � ������ /phpshop/lib/
                <li>� ����� ������������ /market/phpshop/inc/config.ini ��������� ��� ����������, ���� ���������� ������
                    <p class=pre>[dir]<br>
                        dir="/market";
                    </p>
                <li>� ����� java/java2.js ��������� ��� ����������, ���� ���������� ������
                    <p class=pre>var ROOT_PATH="/market";</p>


                <li>������ ����c������ � �������� ���������� �� ���������&nbsp;�� ����� /market/<br><br>
            </ol>
        <li>����� �������, ����� ���������� �������������� ���-�� ��������-��������� �� ����� ������. ������������ ���������� <a href="http://phpshop.ru/docs/license.html" target="_blank">����������� �����������</a> �� ���������� ������������� ��������� �� ������ �������� ��� ����������� ���������.<br><br>
            �������������� ����������� ��������� ���������� ��������� � ������ ����, ��� ����� ������ ����� <strong>�������</strong> � ��������� ������:
            <p>
            <ul>
                <li>phpshop_&nbsp;&nbsp; - 1 �������
                <li>phpshop2_ - 2
                <li>phpshop3_ - 3 � �.�.
            </ul></p>
            ��� �������� �������� � ����� config.ini
            <p class=pre>[base]<br>
                categories="<strong>phpshop_</strong>categories"; <br>
                orders="phpshop_orders";   <br>
                .....

            </p>
    </ol>
</p>

<h2>����������</h2>
<p>
    ���������� ����������� �� ����������:
    <br><br>
<ol >
    <li>�������� ����� ������� ���� ������ ����� ������� "��������� ���� ����": ���� -> ��������� ���� ���� (Backup)
    <li>������� ����� /old/ ��������� ���� ��� ����� �� �������� ���������� www
    <li>��������� � ��������� ���������� www ����� ����� �� ������ ����� ������ � <strong>�������� ������</strong>
    <li>�� ������� ����� config.ini ����� ��������� ����������� � ���� ������ (������ 5 �����) � ��������� � ����� ������ (/phpshop/inc/config.ini)
    <li>��������� <a href="javascript:miniWin('update/install.php',600,570)">�������� ��� ������</a> (���_����/install/update/install.php), �������� ������� ������, ���� �� ��� ���, �� ��������� ���� �� �����. ������� ����� /install/
    <li>�� ����� /old/ �������� ����� /UserFiles � /license �� ������� ���������� � ��������� � ����������� ������ � ���� �����
    <li>�� ������������� �������� ������ ������ /phpshop/templates/, �� � ������ ��� � ��� ����� ���� ������� ��������� ��� ����� ������ (�������� � ����������)
</ol>
</p>

<h2>������� ������ � �������</h2>
<p>
    ������� �������� ��� � ���-������� �� ���-������, ��� � � ���������� ������� <a href="http://wiki.phpshop.ru/index.php/PHPShop_EasyControl" target="_blank">EasyControl</a><br>
    <br>
    ������� ����������� �� ����������:
    <br><br>
<ol >
    <li>�������� ����� ������� ���� ������ �� ������ ������� ����� ������� ������ ���������� "��������� ���� ����": ���� -> ��������� ���� ���� (Backup)
    <li>��������� ����� ������������ ������� �� ����� ���-������ (www, htdocs, public_html) � ����������� ����� �� ����� ������� � <strong>�������� ������</strong>.<br><br>
        ��� ����������� �������� ������ � ������� �� ������ ����� ��������������� �������� <a href="http://phpshop.ru/loads/ThLHDegJUj/putty.exe" target="_blank">PyTTY</a> �  ���������� SSH. <br>
        �������� �������� ����� ����������� �� ������ ������� (www ���������� �� ��� ����� ����� �������� ���-������):
        <p class=pre>
            tar cvf file.tar www/<br>
            gzip file.tar<br>
            cp file.tar.gz www/
        </p>
        �������� �������� ����� ����������� �� ����� �������:
        <p class=pre>
            wget http://���_������/file.tar.gz<br>
            tar -zxf file.tar.gz<br>
            cp -rf file/ www/
        </p>

    <li>��������������� �� ������ ������� ����� install � �������� �� ������ � ��������� � ��� ������� �� ����� ������.
    <li>����������� � ���� ������������  /phpshop/inc/config.ini �� ����� ������� ����� ��������� ������� � ���� ������ MySQL.
        <p class=pre>
            [connect]<br>
            host="localhost";             # ��� �����<br>
            user_db="user";         # ��� ������������<br>
            pass_db="mypas";            # ������ ����<br>
            dbase="mybase";           # ��� ����</p>
    <li>��������� ����������� http://���_�����/install/install.php. ���������� ��������� ��� � ����, ��������� ������ ������� � ������ ���������� (���������, ����� ���������� ������ ����� ��������� ������� �������). ����� ����������� �������� ���� ��������.
    <li>������� ����� /install
    <li>������������ � ������ ���������� /phpshop/admpanel/, ��������� ����� ��������� ������ �������, ��������� � �������� ����.
    <li>��������������� ��������� ����� ���� ����� ������� "��������� ���� ����": ���� -> ��������� ���� ���� (Backup). ����������� �������.
    <li>������ ��� ����� � ������ ���������� ������� ������� ������ �� ������� �������.
</ol>
</p>

<h2>���� ������</h2>
<ol>
    <li><b>101 ������ ����������� � ����</b><br><br>
        <ul>
            <li>��������� ��������� ����������� � ���� ������: <b>host, user_db, pass_db, dbase</b>.
            <li>�������� ���� phpshop/inc/config.ini � �������������� ������������� ���������� ��� ���� ���� (�������� ������ ����� ���������).<br>
                <p class=pre>
                    [connect]<br>
                    host="localhost";             # ��� �����<br>
                    user_db="user";         # ��� ������������<br>
                    pass_db="mypas";            # ������ ����<br>
                    dbase="mybase";           # ��� ����</p>
        </ul>
    <li><b>102 �� ����������� ����</b><br><br>
        <ul><li>��������� <strong>����������</strong> (���_�����/install/install.php) ��� ��������� ��.
        </ul><br>
    <li><b>105 ������ ������������� ����� install.php</b><br><br>
        <ul>
            <li>� ����� ������������ ������� ����� <b>/install</b>
            <li>��� ���������� ���� �������� �������� �������� ����������  � ������������ ����� config.ini (�� �������������)
                <p class=pre>
                    check_install="false";
                </p>
        </ul>
</ol>

<div class="footer">Copyright � PHPShop Software. ��� ����� �������� � 2003-<? echo date("Y") ?>. ����� PHPShop �2006614274,2010611237.

</div>
</body>
</html>
