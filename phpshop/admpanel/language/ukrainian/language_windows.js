
// Объект языка версия 1.0
lang = new Object();
num_txt=0;
num_btn=0;
num_img=0;
error=0;
lang.title = function(txt){// Смена заголовка
             document.title = txt;
             }
lang.txt = function(txt){// Смена текста
            var obj = document.getElementsByName("txtLang");
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
            num_img++;
            }}
lang.clean = function(){// Очищаем переменные
            num_txt=0;
            num_btn=0;
            num_img=0;
            }

message1="Attention! \nGiven operation can lead to loss items.\nyou really wish to execute the given command?";

message2="Attention! \nGiven operation can lead to loss bazy.\nyou really wish to execute the given command?"

// Смена языка
function DoCheckLang(file,enabled){

if(enabled == 1){

try{
  switch(file){

     case("/phpshop/admpanel/order/adm_visitorID.php"):
	 document.title="Editing of the order";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "Замовлення";
	 txtLang[1].innerHTML = "Стан замовлення";
	 txtLang[2].innerHTML = "Основне";
	 txtLang[3].innerHTML = "Кошик";
	 txtLang[4].innerHTML = "Стан замовлення";
	 txtLang[5].innerHTML = "Додаткова інформація по замовленню";
	 txtLang[6].innerHTML = "Покупець"; 
	 
	 txtLang[7].innerHTML = "Адреса доставки"; 
	 txtLang[8].innerHTML = "Термін доставки від"; 
	 txtLang[9].innerHTML = "до"; 
	 
	 txtLang[10].innerHTML = "Телефон"; 
	 txtLang[11].innerHTML = "Оплата"; 
	 txtLang[12].innerHTML = "Компанія"; 
	 txtLang[13].innerHTML = "Документи"; 
	 txtLang[14].innerHTML = "Користувач"; 
	 txtLang[15].innerHTML = "Форма замовлення";
	 txtLang[16].innerHTML = "Артикул";
	 txtLang[17].innerHTML = "Найменування";
	 txtLang[18].innerHTML = "Кількість";
	 txtLang[19].innerHTML = "Сума";
	 txtLang[20].innerHTML = "Всього з урахуванням знижки";
	 txtLang[21].innerHTML = "од.";
	 txtLang[22].innerHTML = "Додати до замовлення";
	 txtLang[23].innerHTML = "ID товару";
	 document.getElementById("btnAdd").value = "Додати";
	 txtLang[24].innerHTML = "Знижка";
	 document.getElementById("btnChange").value = "Змінити";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "Видалити";
	 document.getElementById("btnCancel").value = "Відміна";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_productID.php"):
	 document.title="Редагування замовлення";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "Найменування";
	 txtLang[1].innerHTML = "Зображення";
	 txtLang[2].innerHTML = "Кількість";
	 txtLang[3].innerHTML = "Ціна за од.";
	 txtLang[4].innerHTML = "Сума";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnRemove").value = "Видалити";
	 document.getElementById("btnCancel").value = "Відміна";
	 break;
	 
	 case("/phpshop/admpanel/order/adm_order_deliveryID.php"):
	 document.title="Редагування доставки";
	 var txtLang = document.getElementsByName("txtLang");
	 txtLang[0].innerHTML = "Місто доставки";
	 txtLang[1].innerHTML = "Сума";
	 document.getElementById("btnOk").value = "OK";
	 document.getElementById("btnCancel").value = "Відміна";
	 break;
     
	 case("/phpshop/admpanel/catalog/admin_cat_content.php"):
	 if(document.getElementById("txtLang")){
	 var txtLang = document.getElementsByName("txtLang");
	 var imgLang = document.getElementsByName("imgLang");
	 txtLang[0].innerHTML = "Всього";
	 txtLang[1].innerHTML = "Найменування";
	 txtLang[2].innerHTML = "Ціна";
	 imgLang[0].alt="Доступний";
	 imgLang[1].alt="Ні";
	 imgLang[2].alt="Спеціальна пропозиція";
	 imgLang[3].alt="YML Прайс";
     imgLang[4].alt="Новинки";
	 }
	 break;

     case("/phpshop/admpanel/catalog/adm_catalogID.php"):
	 lang.title("Редагування каталогу");
       lang.txt("Редагування каталогу");
	 lang.txt("Задайте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Детальний опис");
	 lang.txt("Характеристики");
	 lang.txt("Сервери");
	 lang.txt("Заголовки");
	// lang.txt("Дизайн");
	 
	 lang.txt("Назва");
	 lang.txt("Каталог");
	 lang.txt("Сортування");
	 lang.txt("Товарів у довжину");
	 lang.txt("Товарів на сторінці");
	 lang.txt("Сортування товарів");
	 lang.txt("Вивантаження");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Назва для Rambler-покупки");
	 lang.txt("При заповненні поля \"Категорія товарної пропозиції\" слід використовувати назви зі списку категорій площадки Pokupki.rambler.ru");
     lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.txt("Використовувати дизайн");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;

     case("/phpshop/admpanel/catalog/adm_catalog_new.php"):
	 lang.title("Новий каталог");
     lang.txt("Новий каталог");
	 lang.txt("Задайте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Детальний опис");
	  lang.txt("Характеристики");
	 lang.txt("Заголовки");
	 lang.txt("Дизайн");
	 lang.txt("Назва");
	 lang.txt("Каталог");
	 lang.txt("Сортування");
	 lang.txt("Товарів у довжину");
	 lang.txt("Товарів на сторінці");
	 lang.txt("Сортування товарів");
	 lang.txt("Вивантаження");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Назва для Rambler-покупки");
	 lang.txt("При заповненні поля \"Категорія товарної пропозиції\" слід використовувати назви зі списку категорій площадки Pokupki.rambler.ru");
     lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.txt("Використовувати дизайн");
	 lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_product_new.php"):
	 lang.title("Створення нового товару");
	 lang.txt("Створення нового товару");
	 lang.txt("Задайте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зображення");
     lang.txt("Короткий опис");
	 lang.txt("Детальний опис");
	 lang.txt("Статті");
	 lang.txt("Заголовки");
	 lang.txt("Характеристики");
	 lang.txt("Підтипи");
	 lang.txt("Каталог");
	 lang.txt("Ціна");
	 lang.txt("Налаштувати");
	 lang.txt("Артикул");
	 lang.txt("Виводити");
	 lang.txt("Налаштувати");
	 lang.txt("YML прайс");
	 lang.txt("Налаштувати");
	 lang.txt("Найменування товару");
	 lang.txt("Рекомендовані товари для сумісного продажу");
	 lang.txt("Введіть ідентифікатори (ID) товарів через кому");
	 //lang.txt("Scheme");
	 lang.txt("Склад");
	 lang.txt("Вага");
	 lang.txt("Додати зображення до галереї: ");
	 lang.txt("");
	 lang.txt("Стандартні");
	 lang.txt("Галерея");
	 lang.txt("Маленьке");
	 lang.txt("Велике");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Мій шаблон");
	 lang.txt("Ручне коректування");
	 lang.txt("Підтипи товару");
	 lang.txt("Введіть ідентифікатори (ID) товарів через кому без пробілу");
	 lang.txt("Зв'язки");
	 lang.txt("Звичайний товар");
	 lang.txt("Додаткова опція для провідного товару");

	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Скинути");
	 lang.btn("Відміна"); 
	 break;

	 break;
	 
	 case("/phpshop/admpanel/product/adm_productID.php"):
	 lang.title("Редагування товару");
	 lang.txt("Редагування товару");
	 lang.txt("Задайте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зображення");
     lang.txt("Короткий опис");
	 lang.txt("Детальний опис");
	 lang.txt("Статті");
	 lang.txt("Заголовки");
	 lang.txt("Характеристики");
	 lang.txt("Підтипи");
	 lang.txt("Каталог");
	 lang.txt("Ціна");
	 lang.txt("Налаштувати");
	 lang.txt("Артикул");
	 lang.txt("Виводити");
	 lang.txt("Налаштувати");
	 lang.txt("YML прайс");
	 lang.txt("Налаштувати");
	 lang.txt("Найменування товару");
	 lang.txt("Рекоменддовані товари для сумісного продажу");
	 lang.txt("Введіть ідентифікатори (ID) товарів через кому");
	 lang.txt("Схема каталогу");
	 lang.txt("Склад");
	 lang.txt("Вага");
	 lang.txt("Додати зображення до галереї: ");
	 lang.txt("");
	 lang.txt("Стандартні");
	 lang.txt("Галерея");
	 lang.txt("Маленьке");
	 lang.txt("Велике");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Ручне коректування");
	 lang.txt("Мій шаблон");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Ручне коректування");
	 lang.txt("Мій шаблон");
	 lang.txt("Згенерувати автоматично");
	 lang.txt("Ручне коректування");
	 lang.txt("Мій шаблон");
	 lang.txt("Характеристики");
	 lang.txt("Підтипи товару");
	 lang.txt("Введіть ідентифікатори (ID) товарів через кому");
	 lang.txt("Зв'язки");
	 
	 lang.txt("Звичайний товар");
	 lang.txt("Додаткова опція для провідного товару");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Продукт");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Копія");
	 lang.btn("Скинути");
	 lang.btn("Відміна"); 
	 break;
	 
	 case("/phpshop/admpanel/product/adm_price.php"):
	 lang.title("Ціна");
	 lang.txt("Ціна");
	 lang.txt("OK");
	 lang.txt("Відміна");
	 lang.txt("Стара ціна");
	 lang.txt("Ціна 2");
	 lang.txt("Ціна 3");
	 lang.txt("Ціна 4");
	 lang.txt("Ціна 5");
	 lang.txt("Під замовлення");
	 lang.btn("Калькулятор");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_spec.php"):
	 lang.title("Додатковий вивід");
	 lang.txt("Вивід у каталозі");
	 lang.txt("OK");
	 lang.txt("Відміна");
	 lang.txt("Новинки каталогу");
	 lang.txt("Спеціальна пропозиція");
	 lang.txt("по порядку");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_yml.php"):
	 lang.title("YML");
	 lang.txt("Показати в YML");
	 lang.txt("В наявності");
	 lang.txt("Під замовлення");
	 lang.txt("BID");
	 lang.txt("CBID");
	 lang.btn("OK");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/product/adm_calc_sort.php"):
	 lang.title("Калькулятор характеристик");
	 lang.txt("Калькулятор характеристик");
	 lang.txt("Виберіть потрібні характеристики");
	 lang.txt("Табличний запис для завантаження бази через Excel");
	 lang.btn("Порахувати");
	 lang.btn("Копіювати");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messages_content.php"):
	 lang.txt("Дата");
	 lang.txt("Повідомлення");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messages_new.php"):
     lang.title("Створення повідомлення користувау");
	 lang.txt("Створення повідомлення користувау");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Заголовок");
	 lang.txt("Дата");
	 lang.txt("Зміст");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_messagesID.php"):
     lang.title("Редагування повідомлення");
	 lang.txt("Редагування повідомлення");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Заголовок");
	 lang.txt("Дата");
	 lang.txt("Зміст");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 
	 case("/phpshop/admpanel/delivery/admin_delivery_content.php"):
	 
	 lang.txt("Назва/Місто");
	 lang.txt("Вартість");
	 lang.txt("Безкоштовно понад");
	 lang.txt("Сплата за 1 kg");
	 lang.txt("Нова позиція");
	 lang.clean();
	 break;
	 
	 
	 case("/phpshop/admpanel/page/admin_cat_content.php"):
	 lang.txt("Показати");
	 lang.txt("Посилання");
	 lang.txt("Назва");
	 lang.txt("Вартість");
	 lang.clean();
	 break;

	 case("/phpshop/admpanel/page/adm_catalogID.php"):
     lang.title("Редагування каталогу");
	 lang.txt("Редагування каталогу");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Каталог");
	 lang.txt("Текст");
	 lang.txt("Позиція зверху");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_catalog_new.php"):
     lang.title("Створення нового каталогу");
	 lang.txt("Створення нового каталогу");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Каталог");
	 lang.txt("Позиція зверху");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 lang.clean();
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pagesID.php"):
     lang.title("Редагування сторінок");
	 lang.txt("Редагування сторінок");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зміст");
	 lang.txt("Заголовки");
	 lang.txt("Безпека");
	
	 lang.txt("Каталог");
	 lang.txt("Назва");
	 lang.txt("Посилання");
	 lang.txt("Сортування");
	 lang.txt("Рекомендовані товари для сумісного продажу");
	 lang.txt("Введіть ідентификатори (ID) товарів через кому без пробілів");
	 lang.txt("Заголовок");
	 lang.txt("Заголовок");
	 lang.txt("Заголовок");
	 lang.txt("Показати");
	 lang.txt("Лише для зареєстрованих користувачів");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/page/adm_pages_new.php"):
     lang.title("Створення нової сторінки");
	 lang.txt("Створення нової сторінки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зміст");
	 lang.txt("Заголовки");
	 lang.txt("Безпека");
	
	 lang.txt("Каталог");
	 lang.txt("Назва");
	 lang.txt("Посилання");
	 lang.txt("Сортування");
	 lang.txt("Рекомендовані товари для сумісного продажу");
	 lang.txt("Введіть ідентификатори (ID) товарів через кому без пробілів");
	 lang.txt("Заголовок");
	 lang.txt("Заголовок");
	 lang.txt("Заголовок");
	 lang.txt("Показати");
	 lang.txt("Лише для зареєстрованих користувачів");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_newsID.php"):
     lang.title("Редагування новин");
	 lang.txt("Редагування новин");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зміст");
	 lang.txt("Дата");
	 lang.txt("Заголовки");
	 lang.txt("Анонс");
	 lang.txt("Розіслати користувачам");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/news/adm_news_new.php"):
     lang.title("Редагування новин");
	 lang.txt("Редагування новин");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Зміст");
	 lang.txt("Дата");
	 lang.txt("Заголовки");
	 lang.txt("Анонс");
	 lang.txt("Розіслати користувачам");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_banerID.php"):
     lang.title("Редагування банерів");
	 lang.txt("Редагування банерів");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Показувати банер");
	 lang.txt("Приховати банер");
	 lang.txt("Ліміт показів");
	 lang.txt("Обнулити лічильники");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/. Можна вказувати декілька адрес через кому. ");
     lang.txt("Зміст");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/baner/adm_baner_new.php"):
     lang.title("Створення нового банеру");
	 lang.txt("Створення нового банеру");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Показувати банер");
	 lang.txt("Приховати банер");
	 lang.txt("Ліміт показів");
	 lang.txt("Обнулити лічильники");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/.Можна вказувати декілька адрес через кому. ");
     lang.txt("Зміст");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menuID.php"):
     lang.title("Редагування текстового блоку");
	 lang.txt("Редагування текстового блоку");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Позиція");
	 lang.txt("Розміщення");
	 lang.txt("Зліва");
	 lang.txt("Справа");
	 lang.txt("Показувати блок");
	 lang.txt("Приховати блок");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/.Можна вказувати декілька адрес через кому. ");
     lang.txt("Зміст");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/menu/adm_menu_new.php"):
     lang.title("Створення текстового блоку");
	 lang.txt("Створення текстового блоку");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Позиція");
	 lang.txt("Розміщення");
	 lang.txt("Зліва");
	 lang.txt("Справа");
	 lang.txt("Показувати блок");
	 lang.txt("Приховати блок");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/.Можна вказувати декілька адрес через кому. ");
     lang.txt("Зміст");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_links_new.php"):
     lang.title("Створення нового посилання");
	 lang.txt("Створення нового посилання");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Посилання");
	 lang.txt("Показувати посилання");
	 lang.txt("Приховати посилання");
	 lang.txt("Рейтинг посилання");
	 lang.txt("Рейтинг впливає на послідовність розміщення посилань");
	 lang.txt("Зміст");
	 lang.txt("Код кнопки");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/link/adm_linksID.php"):
     lang.title("Редагування посилання");
	 lang.txt("Редагування посилання");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Посилання");
	 lang.txt("Показувати посилання");
	 lang.txt("Приховати посилання");
	 lang.txt("Рейтинг посилання");
	 lang.txt("Рейтинг впливає на послідовність розміщення посилань");
	 lang.txt("Зміст");
	 lang.txt("Кнопка");
	 lang.txt("Код кнопки");
	 lang.btn("ОК");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_oprosID.php"):
     lang.title("Редагування опитувань");
	 lang.txt("Редагування опитувань");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Заголовок");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/. Можна вказувати декілька адрес через кому. ");
	 lang.txt("Опції");
	 lang.txt("Показувати");
	 lang.txt("Приховати");
	 lang.txt("Варіанти відповідей");
	 lang.txt("Голоси");
	 lang.txt("Співвідношення");
	 lang.txt("Обнулити дані");
	 lang.txt("Нова позиція");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_opros_new.php"):
     lang.title("Створення нового опитування");
	 lang.txt("Створення нового опитування");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Заголовок");
	 lang.txt("Прив'язка до сторінки");
	 lang.txt("Приклад: page/, news/. Можна вказувати декілька адрес через кому. ");
	 lang.txt("Опції");
	 lang.txt("Показувати");
	 lang.txt("Приховати");
	 lang.txt("Варіанти відповідей");
	 lang.txt("Голоси");
	 lang.txt("Співвідношення");
	 lang.txt("Обнулити дані");
	 lang.txt("Нова позиція");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_valueID.php"):
     lang.title("Редагування коментарів");
	 lang.txt("Редагування коментарів");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Коментар");
	 lang.txt("Каталог");
	 lang.txt("Голоси");
	 lang.txt("Сортування");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/opros/adm_value_new.php"):
     lang.title("Створення коментаря");
	 lang.txt("Створення коментаря");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Коментар");
	 lang.txt("Каталог");
	 lang.txt("Голоси");
	 lang.txt("Сортування");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbookID.php"):
     lang.title("Редагування відгуків");
	 lang.txt("Редагування відгуків");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Дата");
	 lang.txt("Відправник");
	 lang.txt("Ім'я");
	 lang.txt("Тема");
	 lang.txt("Відгук");
	 lang.txt("Коментар");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/gbook/adm_gbook_new.php"):
     lang.title("Створення нового відгуку");
	 lang.txt("Створення нового відгуку");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Дата");
	 lang.txt("Відправник");
	 lang.txt("Ім'я");
	 lang.txt("Тема");
	 lang.txt("Відгук");
	 lang.txt("Коментар");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_userID.php"):
     lang.title("Редагування адміністратора");
	 lang.txt("Редагування адміністратора");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Опис");
	 lang.txt("Права");
	 lang.txt("Ім'я");
	 lang.txt("Статус");
	 lang.txt("Зробити активним");
	 lang.txt("Зробити неактивним");
	 lang.txt("Зміна доступу");
	 lang.txt("Після зміни паролю перезавантажте браузер для входу з новими даними");
	 lang.txt("Змінити");
	 lang.txt("Розділ");
	 lang.txt("Доступ");
	 lang.txt("Відгуки");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Новини");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Замовлення");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Видалення");
	 lang.txt("Усі замовлення");
	 lang.txt("Адміністратори");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Права");
	 lang.txt("Користувачі");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Каталог");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Видалення");
	 lang.txt("Усі позиції");
	 lang.txt("Звіти");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Підписчики");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Сторінки");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Текстові блоки");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Банери");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Посилання");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Робота з прайсом"); 
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Опитування");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Робота з BD");
	 lang.txt("Редагувати");
	 lang.txt("Управління резервною копією");
	 lang.txt("Налаштування ІМ");
	 lang.txt("Редагувати");
	 lang.txt("Знижки");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Валюти");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Доставка");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати");
	 lang.txt("Клони магазину");
	 lang.txt("Переглядати");
	 lang.txt("Редагувати");
	 lang.txt("Створювати"); 
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_users_new.php"):
     lang.title("Створення нового користувача");
	 lang.txt("Створення нового користувача");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Опис");
	 lang.txt("Ім'я");
	 lang.txt("Статус");
	 lang.txt("Зробити активним");
	 lang.txt("Зробити неактивним");
	 lang.txt("Змінити доступ");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_userID.php"):
     lang.title("Редагування користувача");
	 lang.txt("Редагування користувача");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Статус");
	 lang.txt("Авторизований користувач");
	 lang.txt("Зробити активним");
	 lang.txt("Зробити неактивним");
	 lang.txt("Змінити доступ");
	 lang.txt("Нове замовлення");
	 lang.txt("Особисті дані");
	 lang.txt("Контактна особа");
	 lang.txt("Компанія");
	 lang.txt("ІПН");
	 lang.txt("КПП");
	 lang.txt("Телефон");
	 lang.txt("Адреса");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_users_new.php"):
     lang.title("Створення нового користувача");
	 lang.txt("Створення нового користувача");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Статус");
	 lang.txt("Авторизований користувач");
	 lang.txt("Зробити активним");
	 lang.txt("Зробити неактивним");
	 lang.txt("Змінити доступ");
	 lang.txt("Особисті дані");
	 lang.txt("Контактна особа");
	 lang.txt("Компанія");
	 lang.txt("ІПН");
	 lang.txt("КПП");
	 lang.txt("Телефон");
	 lang.txt("Адреса");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_statusID.php"):
     lang.title("Редагування статусу");
	 lang.txt("Редагування статусу");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Використати");
	 lang.txt("колонку прайсу");
	 lang.txt("Знижка");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/shopusers/adm_status_new.php"):
     lang.title("Створення статусу");
	 lang.txt("Створення статусу");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Використати");
	 lang.txt("колонку прайсу");
	 lang.txt("Знижка");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnalID.php"):
     lang.title("Додавання IP в чорний список");
	 lang.txt("Додавання IP в чорний список");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("IP-адреса буде додана до чорного списку. Користувач з даною адресою не може пройти авторизацію");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/users/adm_jurnal_listlID.php"):
     lang.title("Редагування IP в чорному списку");
	 lang.txt("Редагування IP в чорному списку");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("IP-адреса буде додана до чорного списку. Користувач з даною адресою не може пройти авторизацію");
       lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_preID.php"):
     lang.title("Редагування звіту");
	 lang.txt("Редагування звіту");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Запит");
	 lang.txt("Введіть пошукові слова через кому");
	 lang.txt("ID товару");
	 lang.txt("Введіть ідентифікатори (ID) товрів через кому");
	 lang.txt("Враховувати");
	 lang.txt("Блокувати");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/report/adm_pre_new.php"):
     lang.title("Створення нового звіту");
	 lang.txt("Створення нового звіту");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Запит");
	 lang.txt("Введіть пошукові слова через кому");
	 lang.txt("ID товару");
	 lang.txt("Введіть ідентифікатори (ID) товрів через кому");
	 lang.txt("Враховуватиr");
	 lang.txt("Блокувати");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortID.php"):
     lang.title("Редагування характеристики");
	 lang.txt("Редагування характеристики");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Детальний опис");
	 lang.txt("Налаштування");
	 lang.txt("Підкаталог 3-го рівня");
	 lang.txt("Фільтер");
	 lang.txt("Позиція");
	 lang.txt("Характеристика");
	 lang.txt("Сортування");
	 lang.txt("Нова позиція");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sort_new.php"):
     lang.title("Створення характеристики");
	 lang.txt("Створення характеристики");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Детальний опис");
	 lang.txt("Налаштування");
	 lang.txt("Підкаталог 3-го рівня");
	 lang.txt("Фільтер");
	 lang.txt("Позиція");
	 lang.txt("Характеристика");
	 lang.txt("Сортування");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategoryID.php"):
     lang.title("Редагування групи характеристик");
	 lang.txt("Редагування групи характеристик");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Детальний опис");
	 lang.txt("Позиція");
	 lang.txt("Характеристика");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/sort/adm_sortcategory_new.php"):
     lang.title("Створення групи характеристик");
	 lang.txt("Створення групи характеристик");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Детальний опис");
	 lang.txt("Позиція");
	 lang.txt("Характеристика");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
 
	 case("/phpshop/admpanel/system/adm_system.php"):
     lang.title("Системні налаштування");
	 lang.txt("Налаштування для інтернет-магазину");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Зовнішній вигляд");
	 lang.txt("Вітрина");
	 lang.txt("Ціни");
	 lang.txt("Повідомлення");
	 lang.txt("Оплата");
	 lang.txt("Режими");
	 lang.txt("Мова");
	 lang.txt("Користувачі");
	 lang.txt("Зображення");
	 lang.txt("Скріншот");
	 lang.txt("Кількість позицій на сторінці");
	 lang.txt("Кількість позицій в спецпропозиції");
	 lang.txt("Кількість позицій в новинках");
	 lang.txt("Товарів у довжину для вітрини");
	 lang.txt("Розмір дочірніх вікон збільшити на");
	 lang.txt("якщо інформація не вміщується у вікні");
	 lang.txt("Валюта по замовчуванню");
	 lang.txt("Валюта в рахунку");
	 lang.txt("Валюта для безнального рахунку");
	 lang.txt("Накрутка ціни");
	 lang.txt("Враховувати ПДВ");
	 lang.txt("ПДВ");
	 lang.txt("Показувати стан на складі");
	 lang.txt("Кіл-ть знаків після коми у ціні");
	 lang.txt("Мінімальна сума замовлення");
	 lang.txt("Випливаюче повідомлення про замовлення");
	 lang.txt("Може призвести до уповільнення роботи адміністрування");
	 lang.txt("Час оновлення повідомлення");
	 lang.txt("SMS повідомлення про замовлення");
	 lang.txt("SMS повідомлення про наявність товару користувачам");
	 lang.txt("тільки для авторизованих");
	 lang.txt("Автоматична перевірка оновлень");
	 lang.txt("Готівкою кур'єру");
	 lang.txt("Квитанція банку");
	 lang.txt("Рахунок в банк для організацій");
	
	 lang.txt("Візуальний редактор");
	 lang.txt("включений редактор впливає на швидкість роботи");
	 lang.txt("Режим Multibase");
	 lang.txt("Ідентифікатор в системі Multibase магазина донора");
	 lang.txt("Адміністративна панель");
	 lang.txt("Активація через e-mail");
	 lang.txt("Статус після активації");
	 lang.txt("Авторизований користувач");
	 lang.txt("Зміна дизайну");
	 lang.txt("Автоматична нарізка зображень (Ресайзінг)");
	 lang.txt("Макс. ширина оригіналу");
	 lang.txt("Макс. висота оригіналу");
	 lang.txt("Якість оригіналу");
	 lang.txt("Макс. ширина тумблейну");
	 lang.txt("Макс. висота тумблейну");
	 lang.txt("Якість тумблейну");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_promo.php"):
     lang.title("Промо налаштування");
	 lang.txt("Налаштування для збільшення відвідувань");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Основне");
	 lang.txt("Шаблон каталогу");
	 lang.txt("Шаблон підкаталогу");
	 lang.txt("Шаблон товару");
	 lang.btn("Каталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Товар");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Товар");
	 lang.btn("Загальний");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Каталог");
	 lang.btn("Підкаталог");
	 lang.btn("Товар");
	 lang.btn("Загальний");
	 lang.btn("Авто");
	 lang.btn("Пробіл");
	 lang.btn("Ввести слово");
	 lang.btn("Очистити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_recvizit.php"):
     lang.title("Налаштування реквізитів фірми");
	 lang.txt("Налаштування реквізитів фірми");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва магазину");
	 lang.txt("Власник");
	 lang.txt("Телефони");
	 lang.txt("Е-Mail для замовлень через кому");
	 lang.txt("Назва організації");
	 lang.txt("Юридична адреса");
	 lang.txt("Фізична адреса");
	 lang.txt("ІПН");
	 lang.txt("КПП");
	 lang.txt("№ рахунку організації");
	 lang.txt("Назва банку");
	 lang.txt("БІК");
	 lang.txt("№ банківського рахунку");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discountID.php"):
     lang.title("Редагування знижки");
	 lang.txt("Редагування знижки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Сума");
	 lang.txt("Сума встановлена в ");
	 lang.txt("Знижка");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/discount/adm_discount_new.php"):
     lang.title("Створення нової знижки");
	 lang.txt("Створення нової знижки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Сума");
	 lang.txt("Сума встановлена в ");
	 lang.txt("Знижка");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
       lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valutaID.php"):
     lang.title("Редагування валюти");
	 lang.txt("Редагування валюти");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Позначення");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Код ISO");
	 lang.txt("Курс");
	 lang.txt("Порядок");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_valuta_new.php"):
     lang.title("Створення нової валюти");
	 lang.txt("Створення нової валюти");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Позначення");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Код ISO");
	 lang.txt("Курс");
	 lang.txt("Порядок");
     lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_deliveryID.php"):
     lang.title("Редагування доставки");
	 lang.txt("Редагування доставки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Каталог");
	 lang.txt("Назва");
	 lang.txt("По замовчуванню");
	 lang.txt("Ціна");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Безкоштовна доставка");
	 lang.txt("Від суми понад");
	 lang.txt("Розраховувати доставку за кожні 0,5 кг ваги (щоб використати вкажіть значення більше 0)");
	 lang.txt("Кожні додаткові 0,5 кг зверху базових 0,5 кг коштуватимуть");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_delivery_new.php"):
     lang.title("Створення нової доставки");
	 lang.txt("Створення нової доставки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("По замовчуванню");
	 lang.txt("Ціна");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
	 lang.txt("Безкоштовна доставка");
	 lang.txt("Від суми понад");
	 lang.txt("Розраховувати доставку за кожні 0,5 кг ваги (щоб використати вкажіть значення більше 0)");
	 lang.txt("Кожні додаткові 0,5 кг зверху базових 0,5 кг коштуватимуть");
     lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_catalog_new.php"):
     lang.title("Створення нової категорії доставки");
	 lang.txt("Створення нової категорії доставки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Каталог");
	 lang.txt("Назва");
	 lang.txt("По замовчуванню");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
     lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/delivery/adm_catalogID.php"):
     lang.title("Редагування каталогу доставки");
	 lang.txt("Редагування каталогу доставки");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Каталог");
	 lang.txt("Назва");
	 lang.txt("По замовчуванню");
	 lang.txt("Враховувати");
	 lang.txt("Так");
	 lang.txt("Ні");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_servers_new.php"):
     lang.title("Створення нового клону");
	 lang.txt("Створення нового клону");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Хост");
	 lang.txt("Активний");
	 lang.txt("Неактивний");
     lang.btn("Скинути");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/servers/adm_serversID.php"):
     lang.title("Редагування клону");
	 lang.txt("Редагування клону");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Назва");
	 lang.txt("Хост");
	 lang.txt("Активний");
	 lang.txt("Неактивний");
     lang.btn("Видалити");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/system/adm_system_docsstyle.php"):
     lang.title("Документообіг");
	 lang.txt("Документообіг");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Логотип");
	 lang.txt("Рекламний блок");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/window/adm_window.php"):
     lang.title("Дії");
	 lang.txt("Дії");
	 lang.txt("Визначте дані для запису в базу");
	 lang.txt("Ви впевнені, що бажаєте");
	 try{
	 lang.txt("");
	 lang.txt("");
	 }catch(e){}
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/dumper/dumper.php"):
     lang.title("Робота з базою");
	 lang.txt("Робота з базою");
	 lang.txt("Вкажіть команди для БД");
	 lang.txt("Створити резервну копію БД");
	 lang.txt("БД");
	 lang.txt("Фільтр таблиць");
	 lang.txt("Метод стискування");
	 lang.txt("Ступень стискування");
	 lang.txt("Відновлення БД з резервної копії");
	 lang.txt("БД");
	 lang.txt("Файл");
	 lang.btn("Відміна");
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql.php"):
     lang.title("Робота з базою");
	 lang.txt("Робота з базою");
	 lang.txt("Вкажіть команди для  MySQL");
	 try{
	 lang.txt("Вибрати команду sql");
	 lang.txt("Оптимізувати базу");
	 lang.txt("Відремонтувати базу");
	 lang.txt("Видалити каталог");
	 lang.txt("Видалити сторінку");
	 lang.txt("Очистити базу");
	 lang.txt("Знищити базу");
	 lang.btn("Завантажити з файлу");
	 lang.btn("Скинути");
	 lang.btn("Відміна");

	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "Назад";
	 btnLang2[1].value = "Відміна";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/sql/adm_sql_file.php"):
     lang.title("Робота з базою");
	 lang.txt("Робота з базою");
	 lang.txt("Вкажіть команди для  MySQL");
	 try{
	 lang.txt("Завантаження SQL");
	 lang.txt("Виберіть файл з розширенням");
	 lang.btn("Виконати SQL команду");
	 lang.btn("Скинути");
	 lang.btn("Відміна");
	 }catch(e){}
	 
	 try{
	 var txtLang2 = document.getElementsByName("btnLang2");
	 btnLang2[0].value = "Назад";
	 btnLang2[1].value = "Відміна";
	 }catch(e){}
	 break;
	 
	 case("/phpshop/admpanel/window/adm_about.php"):
	 lang.title("Про програму");
	 lang.txt("Про програму");
	 lang.txt("Версії модулів та ліцензійна угода");
	 lang.txt("Модуль");
	 lang.txt("Версія");
	 lang.txt("Підтримка");
	 lang.txt("Дата");
	 lang.txt("Закінчення");
	 lang.txt("Пролонгація технічної підтримки");
	 lang.txt("Підтримка");
	 lang.txt("Я приймаю умови ліцензійної угоди");
	 lang.btn("Закрити");
	 
	 break;
   }
     }catch(e){alert("The translation engine has informed about shortages of an element.\nTransfer can be not full!");}
}}
 