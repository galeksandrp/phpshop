<?php

/**
 * ���������� �������� ���� �����������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @param string $Status ����� ������������
 */
class PHPShopAdminRule {

    protected $UserStatus;

    /**
     * �����������
     */
    function __construct() {

        // �������� �����������
        $this->UserStatus = $this->ChekBase();

        $this->fixRules = array(
            'banner' => 'baner',
            'order' => 'visitor',
            'payment' => 'order',
            'catalog' => 'cat_prod',
            'slider' => 'baner',
            'report' => 'stats1',
            'menu' => 'page_menu',
            'page' => 'page_menu',
            'rss' => 'rsschanels',
            'modules' => 'module',
            'system' => 'visitor',
            'exchange' => 'cat_prod',
            'sort' => 'catalog',
            'catpage' => 'page',
            'photo' => 'page',
            'intro' => 'report',
            'upload' => 'update',
            'currency' => 'valuta',
            'tpleditor' => 'system'
        );
    }

    /**
     * �������� �����������
     * @return mixed
     */
    function ChekBase() {

        // �������� ������
        $session_id = session_id();
        if (!$session_id)
            session_start();

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['users']);
        $data = $PHPShopOrm->select(array('*'), array('enabled' => "='1'", 'id' => "='" . intval($_SESSION['idPHPSHOP']) . "'"), false, array('limit' => 1));

        if (is_array($data)) {
            $hasher = new PasswordHash(8, false);
            if ($_SESSION['logPHPSHOP'] == $data['login']) {
                if ($hasher->CheckPassword($_SESSION['pasPHPSHOP'], $data['password'])) {
                    return unserialize($data['status']);
                }
            }
        }

        if (!empty($_SERVER['QUERY_STRING']))
            $_SESSION['return'] = $_SERVER['QUERY_STRING'];

        header("Location: /phpshop/admpanel/");
        exit("No access");
    }

    /**
     * �������� ����
     * @param string $path ������ ����������������� [news|gbook]
     * @param string $do �������� [view|edit|remove]
     * @return boolean 
     */
    function CheckedRules($path, $do = 'view') {

        $rules_array = array(
            'view' => 0,
            'edit' => 1,
            'create' => 2,
            'remove' => 3,
            'rule' => 4
        );


        if (empty($this->UserStatus[$path]) and !empty($this->fixRules[$path]))
            $path = $this->fixRules[$path];

        $array = explode("-", $this->UserStatus[$path]);

        if (!empty($array[$rules_array[$do]]))
            return true;
    }

    /**
     * �������� �� ���������� �����
     */
    function BadUserFormaWindow() {
        echo'
          <div class="alert alert-danger" id="rules-message" role="alert"><span class="glyphicon glyphicon-exclamation-sign"></span> <strong>��������!</strong> ������������ ���� ��� ����������. <a href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-arrow-left"></span> ���������</a> ��� �������� <a href="?path=users&id=' . $_SESSION['idPHPSHOP'] . '&tab=1" class="btn btn-xs btn-primary">����� <span class="glyphicon glyphicon-arrow-right"></span></a> ��������������.</div>
';
        return true;
    }

    /**
     * �������������� ������ ��� CRM ������
     * @param string $disp
     * @return string
     */
    static function decodeCrm($disp) {
        $decode = substr($disp, 0, strlen($disp) - 4);
        $decode = str_replace("I", 11, $decode);
        $decode = explode("O", $decode);
        $disp_pass = null;
        for ($i = 0; $i < (count($decode) - 1); $i++)
            $disp_pass.=chr($decode[$i]);
        return $disp_pass;
    }

    /**
     * ����������� ������ ��� CRM ������
     * @param string $pas
     * @return string
     */
    static function encodeCrm($pas) {
        $encode = null;
        for ($i = 0; $i < (strlen($pas)); $i++)
            $encode.=ord($pas[$i]) . "O";

        $encode = str_replace(11, "I", $encode);
        return $encode . "I10O";
    }

}

?>
