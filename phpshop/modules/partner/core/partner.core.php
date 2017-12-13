<?php

class PHPShopPartner extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopPartner() {


        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['partner']['partner_users'];
        $this->debug=false;

        // ������ �������
        $this->action=array("nav"=>array("register","sendpassword"),
                'post'=>array("add_user","update_user","exit_user","enter_user","send_user","addmoney_user"),
                'get'=>'activation');

        $this->icon='phpshop/modules/partner/templates/message.gif';
        parent::PHPShopCore();
    }



    function addmoney_user() {

        if(PHPShopSecurity::true_num($_SESSION['partnerId']) and PHPShopSecurity::true_num($_POST['get_money_new'])) {

            // �������� ���������� ����� �� ����� ��������
            if($_SESSION['partnerTotal'] < $_POST['get_money_new']) {
                $notice=PHPShopText::notice($GLOBALS['SysValue']['lang']['partner_notice'],$this->icon);
            }
            else {
                $PHPShopOrm = &new PHPShopOrm($GLOBALS['SysValue']['base']['partner']['partner_payment']);
                $PHPShopOrm->debug=false;
                $PHPShopOrm->insert(array('date_new'=>time(),'sum_new'=>$_POST['get_money_new'],'partner_id_new'=>$_SESSION['partnerId']));
                $notice=PHPShopText::message($GLOBALS['SysValue']['lang']['partner_money_done'],$this->icon);
                PHPShopObj::loadClass("mail");

                // ��������� �������������� � ������ �� �����
                $Mail = new PHPShopMail($this->PHPShopSystem->getValue('adminmail2'),$_SESSION['partnerMail'],
                        $this->PHPShopSystem->getValue('name').' - ������ �� ����� ������� �� '.$_SESSION['partnerName'],
                        $GLOBALS['SysValue']['lang']['partner_money_mail'].' '.$_POST['get_money_new'].' '.$this->PHPShopSystem->getDefaultValutaCode());
            }
            unset($_POST['get_money_new']);
            $this->index($notice);
        }
        else header("Location: ".$_SERVER['HTTP_REFERER']);
    }

    /**
     * ������ ������ �� ����� ������
     * @param array $order
     * @return float
     */
    function getSum($order,$percent,$enabled) {
        $sum=0;
        $order=unserialize($order);
        if(is_array($order['Cart']['cart']))
            foreach($order['Cart']['cart'] as $val) $sum+=$val['num']*$val['price'];
        $format=$this->PHPShopSystem->getSerilizeParam("admoption.price_znak");

        if(empty($enabled)) $sum=0;
        else $sum=$sum*$percent/100;

        return number_format($sum,$format,'.','');
    }

    /**
     * ����� �� ���������, ������ �������
     */
    function index($notice=false) {
        global $PHPShopModules;
        if(PHPShopSecurity::true_num($_SESSION['partnerId'])) {

            // ���������� �������
            PHPShopObj::loadClass("admgui");
            $PHPShopInterface = new PHPShopFrontInterface();
            $PHPShopInterface->css='phpshop/modules/partner/templates/phpshop-gui.css';
            $PHPShopInterface->js='phpshop/modules/partner/templates/phpshop-gui.js';
            $PHPShopInterface->imgPath='phpshop/admpanel/img/';

            /**
             * ������ �� �����
             */
            $PHPShopInterface->setCaption(array("&plusmn;","10%"),array("����","20%"),
                    array("����� (".$this->PHPShopSystem->getDefaultValutaCode().')',"30%"));
            $PHPShopOrm = &new PHPShopOrm($GLOBALS['SysValue']['base']['partner']['partner_payment']);
            $PHPShopOrm->debug=false;
            $data=$PHPShopOrm->select(array('*'),array('partner_id'=>"='".$_SESSION['partnerId']."'"),array('order'=>'id desc'),array('limit'=>300));
            if(is_array($data))
                foreach($data as $row) {
                    extract($row);
                    $sum=number_format($sum,"2",".","");

                    // ���� ����������
                    if(!empty($enabled)) $date=$date_done;

                    $PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),PHPShopDate::dataV($date),$sum);
                }
            $Tab1=$PHPShopInterface->Compile();
            $PHPShopInterface->imgPath='phpshop/modules/partner/templates/';
            $Tab2=$PHPShopInterface->setInputText('�����', 'get_money_new', round($_SESSION['partnerTotal']/2),50,$this->PHPShopSystem->getDefaultValutaCode());
            $Tab2.=$PHPShopInterface->setInput('submit','addmoney_user', '������ ������');
            $Tab2=$PHPShopInterface->setForm($Tab2);


            /**
             * ������ ���������
             */
            $PHPShopTableOrders = new PHPShopFrontInterface();
            $PHPShopTableOrders->imgPath='phpshop/admpanel/img/';
            $PHPShopTableOrders->setCaption(array("&plusmn;","10%"),array("����","15%"),array("� ������",'15%'),
                    array("����� (".$this->PHPShopSystem->getDefaultValutaCode().')',"20%"),array("%","10%"));

            $PHPShopOrm = &new PHPShopOrm($GLOBALS['SysValue']['base']['partner']['partner_log']);
            $PHPShopOrm->debug=false;
            $result = $PHPShopOrm->query('SELECT a.*, b.orders FROM '.$GLOBALS['SysValue']['base']['partner']['partner_log'].' AS a
            JOIN '.$GLOBALS['SysValue']['base']['orders'].' AS b ON a.order_id = b.uid where a.partner_id='.$_SESSION['partnerId'].' order by a.id desc limit 0,100');
            while ($row = mysql_fetch_array($result)) {
                $PHPShopTableOrders->setRow($row['id'],$PHPShopTableOrders->icon($row['enabled']),PHPShopDate::dataV($row['date']),$row['order_id'],
                        $this->getSum($row['orders'],$row['percent'],$row['enabled']),$row['percent']);
            }
            $Tab3=$PHPShopTableOrders->Compile();


            /**
             * ��������� ������������
             */
            $PHPShopOrm = &new PHPShopOrm($this->objBase);
            $row=$PHPShopOrm->select(array('*'),array('id'=>"='".$_SESSION['partnerId']."'",'enabled'=>"='1'"));
            if(is_array($row)) {

                // ������ ������������
                $this->set('userName',$row['login']);
                $this->set('userMail',$row['mail']);
                $this->set('userDate',$row['date']);
                
                if($row['money']>0) $this->set('userMoney',PHPShopText::a('javascript:tabPane.setSelectedIndex(3);',$row['money'].' '.
                        $this->PHPShopSystem->getDefaultValutaCode(),'������� ��������','green',$size=17));
                else $this->set('userMoney',PHPShopText::b('0 ').$this->PHPShopSystem->getDefaultValutaCode());

                $_SESSION['partnerTotal']=$row['money'];
                $_SESSION['partnerMail']=$row['mail'];
                $this->set('partnerId',$_SESSION['partnerId']);

                // �������������� ����
                $content=unserialize($row['content']);
                $dop=null;

                if(is_array($content))
                    foreach($content as $k=>$v) {
                        $this->set('userAddName',str_replace('dop_', '', $k));
                        $this->set('userAddValue',$v);
                        $dop.=ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_dop_content'],true);
                    }

                // ���������� ����������
                $this->set('userContent',$dop);
                $Tab4=ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_enter'],true);
            }


            /**
             * ��������� ���������
             */

            $Tab5=ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_docs'],true);

            // ����� �������� ���������
            $PHPShopFrontGUI = new PHPShopFrontInterface();
            $TabName=explode("|", $GLOBALS['SysValue']['lang']['partner_menu']);


            $Forma=$PHPShopFrontGUI->getContent($PHPShopFrontGUI->setTab(array($TabName[0],$Tab4,550),array($TabName[1],$Tab3,550),
                    array($TabName[2],$Tab1,550),array($TabName[3],$Tab2,550),array($TabName[4],$Tab5,600)));

            // ���������� ������
            $this->set('pageContent',$notice.$Forma);
            $this->set('pageTitle',$GLOBALS['SysValue']['lang']['partner_path_name']);

            // ����
            $this->title=$GLOBALS['SysValue']['lang']['partner_path_name']." - ".$this->PHPShopSystem->getValue("name");

            // ���������� ������
            $this->parseTemplate($this->getValue('templates.page_page_list'));
        }

        else $this->enter();
    }


    /**
     * ����� ����� �����������
     */
    function enter($activation=false) {

        if(!empty($activation)) $this->set('activationNotice',PHPShopText::notice($GLOBALS['SysValue']['lang']['partner_activation_notice']));

        // ���������� ����������
        $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma'],true));
        $this->set('pageTitle','����������� ��������');

        // ����
        $this->title="������� �������� - ����������� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� �������� ���������
     */
    function activation() {
        $activation=PHPShopSecurity::TotalClean($_GET['activation'],4);
        $PHPShopOrm = &new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug=$this->debug;
        $row=$PHPShopOrm->select(array('id,login'),array('activation'=>"='".$activation."'"),false,array('limit'=>1));
        if(!empty($row['login'])) {

            // ��������� ������������
            $PHPShopOrm = &new PHPShopOrm($this->objBase);
            $PHPShopOrm->debug=$this->debug;
            $PHPShopOrm->update(array('enabled_new'=>'1','activation_new'=>'done'),array('id'=>'='.$row['id']));

            $_SESSION['partnerName']=$row['login'];
            $_SESSION['partnerId']=$row['id'];
        }

        // ������� � ������ �������
        $this->index();
    }


    /**
     * ����� �����
     */
    function enter_user() {

        if(PHPShopSecurity::true_login($_POST['plogin']) and PHPShopSecurity::true_passw($_POST['ppassword'])) {

            $PHPShopOrm = &new PHPShopOrm($this->objBase);
            $PHPShopOrm->debug=$this->debug;
            $row=$PHPShopOrm->select(array('id,login'),array('enabled'=>"='1'",'login'=>"='".$_POST['plogin']."'",
                    'password'=>"='".base64_encode($_POST['ppassword'])."'"),false,array('limit'=>1));

            if(!empty($row['id'])) {
                $_SESSION['partnerName']=$row['login'];
                $_SESSION['partnerId']=$row['id'];
            }

            $this->index();
        }
    }


    /**
     * ����� ������
     */
    function exit_user() {
        $_SESSION['partnerName']=null;
        $_SESSION['partnerId']=null;
        $this->index();
    }


    /**
     * ���� �� ������������ � ����
     * @param string $login ��� ������������
     * @return bool
     */
    function chek($login) {
        $PHPShopOrm = &new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug=$this->debug;
        $num=$PHPShopOrm->select(array('id'),array('login'=>"='$login'"),false,array('limit'=>1));
        if(empty($num['id'])) return true;
    }

    /**
     *  ����� ������ ������
     */
    function sendpassword() {

        // ���������� ����������
        $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_lost'],true));
        $this->set('pageTitle','����������� ������');

        // ����
        $this->title="������� �������� - ����������� ������ - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }


    /**
     * ����� �������� ������
     */
    function send_user() {

        $mail=PHPShopSecurity::TotalClean($_POST['mail'],3);
        $login=PHPShopSecurity::TotalClean($_POST['login'],2);

        // ������� ������
        $PHPShopOrm = &new PHPShopOrm($this->objBase);
        $PHPShopOrm->Option['where']=' OR ';
        $row=$PHPShopOrm->select(array('*'),array('login'=>"='".$login."'",'mail'=>"='".$mail."'"),false,array('limit'=>1));

        if(!empty($row['login'])) {

            PHPShopObj::loadClass("mail");
            $zag="����������� ������ � ". $this->PHPShopSystem->getValue("name");
            $content='������� �������, '.$row['login'].'
----------------

��� ������� � ����� http://'.$_SERVER['SERVER_NAME'].'/partner/ ����������� ������:
�����: '.$row['login'].'
������: '.base64_decode($row['password']).'

---
';

            // ��������� ������������
            $PHPShopMail = new PHPShopMail($row['mail'],$this->PHPShopSystem->getValue("admin_mail"),$zag,$content);
        }
    }


    /**
     *  ����� ����� �����������
     */
    function register() {

        // ���������� ����������
        $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_register'],true));
        $this->set('pageTitle','����������� ��������');

        // ����
        $this->title="������� �������� - ����������� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }


    /**
     * ����� ����� ������ ������������
     */
    function update_user() {

        $mail=PHPShopSecurity::TotalClean($_POST['mail'],3);
        $password=PHPShopSecurity::TotalClean($_POST['password'],2);

        if(PHPShopSecurity::true_param($mail)) {

            $PHPShopOrm = &new PHPShopOrm($this->objBase);
            $PHPShopOrm->debug=$this->debug;

            // �������������� ���� dop_
            foreach($_POST as $v=>$k)
                if(strstr($v, 'dop')) $dop[$v]=$k;


            $update_var=array(
                    'mail_new'=>$mail,
                    'content_new'=>serialize($dop)
            );

            if(!empty($password)) $update_var['password_new']=base64_encode($password);

            $PHPShopOrm->debug=false;
            $PHPShopOrm->update($update_var,array('id'=>'='.$_SESSION['partnerId']));

            $notice=PHPShopText::message($GLOBALS['SysValue']['lang']['partner_update'],$this->icon);
        }
        else $notice=PHPShopText::message($GLOBALS['SysValue']['lang']['partner_error'],$this->icon);

        $this->index($notice);
    }


    /**
     * ����� ������ ������������
     */
    function add_user() {
        $mes=null;
        $dop=array();

        $mail=PHPShopSecurity::TotalClean($_POST['mail'],3);
        $password=PHPShopSecurity::TotalClean($_POST['ppassword'],2);
        $login=PHPShopSecurity::TotalClean($_POST['plogin'],2);

        if(PHPShopSecurity::true_param($mail,$password,$login)) {

            // �������� �� ������������ �����
            if($this->chek($login)) {
                $PHPShopOrm = &new PHPShopOrm($this->objBase);
                $PHPShopOrm->debug=$this->debug;

                // �������� ���
                $check_text=md5(rand(0, 1000));

                // �������������� ���� dop_
                foreach($_POST as $v=>$k)
                    if(strstr($v, 'dop')) $dop[$v]=$k;


                $PHPShopOrm->insert(array('date'=>date("d-m-y"),'mail'=>$mail,'login'=>$login,'password'=>base64_encode($password),'activation'=>$check_text,'content'=>serialize($dop)),$prefix='');

                // ��������� � ����������
                PHPShopObj::loadClass("mail");
                $zag="����������� � ". $this->PHPShopSystem->getValue("name");
                $content='������� �������
----------------

��� ��������� �������� '.$login.' ��������� �� ������: http://'.$_SERVER['SERVER_NAME'].'/partner/?activation='.$check_text.'

��� ������� � ����� http://'.$_SERVER['SERVER_NAME'].'/partner/ ����� ��������� ����������� ������:
�����: '.$login.'
������: '.$password.'

---
';

                // ��������� ������������
                $PHPShopMail = new PHPShopMail($mail,$this->PHPShopSystem->getValue("admin_mail"),$zag,$content);

                // ������� � ������ �������
                $this->enter(true);

            }
            else $mes = '������� � ����� ������ ��� ���������������';

        }
        else $mes = '������ ���������� ����� �����������';

        // ��� �������
        if(!empty($mes)) {

            $this->set('mesageText',$mes);


            // ����
            $this->title="������� �������� - ����������� - ".$this->PHPShopSystem->getValue("name");

            // ���������� ����������
            $this->set('pageContent',ParseTemplateReturn($GLOBALS['SysValue']['templates']['partner']['partner_forma_register'],true));
            $this->set('pageTitle','����������� ��������');

            // ���������� ������
            $this->parseTemplate($this->getValue('templates.page_page_list'));
        }
    }
}

?>