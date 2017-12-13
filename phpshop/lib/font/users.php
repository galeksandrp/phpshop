<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("mail");
PHPShopObj::loadClass("parser");

switch ($_GET['do']) {

    case 'delete':
        $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_users');
        $PHPShopOrm->debug = $_GET['debug'];
        $PHPShopOrm->delete(array('enabled' => "='0'", 'checkmail' => "='1'", 'check_date' => '<' . (time() - 2592000)));
        echo '��������� �������: '.mysql_affected_rows();
        break;

    case 'deactivation':
        $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_users');
        $PHPShopOrm->debug = $_GET['debug'];
        $PHPShopOrm->update(array('enabled_new' => '0'), array('activation' => "!=''", 'checkmail' => "='1'", 'check_date' => '<' . (time() - (2592000 / 6))));
        echo '��������� �������: '.mysql_affected_rows();
        break;

    // �������������� ��������� �� ���� ����� � �����
    case 'autoupdate':

        $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_log');
        $PHPShopOrm->debug = $_GET['debug'];
        $data_users_log = $PHPShopOrm->select(array('distinct user_name'));
        echo '��������� �������: '.mysql_affected_rows();
        foreach ($data_users_log as $row_users_log) {
            $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_users');
            $PHPShopOrm->debug = $_GET['debug'];
            $PHPShopOrm->update(array('activation_new' => ''), array('login' => '="' . $row_users_log['user_name'] . '"'));
            
        }
        break;

    // �������� ��������� �������������
    case 'activation':

        $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_users');
        $PHPShopOrm->debug = $_GET['debug'];
        if(empty($_GET['limit']))
            $_GET['limit']=50;
        $num = 0;
        $mail = null;
        $data_users_users = $PHPShopOrm->select(array('*'), array('activation' => "!=''", 'enabled' => "!='0'", 'checkmail' => "='0'"), array('order' => 'id'), array('limit' => 10000));
        if (is_array($data_users_users))
            foreach ($data_users_users as $row) {
                $content = unserialize($row['content']);
                if (!empty($content['IP'])) {

                    if ($num > $_GET['limit'])
                        exit('��������� ��������� ' . $num . ' �������������: ' . $mail);

                    $zag = "��������� ������������ PHPShop Software";
                    $content = '
<p>
���������(��)  <b>' . $row['login'] . '</b>, �� ������� ������� �� ����� <a href="http://www.phpshop.ru/user/">PHPShop.ru</a> � �� ���� �� �������������� � ���.
� ��� ���� ����������, ��� ���� ����������� �������� ����-�����.
</p>
<p>
���� �� � ���������� ������ ������������ ���������, �� �������� ��������� �������������.
��� ��������� ������������ ' . $row['login'] . ' ��������� �� ������: <a href="http://www.phpshop.ru/user/?activation=' . $row['activation'] . '">http://www.phpshop.ru/user/?activation=' . $row['activation'] . '</a>
</p>
<p>
��� ������� � ������ <a href="http://www.phpshop.ru/user/">������� ��������</a> ����� ��������� ����������� ������:<br><br>
�����: <b>' . $row['login'] . '</b><br>
������: <b>' . base64_decode($row['password']) . '</b><br>
</p>
<p>
<b>���� ��������� �� ���������� � ������� 5 ����, �� ��� ������� ����� ������������ � � ���������� ������</b>.
</p>
';
                    PHPShopParser::set('content', $content);
                    $userContent = PHPShopParser::file($_classPath."lib/mails/activation.htm", true, false);
                    $PHPShopMail = new PHPShopMail($row['mail'], 'robot@phpshop.ru', $zag, $userContent);
                    $num++;
                    $mail.=$row['mail'] . ', ';

                    $PHPShopOrm = new PHPShopOrm('phpshop_modules_users_users');
                    $PHPShopOrm->debug = $_GET['debug'];
                    $PHPShopOrm->update(array('checkmail_new' => '1', 'check_date_new' => time()), array('id' => '=' . $row['id']));
                }
            }
        echo '��������� ��������� ' . $num . ' �������������: ' . $mail;
        
    case 'help':
echo '
        <h4>�������� �������������</h4>
        <ul>
        <li><a href="?do=autoupdate">�������� ��������� �����������</a> [<a href="?do=autoupdate&debug=true">debug</a>]
        <li><a href="?do=activation">�������� ���������</a> [<a href="?do=activation&limit=100">100</a>] [<a href="?do=activation&debug=true">debug</a>]
        <li><a href="?do=deactivation">����������� ������������� ��� ��������� ����� 5 ����</a> [<a href="?do=deactivation&debug=true">debug</a>]
        <li><a href="?do=delete">�������� ������������� ��� ��������� ����� 30 ����</a> [<a href="?do=delete&debug=true">debug</a>]
        </ul>';
        break;

    default: echo 'Use param ?do [help|autoupdate|activation|deactivation|delete]';

}
?>
