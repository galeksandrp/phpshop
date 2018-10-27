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
$PHPShopCoreElement->init('skin', false, false);
$PHPShopCoreElement->init('checkskin');
$PHPShopCoreElement->init('setdefault');

// ����� �������
$PHPShopSkinElement = new PHPShopSkinElement();
$PHPShopSkinElement->init('skinSelect');

// ����� ������� �������
$PHPShopCoreElement->init('pageCss', false, false);

// �������� �������
PHPShopObj::loadClass('modules');
$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();

// ���������� ����� autoload
foreach ($GLOBALS['SysValue']['autoload'] as $val)
    if (is_file($val))
        include_once($val);

// ����� ������
$PHPShopCurrencyElement = new PHPShopCurrencyElement();
$PHPShopCurrencyElement->init('valutaDisp');

// ����������� �������������
$PHPShopUserElement = new PHPShopUserElement();
$PHPShopUserElement->init('usersDisp');
$PHPShopUserElement->init('wishlist');

// ������� � �����
$PHPShopProductIndexElements = new PHPShopProductIndexElements();
$PHPShopProductIndexElements->init('specMain');

// ��������� �������
$PHPShopProductIndexElements->init('nowBuy');

// ���� ���������
$PHPShopShopCatalogElement = new PHPShopShopCatalogElement();
$PHPShopShopCatalogElement->init('leftCatal');
$PHPShopShopCatalogElement->init('leftCatalTable');

// ������� � �������
$PHPShopProductIconElements = new PHPShopProductIconElements();
$PHPShopProductIconElements->init('specMainIcon');

// ���� ��������� �������
$PHPShopPageCatalogElement = new PHPShopPageCatalogElement();
$PHPShopPageCatalogElement->init('pageCatal');

// �����
$PHPShopOprosElement = new PHPShopOprosElement();
$PHPShopOprosElement->init('oprosDisp');

// ����-�������
$PHPShopNewsElement = new PHPShopNewsElement();
$PHPShopNewsElement->init('miniNews');

// �������
$PHPShopSliderElement = new PHPShopSliderElement();
$PHPShopSliderElement->init('imageSlider');

// ������
$PHPShopBannerElement = new PHPShopBannerElement();
$PHPShopBannerElement->init('banersDisp');

// ���������
$PHPShopAnalitica = new PHPShopAnalitica();

// ������ �����
$PHPShopCloudElement = new PHPShopCloudElement();
$PHPShopCloudElement->init('cloud');

// ��������� ����
$PHPShopTextElement = new PHPShopTextElement();
$PHPShopTextElement->init('leftMenu', true);
$PHPShopTextElement->init('rightMenu', true);
$PHPShopTextElement->init('topMenu', true);

// �������
$PHPShopCartElement = new PHPShopCartElement();
$PHPShopCartElement->init('miniCart');

// �����������
$PHPShopPhotoElement = new PHPShopPhotoElement();
$PHPShopPhotoElement->init('getPhotos');

// Recaptcha
$PHPShopRecaptchaElement = new PHPShopRecaptchaElement();
$PHPShopRecaptchaElement->init('captcha');

// RSS ������ ��������
new PHPShopRssParser();
?>