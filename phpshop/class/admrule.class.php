<?php

/**
 * ���������� �������� ���� �����������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @param string $Status ����� ������������
 */
class PHPShopAdminRule {

    var $UserStatus;

    /**
     * �����������
     */
    function PHPShopAdminRule($Status) {
        global $UserStatus;

        if (empty($Status))
            $this->UserStatus = $UserStatus;
        else
            $this->UserStatus = $Status;
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
            'remove' => 4,
            'all'=>3,
            'rule'=>5
            );

        $array = explode("-", $this->UserStatus[$path]);

        if (!empty($array[$rules_array[$do]]))
            return true;
    }

    /**
     * �������� �� ���������� �����
     */
    function BadUserFormaWindow() {
        echo'
	  <script>
	  if(confirm("�������� ' . $_SESSION['logPHPSHOP'] . '!\n� ��� ������������ ���� ��� ���������� ������ ��������.\n������� ��� ����?"))
	  window.close();
          else history.back(1);
	  </script>';
    }

}

?>
