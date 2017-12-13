// Часы
var	monthName =	new Array("January", "February", "Marth", "April", "May", "June", "July", "August", "September", "October","November", "December")
var dayNameFull = new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday")
var dayName = new Array("M","T","W","Th","Fr","St","Su")


// Объект языка версия 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
d = document;
lang.title = function(txt){// Смена заголовка
             document.title = txt;
             }
lang.txt = function(txt){// Смена текста
            var obj = d.getElementsByName("txtLang");
			if(obj[num_txt]){
            obj[num_txt].innerHTML = txt;
            num_txt++;
			}}

lang.btn = function(txt){// Смена кнопки
            var obj = document.getElementsByName("btnLang");
			if(obj[num_btn]){
            obj[num_btn].value = txt;
            num_btn++;
            }}
lang.img = function(txt){// Смена альты картинки
            var obj = document.getElementsByName("imgLang");
			if(obj[num_img]){
            obj[num_img].alt = txt;
			obj[num_img].title = txt;
            num_img++;
            }}
lang.clean = function(){// Очищаем переменные
            num_txt=0;num_btn=0;num_img=0;
            }

icon = new Object();
num_icon = 0;
icon.img = function(txt){// Смена альты картинки
            var obj = document.getElementsByName("iconLang");
			if(obj[num_icon]){
            obj[num_icon].alt = txt;
			obj[num_icon].title = txt;
            num_icon++;
            }}


// Смена языка
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
	 txtLang[0].innerHTML = "Input in the Administrative Panel";
	 txtLang[1].innerHTML = "Specify the user and the password";
	 txtLang[2].innerHTML = "User";
	 txtLang[3].innerHTML = "Password";
	 btnLang[0].value = "Exit";
	 txtLang[4].innerHTML = "Open in a current window";
	 try{
	 txtLangs[0].innerHTML = "Remember a login and the password";
	 txtLang[5].innerHTML = "Send the password on E-mail the user";
	 }catch(e){
	 txtLang2[0].innerHTML = "Not to remember a login and the password";
	 txtLang[5].innerHTML = "Send the password on E-mail the user";
	 }
	 break;
  
     case("csv_base"):
	 try{
     txtLang[0].innerHTML = "Master of loading of commodity base Excel";
	 txtLang[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 txtLang[2].innerHTML = "Data noted by tags will be changed/is added";
	 txtLang[3].innerHTML = "Name";
	 txtLang[4].innerHTML = "Content";
	 txtLang[5].innerHTML = "Small Pic";
	 txtLang[6].innerHTML = "Deacription";
	 txtLang[7].innerHTML = "Big Pic";
	 txtLang[8].innerHTML = "Price1";
	 txtLang[9].innerHTML = "Price2";
	 txtLang[10].innerHTML = "Price3";
	 txtLang[11].innerHTML = "Price4";
	 txtLang[12].innerHTML = "Price5";
	 txtLang[13].innerHTML = "Warehouse";
	 txtLang[14].innerHTML = "Art";
	 txtLang[15].innerHTML = "Category";
	 txtLang[16].innerHTML = "Characteristics";
	 txtLang[17].innerHTML = "Weight";
	 
	 txtLang[18].innerHTML = "Operation course";
	 txtLang[19].innerHTML = "Step 1 - download a file example ";
	 txtLang[20].innerHTML = "Step 2 - choose in advance filled file ";
	 txtLang[21].innerHTML = "Step 3 - accept changes in a file ";
	 txtLang[22].innerHTML = "Step 4 - wait operation performance ";
	 txtLang[23].innerHTML = "Step 5 - pass in section the Catalogue - the Unloaded goods - Base Excel";
     txtLang[24].innerHTML = "Step 6 - Allocate with a tag the goods and will choose a folder for carrying over by an option With noted - to Transfer to the catalogue. If it is required, make corresponding catalogues. ";
	 txtLang[25].innerHTML = "Attention";
	 txtLang[26].innerHTML = "Attentively check preliminary loaded data in avoidance of incorrect loading of data";
     txtLang[27].innerHTML = "Download a file example";
	
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "ID";
	 txtLangs[1].innerHTML = "Name";
	 txtLangs[2].innerHTML = "Price1";
	 txtLangs[3].innerHTML = "Price2";
	 txtLangs[4].innerHTML = "Price3";
	 txtLangs[5].innerHTML = "Price4";
	 txtLangs[6].innerHTML = "Price5";
	 txtLangs[7].innerHTML = "Warehouse";
	 txtLangs[8].innerHTML = "Weight";
	 txtLangs[9].innerHTML = "Choose other file";
	 txtLangs[10].innerHTML = "Accept changes";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Loading of commodity base is executed!";
	 txtLang2[1].innerHTML = "Course of operations";
	 txtLang2[2].innerHTML = "Step 1 - to pass in section the Catalogue - the Unloaded goods - Excel Base";
     txtLang2[3].innerHTML = "Step 2 - allocate with a tag the goods and choose a folder for carrying over by an option With noted - to transfer to the catalogue";
	 btnLang[0].value = "Reset";
	 }catch(e){}
	 
	 break;
	 
  
     case("csv"):
	 try{
     txtLang[0].innerHTML = "Master of loading of a price";
	 txtLang[1].innerHTML = "";
	 txtLang[2].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 txtLang[3].innerHTML = "Operation course";
	 txtLang[4].innerHTML = "Step 1 - to choose in advance unloaded price";
	 txtLang[5].innerHTML = "Step 2 - to accept changes in a price";
	 txtLang[6].innerHTML = "Step 3 - to wait operation performance";
	 txtLang[7].innerHTML = "Attention";
	 txtLang[8].innerHTML = "Attentively check preliminary loaded data in avoidance of incorrect loading of data";
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "Name";
	 txtLangs[1].innerHTML = "Price";
	 txtLangs[2].innerHTML = "New price";
	 txtLangs[3].innerHTML = "Under the order";
	 txtLangs[4].innerHTML = "Article";
	 txtLangs[5].innerHTML = "New";
	 txtLangs[6].innerHTML = "Special offer";
	 txtLangs[7].innerHTML = "YML Market";
	 txtLangs[8].innerHTML = "In a warehouse";
	 txtLangs[9].innerHTML = "Presence";
	 txtLangs[10].innerHTML = "Sorting";
	 txtLangs[11].innerHTML = "Choose other file";
	 txtLangs[12].innerHTML = "Accept changes";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Price loading is executed";
	 txtLang2[1].innerHTML = "Will choose a file ";
	 btnLang[0].value = "Reset";
	 }catch(e){}
	 
	 break;
	 
	
	 case("shopusers_messages"):
     lang.img("Review of statuses");
	 lang.img("Review of notices");
	 lang.img("New message");
	 lang.img("Remove messages");
	 txtLang[0].innerHTML = "Users";
	 break;
	 
	 case("comment"):
	 btnLang[0].value = "Show";
	 btnLang[1].value = "Search";
	 txtLang[0].innerHTML = "Whis selected";
	 txtLang[1].innerHTML = "Display";
	 txtLang[2].innerHTML = "Not display";
	 txtLang[3].innerHTML = "Remove";
     txtLang[4].innerHTML = "Date";
	 txtLang[5].innerHTML = "Autor";
	 txtLang[6].innerHTML = "Content";
	 break;
	 
	 
	 case("shopusers_notice"):
	 btnLang[0].value = "Show";
	 btnLang[1].value = "Search";
	 txtLang[0].innerHTML = "Whis selected";
	 txtLang[1].innerHTML = "Send a message";
	 txtLang[2].innerHTML = "Remove";
	 btnLang[2].value = "Automatic notice";
     txtLang[3].innerHTML = "Status";
	 txtLang[4].innerHTML = "Urgency";
	 txtLang[5].innerHTML= "User";
	 txtLang[6].innerHTML= "Name";
	 break;
	 
	 case("order_status"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Color";
	 txtLang[2].innerHTML= "New item";
	 break;
	 
     case("servers"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Host";
	 txtLang[2].innerHTML = "New item";
	 break;
  
     case("delivery"):
	 lang.img("New delivery");
	 lang.img("New delivery category");
	 lang.img("Edit delivery category");
	 lang.img("Open all");
	 lang.img("Close all");
     txtLang[0].innerHTML = "Category";
	 txtLang[1].innerHTML = "Sum";
	 txtLang[2].innerHTML = "From above free of charge";
	 txtLang[3].innerHTML = "New item";
	 break;
   
     case("valuta"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Designation in shop";
	 txtLang[2].innerHTML = "Code of currency ISO";
	 txtLang[3].innerHTML = "Course";
	 txtLang[4].innerHTML = "New item";
	 break;
	 
	 case("discount"):
     txtLang[0].innerHTML = "Sim";
	 txtLang[1].innerHTML = "Discount";
	 txtLang[2].innerHTML = "New item";
	 break;
  
  
     case("stats1"):
	 try{
     txtLang[0].innerHTML = "Master of creation of reports";
	 txtLang[1].innerHTML = "Will choose a report kind";
	 txtLang[2].innerHTML = "Report of orders by date";
	 txtLang[3].innerHTML = "From date";
	 txtLang[4].innerHTML = "On date";
	 txtLang[5].innerHTML = "ID the goods";
	 txtLang[6].innerHTML = "From date";
	 txtLang[7].innerHTML = "On date";
	  }catch(e){}
	  try{
	 txtLangs[0].innerHTML = "Date";
	 txtLangs[1].innerHTML = "Quantity";
	 txtLangs[2].innerHTML = "Sum";
	 txtLangs[3].innerHTML = "Return to a report choice";
	 txtLangs[4].innerHTML = "Unload in Excel";
	 txtLangs[5].innerHTML = "Report unloading is carried out in format CSV ";
	 }catch(e){}
	  try{
	 txtLang2[0].innerHTML = "№ Order";
	 txtLang2[1].innerHTML = "Receipt";
	 txtLang2[2].innerHTML = "Name";
	 txtLang2[3].innerHTML = "Quantity";
	 txtLang2[4].innerHTML = "In order";
	 txtLang2[5].innerHTML = "Discount";
	 txtLang2[6].innerHTML = "Sum";
	 txtLangs[7].innerHTML = "Return to a report choice";
	 }catch(e){}
	 
	 break;
  
     case("news_writer"):
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "New item";
	 txtLang[2].innerHTML = "Unloading";
	 txtLang[3].innerHTML = "The unloading of base of subscribers is carried out in a format";
	 break;
  
     case("sort_group"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "New item";
	 break;
  
     case("sort"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "New item";
	 break;
	 
     case("search_pre"):
     txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "To remove from base";
	 txtLang[2].innerHTML = "Block";
	 txtLang[3].innerHTML = "Involve";
	 txtLang[4].innerHTML = "To note all";
	 txtLang[5].innerHTML = "To remove a mark from all";
	 txtLang[6].innerHTML = "Inquiry";
	 txtLang[7].innerHTML = "ID the goods";
	 imgLang[0].alt = "New item";
	 imgLang[1].alt = "Search Log";
	 break;
     
	 case("search_jurnal"):
     txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "To add in search base";
	 txtLang[2].innerHTML = "To remove from magazine";
	 txtLang[3].innerHTML = "To note all";
	 txtLang[4].innerHTML = "To remove a mark from all";
	 txtLang[5].innerHTML = "Inquiry";
	 txtLang[6].innerHTML = "Date";
	 txtLang[7].innerHTML = "Found";
	 txtLang[8].innerHTML = "Searched in a category";
	 txtLang[9].innerHTML = "Arrangement";
	 btnLang[0].value = "Show";
	 imgLang[0].alt = "Search readdressing";
	 break;
	 
	 case("users_jurnal_black"):
     txtLang[0].innerHTML = "Date";;
	 txtLang[1].innerHTML = "Country";
	 break;
	 
     case("users_jurnal"):
     txtLang[0].innerHTML = "Enter";
	 txtLang[1].innerHTML = "User";
	 txtLang[2].innerHTML = "Date";
	 txtLang[3].innerHTML = "Country";
	 btnLang[0].value = "Show";
	 imgLang[0].alt = "Black list";
	 break;
  
     case("shopusers_status"):
     txtLang[0].innerHTML = "Status";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Discount";
	 txtLang[3].innerHTML = "New status";
	 break;
  
     case("shopusers"):
	 txtLang[0].innerHTML = "With the noted";
	 txtLang[1].innerHTML = "Block";
	 txtLang[2].innerHTML = "Unblock";
	 txtLang[3].innerHTML = "Remove";
	 txtLang[4].innerHTML = "Send message";
	 btnLang[0].value = "Search";
	 lang.img("New User");
	 lang.img("Statuses of users");
	 txtLang[5].innerHTML = "Status";
	 txtLang[6].innerHTML = "All";
	 txtLang[7].innerHTML = "Authorised user";
	 btnLang[1].value = "Show";
	 txtLang[8].innerHTML = "+/";
	
	 txtLang[9].innerHTML = "Name";
	 txtLang[10].innerHTML = "Status";
	 txtLang[11].innerHTML = "Discount";
	 txtLang[12].innerHTML = "Last input";
	 break;
  
     case("users"):
     txtLang[0].innerHTML = "Status";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Input";
	 txtLang[3].innerHTML = "New user";
	 break;
  
     case("gbook"):
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "Name";
	 txtLang[2].innerHTML = "Content";
	 txtLang[3].innerHTML = "New Response";
	 break;
  
     case("opros"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Binding";
	 txtLang[2].innerHTML = "New Interrogation";
	 break;
  
     case("links"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Content";
	 txtLang[2].innerHTML = "Button";
	 txtLang[3].innerHTML = "New link";
	 break;
  
     case("page_menu"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Binding";
	 txtLang[2].innerHTML = "Arrangement";
	 txtLang[3].innerHTML = "New menu";
	 break;
     
	 case("baner"):
     txtLang[0].innerHTML = "Name";
	 txtLang[1].innerHTML = "Displays today";
	 txtLang[2].innerHTML = "Total";
	 txtLang[3].innerHTML = "Limit of displays";
	 txtLang[4].innerHTML = "New banner";
	 break;
	 
	 case("news"):
	 btnLang[0].value = "Dispatch";
     txtLang[0].innerHTML = "Date";
	 txtLang[1].innerHTML = "Headers";
	 txtLang[2].innerHTML = "Content";
	 imgLang[0].title = "New news";
	 break;
     
	 case("page_site_catalog"):
	 txtLang[0].innerHTML = "Page search";
	 btnLang[0].value = "Show";
	 imgLang[0].title = "New page";
	 imgLang[1].title = "New page category";
	 imgLang[2].title = "Edit category";
	 imgLang[3].title = "Show all pages";

	 txtLang[1].innerHTML = "With the noted";
	 txtLang[2].innerHTML = "On";
	 txtLang[3].innerHTML = "Off";
	 txtLang[4].innerHTML = "Include registration";
	 txtLang[5].innerHTML = "Off registration";
	 txtLang[6].innerHTML = "Transfer to the catalogue";
	 txtLang[7].innerHTML = "Add the recommended goods";
	 txtLang[7].innerHTML = "Add the recommended goods";
	 txtLang[8].innerHTML = "Remove from base";
	 txtLang[9].innerHTML = "Categories";
	 imgLang[4].title = "Open all";
	 imgLang[5].title = "Close all";
	 break;
  
     case("icon"):
	 icon.img("Category");
     icon.img("Orders");	
	 icon.img("Reports");	
	 icon.img("Price loading");
	 icon.img("Price unloading");
	 icon.img("Options");
	 icon.img("Keywords & Titles");
	 icon.img("Requisites");
	 icon.img("Pages");
	 icon.img("News");
	 icon.img("Banners");
	 icon.img("Text blocks");
	 icon.img("Responses");
	 icon.img("References");
	 icon.img("Interrogations");
	 icon.img("Users");
	 icon.img("Managers");
	 icon.img("Authorisation Log");
	 icon.img("Search Log");
	 icon.img("SQL");
	 icon.img("Backup copy");
	 icon.img("Shop area");
	 icon.img("Exit");
	 lang.clean();
	 break;
  
	 case("orders"):
	 d.getElementById("btnShow").value = "Show";
	 d.getElementById("btnSearch").value = "Search";
	 d.getElementById("btnStatus").value = "Show";
	 lang.img("Electronic payments");
	 lang.txt();
     txtLang[0].innerHTML = "Status";
	 d.getElementById("txtLoadExe").innerHTML = "Load Order Agent Windows";
	 d.getElementById("txtLoadExe").title = "Load Order Agent Windows";
	 lang.txt("With noted");
	 lang.txt("Remove from base");
	 txtLang[3].innerHTML = "Change the status";
	 txtLang[4].innerHTML = "Create new";
	 txtLang[5].innerHTML = "№ Order";
	 txtLang[6].innerHTML = "Receipt";
	 txtLang[7].innerHTML = "Buyer";
	 txtLang[8].innerHTML = "Qu-ty";
	 txtLang[9].innerHTML = "Dis.";
	 txtLang[10].innerHTML = "Sum";
	 txtLang[11].innerHTML = "Processed";
	 txtLang[12].innerHTML = "Status";
	 txtLang[13].innerHTML = "With noted";
	 
	 break;
	 
	 case("cat_prod"):
	 txtLang[0].innerHTML = "Search";
	 document.getElementById("btnShow").value = "Show";
	 lang.img("New category");
	 lang.img("New item");
	 lang.img("Edit a subcategory");
	 lang.img("Conclusion of all items");
	 lang.img("Characteristics");
	 lang.img("Calculator of characteristics");
	 lang.img("Open All");
	 lang.img("Close All");
	 txtLang[1].innerHTML = "With noted";
	
	 txtLang[2].label = "Actions";
	 txtLang[3].innerHTML = "Transfer";
	 txtLang[4].innerHTML = "Make a copy";
	 txtLang[5].innerHTML = "Connect with clauses ";
	 txtLang[6].innerHTML = "Connect with characteristics";
	 txtLang[7].innerHTML = "Export in Excel ";
	 txtLang[8].label = "Novelties";
	 txtLang[9].innerHTML = "Add in novelties";
	 txtLang[10].innerHTML = "Clean from novelties ";
	 
	 txtLang[11].label = "Special offer";
	 txtLang[12].innerHTML = "Add in novelties";
	 txtLang[13].innerHTML = "Clean from novelties";
	 txtLang[14].label = "Conclusion";
	 
	 txtLang[15].innerHTML = "Not available";
	 txtLang[16].innerHTML = "Available";
	 txtLang[17].innerHTML = "Not to show";
	 txtLang[18].innerHTML = "Show";
	 txtLang[19].innerHTML = "Remove from base";
	
	 txtLang[20].label = "YML Yandex the Market";
	 txtLang[21].innerHTML = "Clean from YML a price";
	 txtLang[22].innerHTML = "Add in YML a price";
     txtLang[23].innerHTML = "Note all";
	 txtLang[24].innerHTML = "Remove a mark";
	 txtLang[25].innerHTML = "Categories";
	
	 lang.clean();
	 break;

   }
   }catch(e){}
   
}
