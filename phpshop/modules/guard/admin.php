<?php
$_classPath="../../";
include($_classPath."class/obj.class.php");
include("class/guard.class.php");
include("class/pclzip.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("modules");



$PHPShopBase=&new PHPShopBase($_classPath."inc/config.ini");
$PHPShopSystem=&new PHPShopSystem();

$PHPShopModules = new PHPShopModules('../');


$Guard = &new Guard("../../../");
$Guard->backup_path='../../../UserFiles/Files/';
$Guard->license_path='../../../license/';

switch($_GET['do']) {

    case "quarantine":
        if($Guard->admin($_GET['backup'])) {
            $Guard->backup_path='../../../UserFiles/Files/';
            $Guard->file($Guard->dir_global);
            $Guard->chek();

            if(count($Guard->changes)>0) {

                $quarantine_name=str_replace('../../../','/', $Guard->zip($Guard->changes,$fname='!!!quarantine!!!'));
                $zag='Guard ['.$_SERVER['SERVER_NAME'].'] - ����� ��� �������';
                $content='������� �������!
---------------

��������-������ "'.$PHPShopSystem->getName().'" �������� ����� ��� �������:

* �������� - '.$_SERVER['SERVER_NAME'].'
* ���������� ������ - '.count($Guard->changes).'
* ������ ��� �������� ������ �� ���������: http://'.$_SERVER['SERVER_NAME'].$quarantine_name;

                PHPShopObj::loadClass("mail");
                $PHPShopMail=&new PHPShopMail('guard@phpshop.ru',$PHPShopSystem->getParam('adminmail2'),$zag,$content);
                $Guard->message('����� �������� ������ ��������� PHPShop Guard.');
            }

        }
        else exit('������ ����������!');

        break;

    case "create":

        if($Guard->admin($_GET['backup'])) $create_enabled=true;
        else if(include_once($_classPath.'/admpanel/enter_to_admin.php')) $create_enabled=true;

        if($create_enabled) {
            $Guard->log('start');
            $Guard->file($Guard->dir_global);
            $Guard->create();
            $Guard->changes=$Guard->base;
            $Guard->log('end_admin');
            $Guard->message('�������� ���� ���������. � ���� '.$Guard->crc_num.' ������.');
        }
        else exit('������ ����������!');
        break;

    case "update":
        include_once($_classPath.'/admpanel/enter_to_admin.php');

        $Guard->update();

        switch($Guard->update_result) {

            case 0:
                $message='������ ����������� ��������� ����������,
���������� ��� �������� ������� ����������.
��������� ������ ����������� ���������.';
                break;

            case 1:
                $message='���������� �������� ������� ���������.';
                break;

            case 2:
                $message='������ ����������� � ������� PHPShop.ru';
                break;
        }

        $Guard->message('<pre>'.$message.'</pre>');

        break;

    case "chek":

        include_once($_classPath.'/admpanel/enter_to_admin.php');

        // ����� ���
        $Guard->log('start');

        // ��������� �����
        $Guard->file($Guard->dir_global);

        // ����������
        $Guard->chek();

        // ���������
        $Guard->signature();


        // ����� ���
        $Guard->log('end_admin');


        // ��������� ��������������

        $Guard->mail($Guard->backup());

        $message='<pre>
* ���������� ������ - '.count($Guard->changes).'
* ����� ������ - '.count($Guard->new).'
* ���������� ������ - '.count($Guard->infected).'

������ ����� � ���������� �� ���������� ���������
���������� �� ������ '.$PHPShopSystem->getParam('adminmail2').'
    </pre>';
        $Guard->message($message);

        break;

}

//header('Location: /error/');
//exit();
?>
