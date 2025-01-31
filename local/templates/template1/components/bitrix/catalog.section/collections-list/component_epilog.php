<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();

if ($arResult['PAGEN'] > $arResult['NavPageCount']) {
    LocalRedirect("/404/");
}

if ($arResult['NavPageCount'] > 1) {
    $pageGen = intval($_REQUEST["PAGEN_1"]) ?: 1;
    $titlePagen = " | Страница $pageGen";
}

$APPLICATION->SetPageProperty("title", $arResult["NAME"] . " | AngelaVladi - дизайнерская одежда г. Краснодар" . $titlePagen);
$APPLICATION->SetPageProperty("description", "Коллекции дизайнерской одежды, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle($arResult['NAME']);
$APPLICATION->AddChainItem($arResult['NAME']);
