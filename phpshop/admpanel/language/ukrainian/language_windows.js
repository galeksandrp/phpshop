
// ������ ����� ������ 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
lang.title = function(txt){// ����� ���������
             document.title = txt;
             }
lang.txt = function(txt){// ����� ������
            var obj = document.getElementsByName("txtLang");
			if(obj[num_txt]){
            obj[num_txt].innerHTML = txt;
            num_txt++;
			}}
lang.btn = function(txt){// ����� ������
            var obj = document.getElementsByName("btnLang");
			if(obj[num_btn]){
            obj[num_btn].value = txt;
            num_btn++;
            }}
lang.img = function(txt){// ����� ����� ��������
            var obj = document.getElementsByName("imgLang");
			if(obj[num_img]){
            obj[num_img].alt = txt;
            num_img++;
            }}
lang.clean = function(){// ������� ����������
            num_txt=0;
            num_btn=0;
            num_img=0;
            }

message1="Attention! \nGiven operation can lead to loss items.\nyou really wish to execute the given command?";

message2="Attention! \nGiven operation can lead to loss bazy.\nyou really wish to execute the given command?"

// ����� �����
function DoCheckLang(file,enabled){

if(enabled == 1){

try{
  switch(file){

     case("/phpshop/admpanel/order/adm_visitorID.php"):
	 document.title="Editing of the order";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "����������";
	 txtLang[1].innerHTML = "���� ����������";
	 txtLang[2].innerHTML = "�������";
	 txtLang[3].innerHTML = "�����";
	 txtLang[4].innerHTML = "���� ����������";
	 txtLang[5].innerHTML = "��������� ���������� �� ����������";
	 txtLang[6].innerHTML = "��������"; 
	 
	 txtLang[7].innerHTML = "������ ��������"; 
	 txtLang[8].innerHTML = "����� �������� ��"; 
	 txtLang[9].innerHTML = "��"; 
	 
	 txtLang[10].innerHTML = "�������"; 
	 txtLang[11].innerHTML = "������"; 
	 txtLang[12].innerHTML = "�������"; 
	 txtLang[13].innerHTML = "���������"; 
	 txtLang[14].innerHTML = "����������"; 
	 txtLang[15].innerHTML = "����� ����������";
	 txtLang[16].innerHTML = "�������";
	 txtLang[17].innerHTML = "������������";
	 txtLang[18].innerHTML = "ʳ������";
	 txtLang[19].innerHTML = "����";
	 txtLang[20].innerHTML = "������ � ����������� ������";
	 txtLang[21].innerHTML = "��.";
	 txtLang[22].innerHTML = "������ �� ����������";
	 txtLang[23].innerHTML = "ID ������";
	 document.getElementById("btnAdd").value = "������";
	 txtLang[24].innerHTML = "������";
	 document.getElementById("btnChange").value = "������";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "��������";
	 document.getElementById("btnCancel").value = "³����";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_productID.php"):
	 document.title="����������� ����������";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "������������";
	 txtLang[1].innerHTML = "����������";
	 txtLang[2].innerHTML = "ʳ������";
	 txtLang[3].innerHTML = "ֳ�� �� ��.";
	 txtLang[4].innerHTML = "����";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "��������";
	 document.getElementById("btnCancel").value = "³����";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_deliveryID.php"):
	 document.title="����������� ��������";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "̳��� ��������";
	 txtLang[1].innerHTML = "����";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnCancel").value = "³����";
	 break;
     
	 case("/phpshop/admpanel/catalog/admin_cat_content.php"):
	 if(document.getElementById("txtLang")){
	 var txtLang = document.getElementsByName("txtLang");
	 var imgLang = document.getElementsByName("imgLang");
	 txtLang[0].innerHTML = "������";
	 txtLang[1].innerHTML = "������������";
	 txtLang[2].innerHTML = "ֳ��";
	 imgLang[0].alt="���������";
	 imgLang[1].alt="ͳ";
	 imgLang[2].alt="���������� ����������";
	 imgLang[3].alt="YML �����";
     imgLang[4].alt="�������";
	 }
	 break;

     case("/phpshop/admpanel/catalog/adm_catalogID.php"):
	 lang.title("����������� ��������");
       lang.txt("����������� ��������");
	 lang.txt("������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("��������� ����");
	 lang.txt("��������������");
	 lang.txt("�������");
	 lang.txt("���������");
	// lang.txt("������");
	 
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("����������");
	 lang.txt("������ � �������");
	 lang.txt("������ �� �������");
	 lang.txt("���������� ������");
	 lang.txt("������������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("����� ��� Rambler-�������");
	 lang.txt("��� ��������� ���� \"�������� ������� ����������\" ��� ��������������� ����� � ������ �������� �������� Pokupki.rambler.ru");
     lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.txt("��������������� ������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;

     case("/phpshop/admpanel/catalog/adm_catalog_new.php"):
	 lang.title("����� �������");
     lang.txt("����� �������");
	 lang.txt("������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("��������� ����");
	  lang.txt("��������������");
	 lang.txt("���������");
	 lang.txt("������");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("����������");
	 lang.txt("������ � �������");
	 lang.txt("������ �� �������");
	 lang.txt("���������� ������");
	 lang.txt("������������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("����� ��� Rambler-�������");
	 lang.txt("��� ��������� ���� \"�������� ������� ����������\" ��� ��������������� ����� � ������ �������� �������� Pokupki.rambler.ru");
     lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.txt("��������������� ������");
	 lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_product_new.php"):
	 lang.title("��������� ������ ������");
	 lang.txt("��������� ������ ������");
	 lang.txt("������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����������");
     lang.txt("�������� ����");
	 lang.txt("��������� ����");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("��������������");
	 lang.txt("ϳ�����");
	 lang.txt("�������");
	 lang.txt("ֳ��");
	 lang.txt("�����������");
	 lang.txt("�������");
	 lang.txt("��������");
	 lang.txt("�����������");
	 lang.txt("YML �����");
	 lang.txt("�����������");
	 lang.txt("������������ ������");
	 lang.txt("������������ ������ ��� �������� �������");
	 lang.txt("������ �������������� (ID) ������ ����� ����");
	 //lang.txt("Scheme");
	 lang.txt("�����");
	 lang.txt("����");
	 lang.txt("������ ���������� �� ������: ");
	 lang.txt("");
	 lang.txt("���������");
	 lang.txt("�������");
	 lang.txt("��������");
	 lang.txt("������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("����������� �����������");
	 lang.txt("̳� ������");
	 lang.txt("����� ������������");
	 lang.txt("ϳ����� ������");
	 lang.txt("������ �������������� (ID) ������ ����� ���� ��� ������");
	 lang.txt("��'����");
	 lang.txt("��������� �����");
	 lang.txt("��������� ����� ��� ��������� ������");

	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("³����"); 
	 break;

	 break;
	 
	 case("/phpshop/admpanel/product/adm_productID.php"):
	 lang.title("����������� ������");
	 lang.txt("����������� ������");
	 lang.txt("������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����������");
     lang.txt("�������� ����");
	 lang.txt("��������� ����");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("��������������");
	 lang.txt("ϳ�����");
	 lang.txt("�������");
	 lang.txt("ֳ��");
	 lang.txt("�����������");
	 lang.txt("�������");
	 lang.txt("��������");
	 lang.txt("�����������");
	 lang.txt("YML �����");
	 lang.txt("�����������");
	 lang.txt("������������ ������");
	 lang.txt("������������� ������ ��� �������� �������");
	 lang.txt("������ �������������� (ID) ������ ����� ����");
	 lang.txt("����� ��������");
	 lang.txt("�����");
	 lang.txt("����");
	 lang.txt("������ ���������� �� ������: ");
	 lang.txt("");
	 lang.txt("���������");
	 lang.txt("�������");
	 lang.txt("��������");
	 lang.txt("������");
	 lang.txt("����������� �����������");
	 lang.txt("����� ������������");
	 lang.txt("̳� ������");
	 lang.txt("����������� �����������");
	 lang.txt("����� ������������");
	 lang.txt("̳� ������");
	 lang.txt("����������� �����������");
	 lang.txt("����� ������������");
	 lang.txt("̳� ������");
	 lang.txt("��������������");
	 lang.txt("ϳ����� ������");
	 lang.txt("������ �������������� (ID) ������ ����� ����");
	 lang.txt("��'����");
	 
	 lang.txt("��������� �����");
	 lang.txt("��������� ����� ��� ��������� ������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("����");
	 lang.btn("�������");
	 lang.btn("³����"); 
	 break;
	 
	 case("/phpshop/admpanel/product/adm_price.php"):
	 lang.title("ֳ��");
	 lang.txt("ֳ��");
	 lang.txt("OK");
	 lang.txt("³����");
	 lang.txt("����� ����");
	 lang.txt("ֳ�� 2");
	 lang.txt("ֳ�� 3");
	 lang.txt("ֳ�� 4");
	 lang.txt("ֳ�� 5");
	 lang.txt("ϳ� ����������");
	 lang.btn("�����������");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_spec.php"):
	 lang.title("���������� ����");
	 lang.txt("���� � �������");
	 lang.txt("OK");
	 lang.txt("³����");
	 lang.txt("������� ��������");
	 lang.txt("���������� ����������");
	 lang.txt("�� �������");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_yml.php"):
	 lang.title("YML");
	 lang.txt("�������� � YML");
	 lang.txt("� ��������");
	 lang.txt("ϳ� ����������");
	 lang.txt("BID");
	 lang.txt("CBID");
	 lang.btn("OK");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_calc_sort.php"):
	 lang.title("����������� �������������");
	 lang.txt("����������� �������������");
	 lang.txt("������� ������ ��������������");
	 lang.txt("��������� ����� ��� ������������ ���� ����� Excel");
	 lang.btn("����������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messages_content.php"):
	 lang.txt("����");
	 lang.txt("�����������");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messages_new.php"):
     lang.title("��������� ����������� ����������");
	 lang.txt("��������� ����������� ����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("���������");
	 lang.txt("����");
	 lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messagesID.php"):
     lang.title("����������� �����������");
	 lang.txt("����������� �����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("���������");
	 lang.txt("����");
	 lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 
	 case("/phpshop/admpanel/delivery/admin_delivery_content.php"):
	 
	 lang.txt("�����/̳���");
	 lang.txt("�������");
	 lang.txt("����������� �����");
	 lang.txt("������ �� 1 kg");
	 lang.txt("���� �������");
	 lang.clean();
	 break;
	 
	 
	 case("/phpshop/admpanel/page/admin_cat_content.php"):
	 lang.txt("��������");
	 lang.txt("���������");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.clean();
	 break;

	 case("/phpshop/admpanel/page/adm_catalogID.php"):
     lang.title("����������� ��������");
	 lang.txt("����������� ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("������� ������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_catalog_new.php"):
     lang.title("��������� ������ ��������");
	 lang.txt("��������� ������ ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("������� ������");
	 lang.btn("��������");
	 lang.btn("³����");
	 lang.clean();
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pagesID.php"):
     lang.title("����������� �������");
	 lang.txt("����������� �������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("���������");
	 lang.txt("�������");
	
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("����������");
	 lang.txt("������������ ������ ��� �������� �������");
	 lang.txt("������ �������������� (ID) ������ ����� ���� ��� ������");
	 lang.txt("���������");
	 lang.txt("���������");
	 lang.txt("���������");
	 lang.txt("��������");
	 lang.txt("���� ��� ������������� ������������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pages_new.php"):
     lang.title("��������� ���� �������");
	 lang.txt("��������� ���� �������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("���������");
	 lang.txt("�������");
	
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("����������");
	 lang.txt("������������ ������ ��� �������� �������");
	 lang.txt("������ �������������� (ID) ������ ����� ���� ��� ������");
	 lang.txt("���������");
	 lang.txt("���������");
	 lang.txt("���������");
	 lang.txt("��������");
	 lang.txt("���� ��� ������������� ������������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_newsID.php"):
     lang.title("����������� �����");
	 lang.txt("����������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("����");
	 lang.txt("���������");
	 lang.txt("�����");
	 lang.txt("�������� ������������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_news_new.php"):
     lang.title("����������� �����");
	 lang.txt("����������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("����");
	 lang.txt("���������");
	 lang.txt("�����");
	 lang.txt("�������� ������������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_banerID.php"):
     lang.title("����������� ������");
	 lang.txt("����������� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("���������� �����");
	 lang.txt("��������� �����");
	 lang.txt("˳�� ������");
	 lang.txt("�������� ���������");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/. ����� ��������� ������� ����� ����� ����. ");
     lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_baner_new.php"):
     lang.title("��������� ������ ������");
	 lang.txt("��������� ������ ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("���������� �����");
	 lang.txt("��������� �����");
	 lang.txt("˳�� ������");
	 lang.txt("�������� ���������");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/.����� ��������� ������� ����� ����� ����. ");
     lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menuID.php"):
     lang.title("����������� ���������� �����");
	 lang.txt("����������� ���������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("���������");
	 lang.txt("����");
	 lang.txt("������");
	 lang.txt("���������� ����");
	 lang.txt("��������� ����");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/.����� ��������� ������� ����� ����� ����. ");
     lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menu_new.php"):
     lang.title("��������� ���������� �����");
	 lang.txt("��������� ���������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�������");
	 lang.txt("���������");
	 lang.txt("����");
	 lang.txt("������");
	 lang.txt("���������� ����");
	 lang.txt("��������� ����");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/.����� ��������� ������� ����� ����� ����. ");
     lang.txt("����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_links_new.php"):
     lang.title("��������� ������ ���������");
	 lang.txt("��������� ������ ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("���������� ���������");
	 lang.txt("��������� ���������");
	 lang.txt("������� ���������");
	 lang.txt("������� ������ �� ����������� ��������� ��������");
	 lang.txt("����");
	 lang.txt("��� ������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_linksID.php"):
     lang.title("����������� ���������");
	 lang.txt("����������� ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("���������");
	 lang.txt("���������� ���������");
	 lang.txt("��������� ���������");
	 lang.txt("������� ���������");
	 lang.txt("������� ������ �� ����������� ��������� ��������");
	 lang.txt("����");
	 lang.txt("������");
	 lang.txt("��� ������");
	 lang.btn("��");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_oprosID.php"):
     lang.title("����������� ���������");
	 lang.txt("����������� ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("���������");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/. ����� ��������� ������� ����� ����� ����. ");
	 lang.txt("�����");
	 lang.txt("����������");
	 lang.txt("���������");
	 lang.txt("������� ��������");
	 lang.txt("������");
	 lang.txt("������������");
	 lang.txt("�������� ���");
	 lang.txt("���� �������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_opros_new.php"):
     lang.title("��������� ������ ����������");
	 lang.txt("��������� ������ ����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("���������");
	 lang.txt("����'���� �� �������");
	 lang.txt("�������: page/, news/. ����� ��������� ������� ����� ����� ����. ");
	 lang.txt("�����");
	 lang.txt("����������");
	 lang.txt("���������");
	 lang.txt("������� ��������");
	 lang.txt("������");
	 lang.txt("������������");
	 lang.txt("�������� ���");
	 lang.txt("���� �������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_valueID.php"):
     lang.title("����������� ���������");
	 lang.txt("����������� ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("��������");
	 lang.txt("�������");
	 lang.txt("������");
	 lang.txt("����������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_value_new.php"):
     lang.title("��������� ���������");
	 lang.txt("��������� ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("��������");
	 lang.txt("�������");
	 lang.txt("������");
	 lang.txt("����������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbookID.php"):
     lang.title("����������� ������");
	 lang.txt("����������� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("����");
	 lang.txt("³��������");
	 lang.txt("��'�");
	 lang.txt("����");
	 lang.txt("³����");
	 lang.txt("��������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbook_new.php"):
     lang.title("��������� ������ ������");
	 lang.txt("��������� ������ ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("����");
	 lang.txt("³��������");
	 lang.txt("��'�");
	 lang.txt("����");
	 lang.txt("³����");
	 lang.txt("��������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_userID.php"):
     lang.title("����������� ������������");
	 lang.txt("����������� ������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("�����");
	 lang.txt("��'�");
	 lang.txt("������");
	 lang.txt("������� ��������");
	 lang.txt("������� ����������");
	 lang.txt("���� �������");
	 lang.txt("ϳ��� ���� ������ �������������� ������� ��� ����� � ������ ������");
	 lang.txt("������");
	 lang.txt("�����");
	 lang.txt("������");
	 lang.txt("³�����");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("���������");
	 lang.txt("�� ����������");
	 lang.txt("������������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("�����");
	 lang.txt("�����������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("�������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("���������");
	 lang.txt("�� �������");
	 lang.txt("����");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("ϳ��������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("�������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������� �����");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("���������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������ � �������"); 
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������ � BD");
	 lang.txt("����������");
	 lang.txt("��������� ��������� ��ﳺ�");
	 lang.txt("������������ ��");
	 lang.txt("����������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("��������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������");
	 lang.txt("����� ��������");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("����������"); 
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_users_new.php"):
     lang.title("��������� ������ �����������");
	 lang.txt("��������� ������ �����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("����");
	 lang.txt("��'�");
	 lang.txt("������");
	 lang.txt("������� ��������");
	 lang.txt("������� ����������");
	 lang.txt("������ ������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_userID.php"):
     lang.title("����������� �����������");
	 lang.txt("����������� �����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("������");
	 lang.txt("������������� ����������");
	 lang.txt("������� ��������");
	 lang.txt("������� ����������");
	 lang.txt("������ ������");
	 lang.txt("���� ����������");
	 lang.txt("������� ���");
	 lang.txt("��������� �����");
	 lang.txt("�������");
	 lang.txt("���");
	 lang.txt("���");
	 lang.txt("�������");
	 lang.txt("������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_users_new.php"):
     lang.title("��������� ������ �����������");
	 lang.txt("��������� ������ �����������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("������");
	 lang.txt("������������� ����������");
	 lang.txt("������� ��������");
	 lang.txt("������� ����������");
	 lang.txt("������ ������");
	 lang.txt("������� ���");
	 lang.txt("��������� �����");
	 lang.txt("�������");
	 lang.txt("���");
	 lang.txt("���");
	 lang.txt("�������");
	 lang.txt("������");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_statusID.php"):
     lang.title("����������� �������");
	 lang.txt("����������� �������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�����������");
	 lang.txt("������� ������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_status_new.php"):
     lang.title("��������� �������");
	 lang.txt("��������� �������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�����������");
	 lang.txt("������� ������");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnalID.php"):
     lang.title("��������� IP � ������ ������");
	 lang.txt("��������� IP � ������ ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("IP-������ ���� ������ �� ������� ������. ���������� � ����� ������� �� ���� ������ �����������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnal_listlID.php"):
     lang.title("����������� IP � ������� ������");
	 lang.txt("����������� IP � ������� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("IP-������ ���� ������ �� ������� ������. ���������� � ����� ������� �� ���� ������ �����������");
       lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_preID.php"):
     lang.title("����������� ����");
	 lang.txt("����������� ����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("������ ������� ����� ����� ����");
	 lang.txt("ID ������");
	 lang.txt("������ �������������� (ID) ����� ����� ����");
	 lang.txt("�����������");
	 lang.txt("���������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_pre_new.php"):
     lang.title("��������� ������ ����");
	 lang.txt("��������� ������ ����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("������ ������� ����� ����� ����");
	 lang.txt("ID ������");
	 lang.txt("������ �������������� (ID) ����� ����� ����");
	 lang.txt("�����������r");
	 lang.txt("���������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortID.php"):
     lang.title("����������� ��������������");
	 lang.txt("����������� ��������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("��������� ����");
	 lang.txt("������������");
	 lang.txt("ϳ�������� 3-�� ����");
	 lang.txt("Գ�����");
	 lang.txt("�������");
	 lang.txt("��������������");
	 lang.txt("����������");
	 lang.txt("���� �������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sort_new.php"):
     lang.title("��������� ��������������");
	 lang.txt("��������� ��������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("��������� ����");
	 lang.txt("������������");
	 lang.txt("ϳ�������� 3-�� ����");
	 lang.txt("Գ�����");
	 lang.txt("�������");
	 lang.txt("��������������");
	 lang.txt("����������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategoryID.php"):
     lang.title("����������� ����� �������������");
	 lang.txt("����������� ����� �������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("��������� ����");
	 lang.txt("�������");
	 lang.txt("��������������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategory_new.php"):
     lang.title("��������� ����� �������������");
	 lang.txt("��������� ����� �������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("��������� ����");
	 lang.txt("�������");
	 lang.txt("��������������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
 
	 case("/phpshop/admpanel/system/adm_system.php"):
     lang.title("������� ������������");
	 lang.txt("������������ ��� ��������-��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("������� ������");
	 lang.txt("³�����");
	 lang.txt("ֳ��");
	 lang.txt("�����������");
	 lang.txt("������");
	 lang.txt("������");
	 lang.txt("����");
	 lang.txt("�����������");
	 lang.txt("����������");
	 lang.txt("�������");
	 lang.txt("ʳ������ ������� �� �������");
	 lang.txt("ʳ������ ������� � ��������������");
	 lang.txt("ʳ������ ������� � ��������");
	 lang.txt("������ � ������� ��� ������");
	 lang.txt("����� ������� ���� �������� ��");
	 lang.txt("���� ���������� �� �������� � ���");
	 lang.txt("������ �� ������������");
	 lang.txt("������ � �������");
	 lang.txt("������ ��� ����������� �������");
	 lang.txt("�������� ����");
	 lang.txt("����������� ���");
	 lang.txt("���");
	 lang.txt("���������� ���� �� �����");
	 lang.txt("ʳ�-�� ����� ���� ���� � ���");
	 lang.txt("̳������� ���� ����������");
	 lang.txt("���������� ����������� ��� ����������");
	 lang.txt("���� ��������� �� ����������� ������ �������������");
	 lang.txt("��� ��������� �����������");
	 lang.txt("SMS ����������� ��� ����������");
	 lang.txt("SMS ����������� ��� �������� ������ ������������");
	 lang.txt("����� ��� �������������");
	 lang.txt("����������� �������� ��������");
	 lang.txt("������� ���'���");
	 lang.txt("��������� �����");
	 lang.txt("������� � ���� ��� ����������");
	
	 lang.txt("³�������� ��������");
	 lang.txt("��������� �������� ������ �� �������� ������");
	 lang.txt("����� Multibase");
	 lang.txt("������������� � ������ Multibase �������� ������");
	 lang.txt("������������� ������");
	 lang.txt("��������� ����� e-mail");
	 lang.txt("������ ���� ���������");
	 lang.txt("������������� ����������");
	 lang.txt("���� �������");
	 lang.txt("����������� ������ ��������� (��������)");
	 lang.txt("����. ������ ��������");
	 lang.txt("����. ������ ��������");
	 lang.txt("����� ��������");
	 lang.txt("����. ������ ���������");
	 lang.txt("����. ������ ���������");
	 lang.txt("����� ���������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_promo.php"):
     lang.title("����� ������������");
	 lang.txt("������������ ��� ��������� ���������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("������ ��������");
	 lang.txt("������ ����������");
	 lang.txt("������ ������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�����");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�����");
	 lang.btn("���������");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("�������");
	 lang.btn("ϳ��������");
	 lang.btn("�����");
	 lang.btn("���������");
	 lang.btn("����");
	 lang.btn("�����");
	 lang.btn("������ �����");
	 lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_recvizit.php"):
     lang.title("������������ �������� �����");
	 lang.txt("������������ �������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("����� ��������");
	 lang.txt("�������");
	 lang.txt("��������");
	 lang.txt("�-Mail ��� ��������� ����� ����");
	 lang.txt("����� ����������");
	 lang.txt("�������� ������");
	 lang.txt("Գ����� ������");
	 lang.txt("���");
	 lang.txt("���");
	 lang.txt("� ������� ����������");
	 lang.txt("����� �����");
	 lang.txt("���");
	 lang.txt("� ����������� �������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discountID.php"):
     lang.title("����������� ������");
	 lang.txt("����������� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("����");
	 lang.txt("���� ����������� � ");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discount_new.php"):
     lang.title("��������� ���� ������");
	 lang.txt("��������� ���� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("����");
	 lang.txt("���� ����������� � ");
	 lang.txt("������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
       lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valutaID.php"):
     lang.title("����������� ������");
	 lang.txt("����������� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("����������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("��� ISO");
	 lang.txt("����");
	 lang.txt("�������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valuta_new.php"):
     lang.title("��������� ���� ������");
	 lang.txt("��������� ���� ������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("����������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("��� ISO");
	 lang.txt("����");
	 lang.txt("�������");
     lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_deliveryID.php"):
     lang.title("����������� ��������");
	 lang.txt("����������� ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("�� ������������");
	 lang.txt("ֳ��");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("����������� ��������");
	 lang.txt("³� ���� �����");
	 lang.txt("������������� �������� �� ���� 0,5 �� ���� (��� ����������� ������ �������� ����� 0)");
	 lang.txt("���� �������� 0,5 �� ������ ������� 0,5 �� �������������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_delivery_new.php"):
     lang.title("��������� ���� ��������");
	 lang.txt("��������� ���� ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("�� ������������");
	 lang.txt("ֳ��");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
	 lang.txt("����������� ��������");
	 lang.txt("³� ���� �����");
	 lang.txt("������������� �������� �� ���� 0,5 �� ���� (��� ����������� ������ �������� ����� 0)");
	 lang.txt("���� �������� 0,5 �� ������ ������� 0,5 �� �������������");
     lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_catalog_new.php"):
     lang.title("��������� ���� ������� ��������");
	 lang.txt("��������� ���� ������� ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("�� ������������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
     lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_catalogID.php"):
     lang.title("����������� �������� ��������");
	 lang.txt("����������� �������� ��������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("�����");
	 lang.txt("�� ������������");
	 lang.txt("�����������");
	 lang.txt("���");
	 lang.txt("ͳ");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_servers_new.php"):
     lang.title("��������� ������ �����");
	 lang.txt("��������� ������ �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("����");
	 lang.txt("��������");
	 lang.txt("����������");
     lang.btn("�������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_serversID.php"):
     lang.title("����������� �����");
	 lang.txt("����������� �����");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�����");
	 lang.txt("����");
	 lang.txt("��������");
	 lang.txt("����������");
     lang.btn("��������");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_docsstyle.php"):
     lang.title("������������");
	 lang.txt("������������");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�������");
	 lang.txt("��������� ����");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/window/adm_window.php"):
     lang.title("ĳ�");
	 lang.txt("ĳ�");
	 lang.txt("�������� ��� ��� ������ � ����");
	 lang.txt("�� �������, �� ������");
	 try{
	 lang.txt("");
	 lang.txt("");
	 }catch(e){}
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/dumper/dumper.php"):
     lang.title("������ � �����");
	 lang.txt("������ � �����");
	 lang.txt("������ ������� ��� ��");
	 lang.txt("�������� �������� ���� ��");
	 lang.txt("��");
	 lang.txt("Գ���� �������");
	 lang.txt("����� �����������");
	 lang.txt("������� �����������");
	 lang.txt("³��������� �� � �������� ��ﳿ");
	 lang.txt("��");
	 lang.txt("����");
	 lang.btn("³����");
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql.php"):
     lang.title("������ � �����");
	 lang.txt("������ � �����");
	 lang.txt("������ ������� ���  MySQL");
	 try{
	 lang.txt("������� ������� sql");
	 lang.txt("����������� ����");
	 lang.txt("³������������ ����");
	 lang.txt("�������� �������");
	 lang.txt("�������� �������");
	 lang.txt("�������� ����");
	 lang.txt("������� ����");
	 lang.btn("����������� � �����");
	 lang.btn("�������");
	 lang.btn("³����");

	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "�����";
	 btnLang2[1].value = "³����";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql_file.php"):
     lang.title("������ � �����");
	 lang.txt("������ � �����");
	 lang.txt("������ ������� ���  MySQL");
	 try{
	 lang.txt("������������ SQL");
	 lang.txt("������� ���� � �����������");
	 lang.btn("�������� SQL �������");
	 lang.btn("�������");
	 lang.btn("³����");
	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "�����";
	 btnLang2[1].value = "³����";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/window/adm_about.php"):
	 lang.title("��� ��������");
	 lang.txt("��� ��������");
	 lang.txt("���� ������ �� �������� �����");
	 lang.txt("������");
	 lang.txt("�����");
	 lang.txt("ϳ�������");
	 lang.txt("����");
	 lang.txt("���������");
	 lang.txt("����������� ������� ��������");
	 lang.txt("ϳ�������");
	 lang.txt("� ������� ����� �������� �����");
	 lang.btn("�������");
	 
	 break;
   }
     }catch(e){alert("The translation engine has informed about shortages of an element.\nTransfer can be not full!");}
}}
 