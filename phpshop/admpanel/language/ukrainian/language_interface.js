// ����
var	monthName =	new Array("ѳ����", "�����", "��������", "������", "�������", "�������", "������", "�������", "��������", "�������","��������", "�������")
var dayNameFull = new Array("�����","��������","³������","������","������","�'������","������")
var dayName = new Array("��","��","��","��h","��","��","��")


// ������ ����� ������ 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
d = document;
lang.title = function(txt){// ����� ���������
             document.title = txt;
             }
lang.txt = function(txt){// ����� ������
            var obj = d.getElementsByName("txtLang");
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
			obj[num_img].title = txt;
            num_img++;
            }}
lang.clean = function(){// ������� ����������
            num_txt=0;num_btn=0;num_img=0;
            }

icon = new Object();
num_icon = 0;
icon.img = function(txt){// ����� ����� ��������
            var obj = document.getElementsByName("iconLang");
			if(obj[num_icon]){
            obj[num_icon].alt = txt;
			obj[num_icon].title = txt;
            num_icon++;
            }}


// ����� �����
function DoCheckInterfaceLang(file,tip){
     if(tip == "top") d = window.opener.document; else d = document;
	 var txtLang = d.getElementsByName("txtLang");
	 var txtLangs = d.getElementsByName("txtLangs");
	 var txtLang2 = d.getElementsByName("txtLang2");
	 var btnLang = d.getElementsByName("btnLang");
	 var imgLang = d.getElementsByName("imgLang");
  try{
  switch(file){
  
     case("index"):
	 txtLang[0].innerHTML = "���� �� ������������� �����";
	 txtLang[1].innerHTML = "�������� ������������� � ������";
	 txtLang[2].innerHTML = "����������";
	 txtLang[3].innerHTML = "������";
	 btnLang[0].value = "�����";
	 txtLang[4].innerHTML = "³������ � ��������� ���";
	 try{
	 txtLangs[0].innerHTML = "���'����� ���� � ������";
	 txtLang[5].innerHTML = "³�������� ������ �� E-mail �����������";
	 }catch(e){
	 txtLang2[0].innerHTML = "�� ���'����� ���� � ������";
	 txtLang[5].innerHTML = "³�������� ������ �� E-mail �����������";
	 }
	 break;
  
     case("csv_base"):
	 try{
     txtLang[0].innerHTML = "������� ������������ ������� ���� Excel";
	 txtLang[1].innerHTML = "������� ���� � ����������� ";
	 btnLang[0].value = "�������";
	 txtLang[2].innerHTML = "���, ������ tags ������ �����/�����";
	 txtLang[3].innerHTML = "������������";
	 txtLang[4].innerHTML = "�������� ����";
	 txtLang[5].innerHTML = "���� ����������";
	 txtLang[6].innerHTML = "������ ����";
	 txtLang[7].innerHTML = "������ ����������";
	 txtLang[8].innerHTML = "ֳ��1";
	 txtLang[9].innerHTML = "ֳ��2";
	 txtLang[10].innerHTML = "ֳ��3";
	 txtLang[11].innerHTML = "ֳ��4";
	 txtLang[12].innerHTML = "ֳ��5";
	 txtLang[13].innerHTML = "�����";
	 txtLang[14].innerHTML = "�������";
	 txtLang[15].innerHTML = "�������";
	 txtLang[16].innerHTML = "��������������";
	 txtLang[17].innerHTML = "����";
	 
	 txtLang[18].innerHTML = "ճ� ��������";
	 txtLang[19].innerHTML = "���� 1 - ����������� ������� ����� (���. �����)";
	 txtLang[20].innerHTML = "���� 2 - ������� ���������� ���������� ����";
	 txtLang[21].innerHTML = "���� 3 - �������� ���� � ����";
	 txtLang[22].innerHTML = "���� 4 - ���������� ��������� ��������";
	 txtLang[23].innerHTML = "���� 5 - ������� � ������� - ���������� ������ - ���� Excel";
     txtLang[24].innerHTML = "���� 6 - ������� ��������� ������ � ������� ����� ��� ����������� ��������� ³����� - ��������� �� ��������. ��� ����������� - �������� ������� ��������. ";
	 txtLang[25].innerHTML = "�����";
	 txtLang[26].innerHTML = "������ ���������� ���������� ���, ��� �������� �� ������������ ������������";
     txtLang[27].innerHTML = "����������� ������� ����� ";
	
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "ID";
	 txtLangs[1].innerHTML = "������������";
	 txtLangs[2].innerHTML = "ֳ��1";
	 txtLangs[3].innerHTML = "ֳ��2";
	 txtLangs[4].innerHTML = "ֳ��3";
	 txtLangs[5].innerHTML = "ֳ��4";
	 txtLangs[6].innerHTML = "ֳ��5";
	 txtLangs[7].innerHTML = "�����";
	 txtLangs[8].innerHTML = "����";
	 txtLangs[9].innerHTML = "������� ����� ����";
	 txtLangs[10].innerHTML = "�������� ����";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "������������ ������� ���� ��������!";
	 txtLang2[1].innerHTML = "ճ� ��������";
	 txtLang2[2].innerHTML = "���� 1 - ������� � ����� ������� - ���������� ������ - ���� Excel";
     txtLang2[3].innerHTML = "���� 2 - ������� ��������� ������ � ������� ����� ��� ����������� ��������� ³����� - ��������� �� ��������";
	 btnLang[0].value = "�������";
	 }catch(e){}
	 
	 break;
	 
  
     case("csv"):
	 try{
     txtLang[0].innerHTML = "������� ������������ ������";
	 txtLang[1].innerHTML = "";
	 txtLang[2].innerHTML = "������� ����";
	 btnLang[0].value = "�������";
	 txtLang[3].innerHTML = "ճ� ��������";
	 txtLang[4].innerHTML = "���� 1 - ������� ���������� ������������ �����";
	 txtLang[5].innerHTML = "���� 2 - �������� ���� � �����";
	 txtLang[6].innerHTML = "���� 3 - ���������� ��������� ��������";
	 txtLang[7].innerHTML = "�����";
	 txtLang[8].innerHTML = "������ ���������� ���������� ���, ��� �������� �� ������������ ������������";
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "������������";
	 txtLangs[1].innerHTML = "ֳ��";
	 txtLangs[2].innerHTML = "���� ����";
	 txtLangs[3].innerHTML = "ϳ� ����������";
	 txtLangs[4].innerHTML = "�������";
	 txtLangs[5].innerHTML = "�����";
	 txtLangs[6].innerHTML = "����. ����������";
	 txtLangs[7].innerHTML = "YML ������";
	 txtLangs[8].innerHTML = "�� �����";
	 txtLangs[9].innerHTML = "��������";
	 txtLangs[10].innerHTML = "����������";
	 txtLangs[11].innerHTML = "������� ����� ����";
	 txtLangs[12].innerHTML = "�������� ����";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "������������ ������ ��������";
	 txtLang2[1].innerHTML = "������� ����";
	 btnLang[0].value = "�������";
	 }catch(e){}
	 
	 break;
	 
	
	 case("shopusers_messages"):
     lang.img("�������� �������");
	 lang.img("����� ����������");
	 lang.img("���� �����������");
	 lang.img("�������� �����������");
	 txtLang[0].innerHTML = "�����������";
	 break;
	 
	 case("comment"):
	 btnLang[0].value = "��������";
	 btnLang[1].value = "�����";
	 txtLang[0].innerHTML = "� ���������";
	 txtLang[1].innerHTML = "����������";
	 txtLang[2].innerHTML = "�� ����������";
	 txtLang[3].innerHTML = "��������";
     txtLang[4].innerHTML = "����";
	 txtLang[5].innerHTML = "�����";
	 txtLang[6].innerHTML = "��������";
	 break;
	 
	 
	 case("shopusers_notice"):
	 btnLang[0].value = "��������";
	 btnLang[1].value = "�����";
	 txtLang[0].innerHTML = "� ���������";
	 txtLang[1].innerHTML = "�������� �����������";
	 txtLang[2].innerHTML = "��������";
	 btnLang[2].value = "����������� �����������";
     txtLang[3].innerHTML = "������";
	 txtLang[4].innerHTML = "�����������";
	 txtLang[5].innerHTML= "����������";
	 txtLang[6].innerHTML= "��'�";
	 break;
	 
	 case("order_status"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "����";
	 txtLang[2].innerHTML= "���� �������";
	 break;
	 
     case("servers"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "Host";
	 txtLang[2].innerHTML = "���� �������";
	 break;
  
     case("delivery"):
	 lang.img("���� ����������");
	 lang.img("����� ������� ����������");
	 lang.img("���������� ������� ����������");
	 lang.img("³������ ���");
	 lang.img("������� ���");
     txtLang[0].innerHTML = "�������";
	 txtLang[1].innerHTML = "����";
	 txtLang[2].innerHTML = "������ �����������";
	 txtLang[3].innerHTML = "���� �������";
	 break;
   
     case("valuta"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "���������� � �������";
	 txtLang[2].innerHTML = "��� ������ ISO";
	 txtLang[3].innerHTML = "����";
	 txtLang[4].innerHTML = "���� �������";
	 break;
	 
	 case("discount"):
     txtLang[0].innerHTML = "����";
	 txtLang[1].innerHTML = "������";
	 txtLang[2].innerHTML = "���� �������";
	 break;
  
  
     case("stats1"):
	 try{
     txtLang[0].innerHTML = "������� ��������� ����";
	 txtLang[1].innerHTML = "������� ��� ����";
	 txtLang[2].innerHTML = "��� �� ������� �� �����";
	 txtLang[3].innerHTML = "�� ����";
	 txtLang[4].innerHTML = "�� ����";
	 txtLang[5].innerHTML = "ID ������";
	 txtLang[6].innerHTML = "�� ����";
	 txtLang[7].innerHTML = "�� ����";
	  }catch(e){}
	  try{
	 txtLangs[0].innerHTML = "����";
	 txtLangs[1].innerHTML = "ʳ������";
	 txtLangs[2].innerHTML = "����";
	 txtLangs[3].innerHTML = "����������� �� ������ ����";
	 txtLangs[4].innerHTML = "����������� Excel";
	 txtLangs[5].innerHTML = "������������ ���� ����������� � ������ CSV ";
	 }catch(e){}
	  try{
	 txtLang2[0].innerHTML = "� ����������";
	 txtLang2[1].innerHTML = "���������";
	 txtLang2[2].innerHTML = "������������";
	 txtLang2[3].innerHTML = "ʳ������";
	 txtLang2[4].innerHTML = "� ���������";
	 txtLang2[5].innerHTML = "������";
	 txtLang2[6].innerHTML = "����";
	 txtLangs[7].innerHTML = "����������� �� ������ ����";
	 }catch(e){}
	 
	 break;
  
     case("news_writer"):
     txtLang[0].innerHTML = "����";
	 txtLang[1].innerHTML = "���� �������";
	 txtLang[2].innerHTML = "������������";
	 txtLang[3].innerHTML = "������������ ���� ��������� ����������� � ������";
	 break;
  
     case("sort_group"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "���� �������";
	 break;
  
     case("sort"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "���� �������";
	 break;
	 
     case("search_pre"):
     txtLang[0].innerHTML = "³�����";
	 txtLang[1].innerHTML = "�������� � ����";
	 txtLang[2].innerHTML = "�����������";
	 txtLang[3].innerHTML = "��������";
	 txtLang[4].innerHTML = "³������ ���";
	 txtLang[5].innerHTML = "����� �� ������";
	 txtLang[6].innerHTML = "�����";
	 txtLang[7].innerHTML = "ID ������";
	 imgLang[0].alt = "���� �������";
	 imgLang[1].alt = "������ ������";
	 break;
     
	 case("search_jurnal"):
     txtLang[0].innerHTML = "³�����";
	 txtLang[1].innerHTML = "������ �� �������� ����";
	 txtLang[2].innerHTML = "�������� � �������";
	 txtLang[3].innerHTML = "³������ ���";
	 txtLang[4].innerHTML = "����� �� ������";
	 txtLang[5].innerHTML = "�����";
	 txtLang[6].innerHTML = "����";
	 txtLang[7].innerHTML = "��������";
	 txtLang[8].innerHTML = "������ � �������";
	 txtLang[9].innerHTML = "���������";
	 btnLang[0].value = "��������";
	 imgLang[0].alt = "����� �������������";
	 break;
	 
	 case("users_jurnal_black"):
     txtLang[0].innerHTML = "����";;
	 txtLang[1].innerHTML = "�����";
	 break;
	 
     case("users_jurnal"):
     txtLang[0].innerHTML = "����";
	 txtLang[1].innerHTML = "����������";
	 txtLang[2].innerHTML = "����";
	 txtLang[3].innerHTML = "�����";
	 btnLang[0].value = "��������";
	 imgLang[0].alt = "������ ������";
	 break;
  
     case("shopusers_status"):
     txtLang[0].innerHTML = "������";
	 txtLang[1].innerHTML = "�����";
	 txtLang[2].innerHTML = "������";
	 txtLang[3].innerHTML = "����� ������";
	 break;
  
     case("shopusers"):
	 txtLang[0].innerHTML = "³�����";
	 txtLang[1].innerHTML = "�����������";
	 txtLang[2].innerHTML = "������������";
	 txtLang[3].innerHTML = "��������";
	 txtLang[4].innerHTML = "�������� �����������";
	 btnLang[0].value = "�����";
	 lang.img("����� ����������");
	 lang.img("������� ������������");
	 txtLang[5].innerHTML = "������";
	 txtLang[6].innerHTML = "��";
	 txtLang[7].innerHTML = "����������� �����������";
	 btnLang[1].value = "��������";
	 txtLang[8].innerHTML = "+/";
	
	 txtLang[9].innerHTML = "��'�";
	 txtLang[10].innerHTML = "������";
	 txtLang[11].innerHTML = "������";
	 txtLang[12].innerHTML = "������� �����";
	 break;
  
     case("users"):
     txtLang[0].innerHTML = "������";
	 txtLang[1].innerHTML = "��'�";
	 txtLang[2].innerHTML = "����";
	 txtLang[3].innerHTML = "����� ����������";
	 break;
  
     case("gbook"):
     txtLang[0].innerHTML = "����";
	 txtLang[1].innerHTML = "��'�";
	 txtLang[2].innerHTML = "����";
	 txtLang[3].innerHTML = "����� �����";
	 break;
  
     case("opros"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "����'����";
	 txtLang[2].innerHTML = "���� ����������";
	 break;
  
     case("links"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "����";
	 txtLang[2].innerHTML = "������";
	 txtLang[3].innerHTML = "����� ���";
	 break;
  
     case("page_menu"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "����";
	 txtLang[2].innerHTML = "���������";
	 txtLang[3].innerHTML = "����� ����";
	 break;
     
	 case("baner"):
     txtLang[0].innerHTML = "�����";
	 txtLang[1].innerHTML = "������ �������";
	 txtLang[2].innerHTML = "������";
	 txtLang[3].innerHTML = "˳�� ������";
	 txtLang[4].innerHTML = "����� �����";
	 break;
	 
	 case("news"):
	 btnLang[0].value = "��������";
     txtLang[0].innerHTML = "����";
	 txtLang[1].innerHTML = "���������";
	 txtLang[2].innerHTML = "����";
	 imgLang[0].title = "���� ������";
	 break;
     
	 case("page_site_catalog"):
	 txtLang[0].innerHTML = "����� �������";
	 btnLang[0].value = "��������";
	 imgLang[0].title = "���� �������";
	 imgLang[1].title = "���� ������� �������";
	 imgLang[2].title = "���������� �������";
	 imgLang[3].title = "�������� �� �������";

	 txtLang[1].innerHTML = "³�����";
	 txtLang[2].innerHTML = "��������";
	 txtLang[3].innerHTML = "�� ��������";
	 txtLang[4].innerHTML = "�������� ���������";
	 txtLang[5].innerHTML = "��������� ���������";
	 txtLang[6].innerHTML = "��������� �� ��������";
	 txtLang[7].innerHTML = "������ ������������ ������";
	 txtLang[8].innerHTML = "�������� � ����";
	 txtLang[9].innerHTML = "��������";
	 imgLang[4].title = "Open all";
	 imgLang[5].title = "Close all";
	 break;
  
     case("icon"):
	 icon.img("�������");
     icon.img("����������");	
	 icon.img("����");	
	 icon.img("������������ ������");
	 icon.img("������������ ������");
	 icon.img("������� ������������");
	 icon.img("Keywords & Titles");
	 icon.img("��������");
	 icon.img("�������");
	 icon.img("������");
	 icon.img("������");
	 icon.img("������� �����");
	 icon.img("���������");
	 icon.img("����������");
	 icon.img("��������");
	 icon.img("�����������");
	 icon.img("������������");
	 icon.img("������ �����������");
	 icon.img("������ ������");
	 icon.img("SQL");
	 icon.img("�������� ����");
	 icon.img("�������");
	 icon.img("�����");
	 lang.clean();
	 break;
  
	 case("orders"):
	 d.getElementById("btnShow").value = "��������";
	 d.getElementById("btnSearch").value = "�����";
	 d.getElementById("btnStatus").value = "��������";
	 lang.img("��������� ������");
	 lang.txt();
     txtLang[0].innerHTML = "������";
	 d.getElementById("txtLoadExe").innerHTML = "����������� Order Agent Windows";
	 d.getElementById("txtLoadExe").title = "����������� Order Agent Windows";
	 lang.txt("³�����");
	 lang.txt("�������� � ����");
	 txtLang[3].innerHTML = "������ ������";
	 txtLang[4].innerHTML = "�������� �����";
	 txtLang[5].innerHTML = "� ����������";
	 txtLang[6].innerHTML = "�����������";
	 txtLang[7].innerHTML = "��������";
	 txtLang[8].innerHTML = "ʳ�-���";
	 txtLang[9].innerHTML = "������";
	 txtLang[10].innerHTML = "����";
	 txtLang[11].innerHTML = "����������";
	 txtLang[12].innerHTML = "������";
	 txtLang[13].innerHTML = "³�����";
	 
	 break;
	 
	 case("cat_prod"):
	 txtLang[0].innerHTML = "�����";
	 document.getElementById("btnShow").value = "��������";
	 lang.img("����� �������");
	 lang.img("���� �������");
	 lang.img("���������� ���������");
	 lang.img("�������� �� ��� ��������");
	 lang.img("��������������");
	 lang.img("ϳ�������� �������������");
	 lang.img("³������ ���");
	 lang.img("������� ���");
	 txtLang[1].innerHTML = "³�����";
	
	 txtLang[2].label = "ĳ�";
	 txtLang[3].innerHTML = "��������� �� ��������";
	 txtLang[4].innerHTML = "������� ����";
	 txtLang[5].innerHTML = "���'����� � ��������";
	 txtLang[6].innerHTML = "���'����� � ����������������";
	 txtLang[7].innerHTML = "������� � Excel ";
	 txtLang[8].label = "�������";
	 txtLang[9].innerHTML = "������ � �������";
	 txtLang[10].innerHTML = "�������� � �������";
	 
	 txtLang[11].label = "���������� ����������";
	 txtLang[12].innerHTML = "������ �� ����������� ����������";
	 txtLang[13].innerHTML = "�������� � ����������� ����������";
	 txtLang[14].label = "��������";
	 
	 txtLang[15].innerHTML = "�� ��������";
	 txtLang[16].innerHTML = "��������";
	 txtLang[17].innerHTML = "�� ����������";
	 txtLang[18].innerHTML = "����������";
	 txtLang[19].innerHTML = "�������� � ����";
	
	 txtLang[20].label = "YML Yandex ������";
	 txtLang[21].innerHTML = "�������� � YML ������";
	 txtLang[22].innerHTML = "������ � YML �����";
	 txtLang[23].innerHTML = "³������ ���";
	 txtLang[24].innerHTML = "����� ������";
	 txtLang[25].innerHTML = "��������";
	
	 lang.clean();
	 break;

   }
   }catch(e){}
   
}
