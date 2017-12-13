<?php
/**
 * ������������ ���������
 * @package PHPShopInc
 */

// �������� �� ������ /index.php/index.php
if (strstr($_SERVER['REQUEST_URI'], 'index.php')) {
    header('Location: /error/');
    exit();
}

// ������ ������� �� ���������
$PHPShopCoreElement = new PHPShopCoreElement();
$PHPShopCoreElement->init('skin');
$PHPShopCoreElement->init('checkskin');
$PHPShopCoreElement->init('setdefault');

// ����� �������
$PHPShopSkinElement = new PHPShopSkinElement();
$PHPShopSkinElement->init('skinSelect');

// ����� ������� �������
$PHPShopCoreElement->init('pageCss');

// �������� �������
PHPShopObj::loadClass('modules');
$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();


// ���������� ����� autoload
foreach($SysValue['autoload'] as $val)
    if (is_file($val)) include_once($val);

// ���������� ����� �������
//$PHPShopSortElement = new PHPShopSortElement();
//$PHPShopSortElement->brand('brand',14,'������');

// ����������� �������������
$PHPShopUserElement = new PHPShopUserElement();
$PHPShopUserElement->init('usersDisp');
    
// ������� � �����
$PHPShopProductIndexElements = new PHPShopProductIndexElements();
$PHPShopProductIndexElements->init('specMain');

// ������� � �������
$PHPShopProductIconElements = new PHPShopProductIconElements();
$PHPShopProductIconElements->init('specMainIcon');

// ��������� �������
$PHPShopProductIndexElements->init('nowBuy');

// ���� ���������
$PHPShopShopCatalogElement = new PHPShopShopCatalogElement();
$PHPShopShopCatalogElement->init('leftCatal');
$PHPShopShopCatalogElement->init('leftCatalTable');

// ���� ��������� �������
$PHPShopPageCatalogElement = new PHPShopPageCatalogElement();
$PHPShopPageCatalogElement->init('pageCatal');

// �����
$PHPShopOprosElement = new PHPShopOprosElement();
$PHPShopOprosElement->init('oprosDisp');

// ����-�������
$PHPShopNewsElement = new PHPShopNewsElement();
$PHPShopNewsElement->init('miniNews');

// ������
$PHPShopBannerElement = new PHPShopBannerElement();
$PHPShopBannerElement->init('banersDisp');

// ������ �����
$PHPShopCloudElement = new PHPShopCloudElement();
$PHPShopCloudElement->init('cloud');

// ��������� ����
$PHPShopTextElement = new PHPShopTextElement();
$PHPShopTextElement->init('leftMenu',true); // ����� ������ �����
$PHPShopTextElement->init('rightMenu',true); // ����� ������� �����
$PHPShopTextElement->init('topMenu',true); // ����� �������� ����

// ����� ������
$PHPShopCurrencyElement = new PHPShopCurrencyElement();
$PHPShopCurrencyElement->init('valutaDisp');

// �������
$PHPShopCartElement = new PHPShopCartElement();
$PHPShopCartElement->init('miniCart');

// RSS ������ ��������
$PHPShopRssParser = new PHPShopRssParser();


?>