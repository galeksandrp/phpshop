<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
    <head>
        <title>�����</title>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <style>
            td {
                font-size: 12px;
                color: #696969;
            }
            a{
                color: #35A0C4;
                padding-left: 0px;
            }

            .post{
                color: f04a35;
                font-weight: bolder;
            }
        </style>
    </head>

    <body>

        <?
        if(!@include("conf_global.php")) exit('conf_global.php �� ���������');
        mysql_connect ($INFO['sql_host'], $INFO['sql_user'], $INFO['sql_pass']) or die("���������� �������������� � ����");
        mysql_select_db($INFO['sql_database']) or die("���������� �������������� � ����");
        mysql_query("SET NAMES 'cp1251'");
        function dataV($nowtime) {
            $Months = array("01"=>"������","02"=>"�������","03"=>"�����",
                    "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
                    "08"=>"�������","09"=>"��������",  "10"=>"�������",
                    "11"=>"������","12"=>"�������");
            $curDateM = date("m",$nowtime);
            $t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime)." ".date("H:s ",$nowtime);
            return $t;
        }

        function Total($id) {
            $sql="select pid from ibf_posts where topic_id=$id";
            $result=mysql_query($sql);
            $num = mysql_numrows($result);
            return $num;
        }


        if(empty($_GET['n'])) $limit=7;
        else $limit=htmlspecialchars(stripslashes($_GET['n']));


        $sql="select * from ibf_forums order by last_post desc limit ".$limit;
        $result=mysql_query($sql);
        while($row = mysql_fetch_array($result)) {
            $name = $row['last_title'];
            $last_post = $row['last_post'];
            $last_poster_name = $row['last_poster_name'];
            $description = $row['description'];
            $posts = $row['posts'];
            $last_id=$row['last_id'];
            $id = $row['id'];
            @$disp.='
<TR><TD width="20" class="post">
<img src="/comment.gif" alt="" border="0"> '.$posts.'</TD>
<TD>'.dataV($last_post).'  |  <img src="/icon-client.gif" alt="" border="0"> <b>'.$last_poster_name.'</b><BR>
<DIV><A title="'.$name.'" href="/index.php?showtopic='.$last_id.'" target="_blank">'.$name.'</A>
</DIV></TD>
</TR>
';
        }



        echo "<table>$disp</table>";

        ?>
    </body>
</html>