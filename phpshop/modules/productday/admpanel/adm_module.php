<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.productday.productday_system"));

// Функция обновления
function actionUpdate() {
    global $PHPShopModules,$PHPShopOrm;
    
    // Настройки витрины
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);
    
    if($_POST['time_new']>24 or empty($_POST['time_new']))
        $_POST['time_new'] = 24;

    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id='.$_GET['id']);
    return $action;
}


function actionStart() {
    global $PHPShopGUI,$PHPShopOrm;
    
     //Выборка
    $data = $PHPShopOrm->select();
    
    $Tab1 = $PHPShopGUI->setField('Час окончания акции', $PHPShopGUI->setInputText(false, 'time_new', $data['time'],50),2,'Час в формате 1-24');
    
    $info = '<p>Модуль выводит товар дня на страницы сайта на сутки. При редактирование товара возможно установить галочку в закладке <kbd>Товар дня</kbd></p>
    <p>Для вывода блока на страницу используйте метку <mark>@productDay@</mark></p>';

    $Tab2 = $PHPShopGUI->setInfo($info);



    // Вывод формы закладки
    $PHPShopGUI->setTab(array("Основное", $Tab1,true), array("Инструкция", $Tab2),array("О Модуле", $PHPShopGUI->setPay()));

    // Вывод кнопок сохранить и выход в футер
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "Применить", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// Обработка событий 
$PHPShopGUI->getAction();

// Вывод формы при старте
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>