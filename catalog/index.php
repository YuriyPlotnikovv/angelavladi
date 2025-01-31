<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог | AngelaVladi - дизайнерская одежда г. Краснодар");
$APPLICATION->SetPageProperty("description", "Каталог дизайнерской одежды, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle("Каталог");
?>

<?php FUNC::includeComponent("catalog/catalog-index"); ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>