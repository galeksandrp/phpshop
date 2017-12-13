<?

class PHPShopExampleElement extends PHPShopElements {

    // �����������
    function PHPShopExampleElement() {
        parent::PHPShopElements();
    }

    // ���������� ������ Example
    function addToTopMenu() {

        // �������� ����
        $this->set('topMenuName','Example');

        // ������
        $this->set('topMenuLink','index');

        // ��������� ������ � ������� 'page' �� 'example'
        $dis=$this->PHPShopModules->Parser(array('page'=>'example'),$this->getValue('templates.top_menu'));
        return $dis;
    }

    // ���������� ���������� ����� Example
    function addToRightMenu() {

        // �������� ����
        $this->set('leftMenuName','Example');

        // ������
        $this->set('leftMenuContent','<p>��������� ���� Example ������������ ������� Example � ����� example.inc.php</p>');

        // ��������� ������
        $dis=$this->parseTemplate($this->getValue('templates.right_menu'));
        return $dis;
    }
}




// �������� ��������� �������� ��������������� ����
$PHPShopTextElement = new PHPShopTextElement();
$PHPShopTextElement->init('topMenu'); // ����� �������� ����
$PHPShopTextElement->init('rightMenu'); // ����� �������� ����
//
// ��������� ������ Example � �������� �������������� ����
$PHPShopExampleElement = new PHPShopExampleElement();
$GLOBALS['SysValue']['other']['topMenu'].=$PHPShopExampleElement->addToTopMenu();

// ��������� ������ Example � ����� ��������� ����
$PHPShopExampleElement = new PHPShopExampleElement();
$GLOBALS['SysValue']['other']['rightMenu'].=$PHPShopExampleElement->addToRightMenu();
?>