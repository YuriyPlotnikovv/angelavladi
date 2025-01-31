<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "footer",
    array(
        "ALLOW_MULTI_SELECT" => "N",    // Разрешить несколько активных пунктов одновременно
        "CHILD_MENU_TYPE" => "section",    // Тип меню для остальных уровней
        "DELAY" => "N",    // Откладывать выполнение шаблона меню
        "MAX_LEVEL" => "1",    // Уровень вложенности меню
        "MENU_CACHE_GET_VARS" => "",    // Значимые переменные запроса
        "MENU_CACHE_TIME" => "3600",    // Время кеширования (сек.)
        "MENU_CACHE_TYPE" => "A",    // Тип кеширования
        "MENU_CACHE_USE_GROUPS" => "N",    // Учитывать права доступа
        "CACHE_SELECTED_ITEMS" => "N",    // Определяет подмешивать или нет URL в кеш
        "MENU_CACHE_USE_USERS" => "N",    // Определяет подмешивать ли в кеш id пользователя
        "ROOT_MENU_TYPE" => "top",    // Тип меню для первого уровня
        "USE_EXT" => "Y",    // Подключать файлы с именами вида .тип_меню.menu_ext.php
        "COMPONENT_TEMPLATE" => "footer",
        "MENU_THEME" => "site"
    ),
    false
);

