<p>
    �� ����� ������ �� ������ ������������ ��������� ����������� ��� ��������������� ������������� � ����������� ���������.
</p>
<h2>����������� ������</h2>
<textarea class="phpshop-gui" style="width:99%;height: 50px">
<a href="http://@serverName@@ShopDir@/?partner=@partnerId@" title="@name@">@name@</a>
</textarea>


<h2>����������� ������� ������� ����� JavaScript</h2>
<textarea style="width:99%;height: 100px" class="phpshop-gui"><script src="http://@serverName@@ShopDir@phpshop/modules/partner/lib/js/phpshop-partner-lib.js" id="phpshop-lib-xml"></script>
<script>
var PHPShopXmlManager1 = new PHPShopXmlManager();
PHPShopXmlManager1.url = 'http://@serverName@@ShopDir@';
PHPShopXmlManager1.id= 'shopItem';
PHPShopXmlManager1.obj = 1;
PHPShopXmlManager1.imgwidth = 100;
PHPShopXmlManager1.currency = ' ���.';
PHPShopXmlManager1.partner = @partnerId@;
PHPShopXmlManager1.limit = 5;
PHPShopXmlManager1.load();
</script></textarea>
<p>����������� ��������� JS ������� ������� � <a href="http://wiki.phpshop.ru/index.php/Partner_Module">Wiki ����������</a>.</p>

<h2>��������� PHPShop.CMS Free</h2>
��������� ������������������� ���������� ������� ���������� ������ � ������� Catalog ��� ���������� ������� � ��������� �� ����������� ���������.
<p>����������� ��������� PHPShop.CMS Free ������� � <a href="http://wiki.phpshop.ru/index.php/Partner_Module">Wiki ����������</a>.</p>


<h2>��������� PHPShop.CMS Micro</h2>
��������� ���������� �����-������� ���������� ������ � ������� Catalog ��� ���������� ������� �� ����������� ���������.
�� ������� ���� ������, �������� �� ������. ������������ ��������� �� ���������� ���������.
<p>����������� ��������� PHPShop.CMS Micro ������� � <a href="http://wiki.phpshop.ru/index.php/Partner_Module">Wiki ����������</a>.</p>

<h2>��������� HTML �������� Shop4Partner</h2>
Windows ������� ��� ��������� html �������� ������� ��� ���������� �������� ������ �� ���� ����. Shop4Partner ��������
�������� � ����������� ������� � ������ SEO ������.
<p>����������� ��������� PHPShop.CMS Micro ������� � <a href="http://wiki.phpshop.ru/index.php/Partner_Module">Wiki ����������</a>.</p>
<p><input type="button" value="������� Shop4Partner" onclick="javascript:window.open('@ShopDir@phpshop/modules/partner/files/setup.exe')"></p>