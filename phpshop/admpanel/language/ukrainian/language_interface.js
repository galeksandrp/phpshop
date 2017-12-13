// Часы
var	monthName =	new Array("Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень", "Серпень", "Вересень", "Жовтень","Листопад", "Грудень")
var dayNameFull = new Array("Неділя","Понеділок","Вівторок","Середа","Четвер","П'ятниця","Субота")
var dayName = new Array("Пн","Вт","Ср","Чтh","Пт","Сб","Нд")


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
	 txtLang[0].innerHTML = "Вхід до Адміністративної Панелі";
	 txtLang[1].innerHTML = "Визначте користувачата і пароль";
	 txtLang[2].innerHTML = "Користувач";
	 txtLang[3].innerHTML = "Пароль";
	 btnLang[0].value = "Вихід";
	 txtLang[4].innerHTML = "Відкрити в поточному вікні";
	 try{
	 txtLangs[0].innerHTML = "Пам'ятати логін і пароль";
	 txtLang[5].innerHTML = "Відправити пароль на E-mail користувача";
	 }catch(e){
	 txtLang2[0].innerHTML = "Не пам'ятати логін і пароль";
	 txtLang[5].innerHTML = "Відправити пароль на E-mail користувача";
	 }
	 break;
  
     case("csv_base"):
	 try{
     txtLang[0].innerHTML = "Майстер завантаження товарної бази Excel";
	 txtLang[1].innerHTML = "Виберіть файл з розширенням ";
	 btnLang[0].value = "Скинути";
	 txtLang[2].innerHTML = "Дані, відмічені tags будуть змінені/додані";
	 txtLang[3].innerHTML = "Найменування";
	 txtLang[4].innerHTML = "короткий опис";
	 txtLang[5].innerHTML = "Мале зображення";
	 txtLang[6].innerHTML = "Повний опис";
	 txtLang[7].innerHTML = "Велике зображення";
	 txtLang[8].innerHTML = "Ціна1";
	 txtLang[9].innerHTML = "Ціна2";
	 txtLang[10].innerHTML = "Ціна3";
	 txtLang[11].innerHTML = "Ціна4";
	 txtLang[12].innerHTML = "Ціна5";
	 txtLang[13].innerHTML = "Склад";
	 txtLang[14].innerHTML = "Артикул";
	 txtLang[15].innerHTML = "Каталог";
	 txtLang[16].innerHTML = "Характеристики";
	 txtLang[17].innerHTML = "Вага";
	 
	 txtLang[18].innerHTML = "Хід операції";
	 txtLang[19].innerHTML = "Крок 1 - завантажити приклад файлу (див. нижче)";
	 txtLang[20].innerHTML = "Крок 2 - вибрати заздалегідь заповнений файл";
	 txtLang[21].innerHTML = "Крок 3 - прийняти зміни у файлі";
	 txtLang[22].innerHTML = "Крок 4 - дочекатися виконання операції";
	 txtLang[23].innerHTML = "Крок 5 - перейти в Каталог - Вивантажені товари - База Excel";
     txtLang[24].innerHTML = "Крок 6 - відмітити прапорцем товари і вибрати папку для перенесення операцією Відмічені - Перенести до каталогу. При необхідності - створити відповідні каталоги. ";
	 txtLang[25].innerHTML = "Увага";
	 txtLang[26].innerHTML = "Уважно перевіряйте завантажені дані, щоб уникнути їх некоректного завантаження";
     txtLang[27].innerHTML = "Завантажити приклад файлу ";
	
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "ID";
	 txtLangs[1].innerHTML = "Найменування";
	 txtLangs[2].innerHTML = "Ціна1";
	 txtLangs[3].innerHTML = "Ціна2";
	 txtLangs[4].innerHTML = "Ціна3";
	 txtLangs[5].innerHTML = "Ціна4";
	 txtLangs[6].innerHTML = "Ціна5";
	 txtLangs[7].innerHTML = "Склад";
	 txtLangs[8].innerHTML = "Вага";
	 txtLangs[9].innerHTML = "Вибрати інший файл";
	 txtLangs[10].innerHTML = "Прийняти зміни";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Завантаження товарної бази виконано!";
	 txtLang2[1].innerHTML = "Хід операції";
	 txtLang2[2].innerHTML = "Крок 1 - перейти у розділ Каталог - Вивантажені товари - База Excel";
     txtLang2[3].innerHTML = "Крок 2 - відмітити прапорцем товари і вибрати течку для перенесення операцією Відмічені - Перенести до каталогу";
	 btnLang[0].value = "Скинути";
	 }catch(e){}
	 
	 break;
	 
  
     case("csv"):
	 try{
     txtLang[0].innerHTML = "Майстер завантаження прайсу";
	 txtLang[1].innerHTML = "";
	 txtLang[2].innerHTML = "Виберіть файл";
	 btnLang[0].value = "Скинути";
	 txtLang[3].innerHTML = "Хід операції";
	 txtLang[4].innerHTML = "Крок 1 - вибрати заздалегідь вивантажений прайс";
	 txtLang[5].innerHTML = "Крок 2 - прийняти зміни в прайсі";
	 txtLang[6].innerHTML = "Крок 3 - дочекатися виконання операції";
	 txtLang[7].innerHTML = "Увага";
	 txtLang[8].innerHTML = "Уважно перевіряйте завантажені дані, щоб уникнути їх некоректного завантаження";
	 }catch(e){}
	 try{
	 txtLangs[0].innerHTML = "Найменування";
	 txtLangs[1].innerHTML = "Ціна";
	 txtLangs[2].innerHTML = "Нова ціна";
	 txtLangs[3].innerHTML = "Під замовлення";
	 txtLangs[4].innerHTML = "Артикул";
	 txtLangs[5].innerHTML = "Новий";
	 txtLangs[6].innerHTML = "Спец. пропозиція";
	 txtLangs[7].innerHTML = "YML Маркет";
	 txtLangs[8].innerHTML = "На складі";
	 txtLangs[9].innerHTML = "Наявність";
	 txtLangs[10].innerHTML = "Сортування";
	 txtLangs[11].innerHTML = "Вибрати інший файл";
	 txtLangs[12].innerHTML = "Прийняти зміни";
	 }catch(e){}
	 try{
	 txtLang2[0].innerHTML = "Завантаження прайсу виконано";
	 txtLang2[1].innerHTML = "Виберіть файл";
	 btnLang[0].value = "Скинути";
	 }catch(e){}
	 
	 break;
	 
	
	 case("shopusers_messages"):
     lang.img("Перегляд статусів");
	 lang.img("Огляд повідомлень");
	 lang.img("Нове повідомлення");
	 lang.img("Видалити повідомлення");
	 txtLang[0].innerHTML = "Користувачі";
	 break;
	 
	 case("comment"):
	 btnLang[0].value = "Показати";
	 btnLang[1].value = "Пошук";
	 txtLang[0].innerHTML = "З відміченими";
	 txtLang[1].innerHTML = "Показувати";
	 txtLang[2].innerHTML = "Не показувати";
	 txtLang[3].innerHTML = "Видалити";
     txtLang[4].innerHTML = "Дата";
	 txtLang[5].innerHTML = "Автор";
	 txtLang[6].innerHTML = "Коментар";
	 break;
	 
	 
	 case("shopusers_notice"):
	 btnLang[0].value = "Показати";
	 btnLang[1].value = "Пошук";
	 txtLang[0].innerHTML = "З відміченими";
	 txtLang[1].innerHTML = "Розіслати повідомлення";
	 txtLang[2].innerHTML = "Видалити";
	 btnLang[2].value = "Автоматичне повідомлення";
     txtLang[3].innerHTML = "Статус";
	 txtLang[4].innerHTML = "Актуальність";
	 txtLang[5].innerHTML= "Користувач";
	 txtLang[6].innerHTML= "Ім'я";
	 break;
	 
	 case("order_status"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Колір";
	 txtLang[2].innerHTML= "Нова позиція";
	 break;
	 
     case("servers"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Host";
	 txtLang[2].innerHTML = "Нова позиція";
	 break;
  
     case("delivery"):
	 lang.img("Нове постачання");
	 lang.img("Новий каталог постачання");
	 lang.img("Редагувати каталог постачання");
	 lang.img("Відкрити все");
	 lang.img("Закрити все");
     txtLang[0].innerHTML = "Каталог";
	 txtLang[1].innerHTML = "Сума";
	 txtLang[2].innerHTML = "Зверху безкоштовно";
	 txtLang[3].innerHTML = "Нова позиція";
	 break;
   
     case("valuta"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Позначення в магазині";
	 txtLang[2].innerHTML = "Код валюти ISO";
	 txtLang[3].innerHTML = "Курс";
	 txtLang[4].innerHTML = "Нова позиція";
	 break;
	 
	 case("discount"):
     txtLang[0].innerHTML = "Сума";
	 txtLang[1].innerHTML = "Знижка";
	 txtLang[2].innerHTML = "Нова позиція";
	 break;
  
  
     case("stats1"):
	 try{
     txtLang[0].innerHTML = "Майстер створення звітів";
	 txtLang[1].innerHTML = "Виберіть вид звіту";
	 txtLang[2].innerHTML = "Звіт по продажу за датою";
	 txtLang[3].innerHTML = "від дати";
	 txtLang[4].innerHTML = "по дату";
	 txtLang[5].innerHTML = "ID товару";
	 txtLang[6].innerHTML = "від дати";
	 txtLang[7].innerHTML = "по дату";
	  }catch(e){}
	  try{
	 txtLangs[0].innerHTML = "Дата";
	 txtLangs[1].innerHTML = "Кількість";
	 txtLangs[2].innerHTML = "Сума";
	 txtLangs[3].innerHTML = "Повернутися до вибору звіту";
	 txtLangs[4].innerHTML = "Вивантажити Excel";
	 txtLangs[5].innerHTML = "Вивантаження звіту здійснюється у фотмат CSV ";
	 }catch(e){}
	  try{
	 txtLang2[0].innerHTML = "№ замовлення";
	 txtLang2[1].innerHTML = "Квитанція";
	 txtLang2[2].innerHTML = "Найменування";
	 txtLang2[3].innerHTML = "Кількість";
	 txtLang2[4].innerHTML = "В замовленні";
	 txtLang2[5].innerHTML = "Знижка";
	 txtLang2[6].innerHTML = "Сума";
	 txtLangs[7].innerHTML = "Повернутися до вибору звіту";
	 }catch(e){}
	 
	 break;
  
     case("news_writer"):
     txtLang[0].innerHTML = "Дата";
	 txtLang[1].innerHTML = "Нова позиція";
	 txtLang[2].innerHTML = "Вивантаження";
	 txtLang[3].innerHTML = "Вивантаження бази підписчиків здійснюється у форматі";
	 break;
  
     case("sort_group"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Нова позиція";
	 break;
  
     case("sort"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Нова позиція";
	 break;
	 
     case("search_pre"):
     txtLang[0].innerHTML = "Відмічені";
	 txtLang[1].innerHTML = "Видалити з бази";
	 txtLang[2].innerHTML = "Заблокувати";
	 txtLang[3].innerHTML = "Залучити";
	 txtLang[4].innerHTML = "Відмітити все";
	 txtLang[5].innerHTML = "Зняти усі відмітки";
	 txtLang[6].innerHTML = "Запит";
	 txtLang[7].innerHTML = "ID товарів";
	 imgLang[0].alt = "Нова позиція";
	 imgLang[1].alt = "Журнал пошуку";
	 break;
     
	 case("search_jurnal"):
     txtLang[0].innerHTML = "Відмічені";
	 txtLang[1].innerHTML = "Додати до пошукової бази";
	 txtLang[2].innerHTML = "Видалити з журналу";
	 txtLang[3].innerHTML = "Відмітити все";
	 txtLang[4].innerHTML = "Зняти усі відмітки";
	 txtLang[5].innerHTML = "Запит";
	 txtLang[6].innerHTML = "Дата";
	 txtLang[7].innerHTML = "Знайдено";
	 txtLang[8].innerHTML = "Шукали в категорії";
	 txtLang[9].innerHTML = "Розміщення";
	 btnLang[0].value = "Показати";
	 imgLang[0].alt = "Пошук переадресації";
	 break;
	 
	 case("users_jurnal_black"):
     txtLang[0].innerHTML = "Дата";;
	 txtLang[1].innerHTML = "Країна";
	 break;
	 
     case("users_jurnal"):
     txtLang[0].innerHTML = "Вхід";
	 txtLang[1].innerHTML = "Користувач";
	 txtLang[2].innerHTML = "Дата";
	 txtLang[3].innerHTML = "Країна";
	 btnLang[0].value = "Показати";
	 imgLang[0].alt = "Чорний список";
	 break;
  
     case("shopusers_status"):
     txtLang[0].innerHTML = "Статус";
	 txtLang[1].innerHTML = "Назва";
	 txtLang[2].innerHTML = "Знижка";
	 txtLang[3].innerHTML = "Новий статус";
	 break;
  
     case("shopusers"):
	 txtLang[0].innerHTML = "Відмічені";
	 txtLang[1].innerHTML = "Заблокувати";
	 txtLang[2].innerHTML = "Розблокувати";
	 txtLang[3].innerHTML = "Видалити";
	 txtLang[4].innerHTML = "Надіслати повідомлення";
	 btnLang[0].value = "Пошук";
	 lang.img("Новий користувач");
	 lang.img("Статуси користувачів");
	 txtLang[5].innerHTML = "Статус";
	 txtLang[6].innerHTML = "Всі";
	 txtLang[7].innerHTML = "Авторизовані користувачі";
	 btnLang[1].value = "Показати";
	 txtLang[8].innerHTML = "+/";
	
	 txtLang[9].innerHTML = "Ім'я";
	 txtLang[10].innerHTML = "Статус";
	 txtLang[11].innerHTML = "Знижка";
	 txtLang[12].innerHTML = "Останній захід";
	 break;
  
     case("users"):
     txtLang[0].innerHTML = "Статус";
	 txtLang[1].innerHTML = "Ім'я";
	 txtLang[2].innerHTML = "Вхід";
	 txtLang[3].innerHTML = "Новий користувач";
	 break;
  
     case("gbook"):
     txtLang[0].innerHTML = "Дата";
	 txtLang[1].innerHTML = "Ім'я";
	 txtLang[2].innerHTML = "Зміст";
	 txtLang[3].innerHTML = "Новий відгук";
	 break;
  
     case("opros"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Прив'язка";
	 txtLang[2].innerHTML = "Нове опитування";
	 break;
  
     case("links"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Зміст";
	 txtLang[2].innerHTML = "Кнопка";
	 txtLang[3].innerHTML = "Новий лінк";
	 break;
  
     case("page_menu"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Зміст";
	 txtLang[2].innerHTML = "Розміщення";
	 txtLang[3].innerHTML = "Новий блок";
	 break;
     
	 case("baner"):
     txtLang[0].innerHTML = "Назва";
	 txtLang[1].innerHTML = "Показів сьогодні";
	 txtLang[2].innerHTML = "Усього";
	 txtLang[3].innerHTML = "Ліміт показів";
	 txtLang[4].innerHTML = "Новий банер";
	 break;
	 
	 case("news"):
	 btnLang[0].value = "Розіслати";
     txtLang[0].innerHTML = "Дата";
	 txtLang[1].innerHTML = "Заголовок";
	 txtLang[2].innerHTML = "Зміст";
	 imgLang[0].title = "Нова новина";
	 break;
     
	 case("page_site_catalog"):
	 txtLang[0].innerHTML = "Пошук сторінки";
	 btnLang[0].value = "Показати";
	 imgLang[0].title = "Нова сторінка";
	 imgLang[1].title = "Нова каталог сторінок";
	 imgLang[2].title = "Редагувати каталог";
	 imgLang[3].title = "Показати усі сторінки";

	 txtLang[1].innerHTML = "Відмічені";
	 txtLang[2].innerHTML = "Виводити";
	 txtLang[3].innerHTML = "Не виводити";
	 txtLang[4].innerHTML = "Включити реєстрацію";
	 txtLang[5].innerHTML = "Виключити реєстрацію";
	 txtLang[6].innerHTML = "Перенести до каталогу";
	 txtLang[7].innerHTML = "Додати рекомендовані товари";
	 txtLang[8].innerHTML = "Видалити з бази";
	 txtLang[9].innerHTML = "Каталоги";
	 imgLang[4].title = "Open all";
	 imgLang[5].title = "Close all";
	 break;
  
     case("icon"):
	 icon.img("Каталог");
     icon.img("Замовлення");	
	 icon.img("Звіти");	
	 icon.img("Завантаження прайсу");
	 icon.img("Вивантаження прайсу");
	 icon.img("Системні налаштування");
	 icon.img("Keywords & Titles");
	 icon.img("Реквізити");
	 icon.img("Сторінки");
	 icon.img("Новини");
	 icon.img("Банери");
	 icon.img("Текстові блоки");
	 icon.img("Посилання");
	 icon.img("Опитування");
	 icon.img("Коментарі");
	 icon.img("Користувачі");
	 icon.img("Адміністратори");
	 icon.img("Журнал авторизації");
	 icon.img("Журнал пошуку");
	 icon.img("SQL");
	 icon.img("Резервна копія");
	 icon.img("Магазин");
	 icon.img("Вихід");
	 lang.clean();
	 break;
  
	 case("orders"):
	 d.getElementById("btnShow").value = "Показати";
	 d.getElementById("btnSearch").value = "Пошук";
	 d.getElementById("btnStatus").value = "Показати";
	 lang.img("Електронні платежі");
	 lang.txt();
     txtLang[0].innerHTML = "Статус";
	 d.getElementById("txtLoadExe").innerHTML = "Завантажити Order Agent Windows";
	 d.getElementById("txtLoadExe").title = "Завантажити Order Agent Windows";
	 lang.txt("Відмічені");
	 lang.txt("Видалити з бази");
	 txtLang[3].innerHTML = "Змінити статус";
	 txtLang[4].innerHTML = "Створити новий";
	 txtLang[5].innerHTML = "№ Замовлення";
	 txtLang[6].innerHTML = "Надходження";
	 txtLang[7].innerHTML = "Покупець";
	 txtLang[8].innerHTML = "Кіл-сть";
	 txtLang[9].innerHTML = "Знижка";
	 txtLang[10].innerHTML = "Сума";
	 txtLang[11].innerHTML = "Оброблений";
	 txtLang[12].innerHTML = "Статус";
	 txtLang[13].innerHTML = "Відмічені";
	 
	 break;
	 
	 case("cat_prod"):
	 txtLang[0].innerHTML = "Пошук";
	 document.getElementById("btnShow").value = "Показати";
	 lang.img("Новий каталог");
	 lang.img("Нова позиція");
	 lang.img("Редагувати підкаталог");
	 lang.img("Висновок по всім позиціям");
	 lang.img("Характеристики");
	 lang.img("Підрахунок характеристик");
	 lang.img("Відкрити ВСЕ");
	 lang.img("Закрити ВСЕ");
	 txtLang[1].innerHTML = "Відмічені";
	
	 txtLang[2].label = "Дії";
	 txtLang[3].innerHTML = "Перенести до каталогу";
	 txtLang[4].innerHTML = "Зробити копію";
	 txtLang[5].innerHTML = "Пов'язати зі статтями";
	 txtLang[6].innerHTML = "Пов'язати з характеристиками";
	 txtLang[7].innerHTML = "Експорт в Excel ";
	 txtLang[8].label = "Новинки";
	 txtLang[9].innerHTML = "Додати в новинки";
	 txtLang[10].innerHTML = "Видалити з новинок";
	 
	 txtLang[11].label = "Спеціальна пропозиція";
	 txtLang[12].innerHTML = "Додати до спеціальних пропозицій";
	 txtLang[13].innerHTML = "Видалити зі спеціальних пропозицій";
	 txtLang[14].label = "Висновок";
	 
	 txtLang[15].innerHTML = "Не доступно";
	 txtLang[16].innerHTML = "Доступно";
	 txtLang[17].innerHTML = "Не показувати";
	 txtLang[18].innerHTML = "Показувати";
	 txtLang[19].innerHTML = "Видалити з бази";
	
	 txtLang[20].label = "YML Yandex Маркет";
	 txtLang[21].innerHTML = "Видалити з YML прайсу";
	 txtLang[22].innerHTML = "Додати в YML прайс";
	 txtLang[23].innerHTML = "Відмітити все";
	 txtLang[24].innerHTML = "Зняти відмітки";
	 txtLang[25].innerHTML = "Каталоги";
	
	 lang.clean();
	 break;

   }
   }catch(e){}
   
}
