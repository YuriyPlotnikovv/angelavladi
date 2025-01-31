<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Как заказать? | AngelaVladi - дизайнерская одежда г. Краснодар");
$APPLICATION->SetPageProperty("description", "Как заказать дизайнерскую одежду, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle("Как заказать?");
?>

<?php FUNC::includeComponent("pages/order-index"); ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>