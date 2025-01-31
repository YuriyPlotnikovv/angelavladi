<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты | AngelaVladi - дизайнерская одежда г. Краснодар");
$APPLICATION->SetPageProperty("description", "Контакты дизайнера AngelaVladi, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle("Контакты");
?>

<?php FUNC::includeComponent("pages/contacts-index"); ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>