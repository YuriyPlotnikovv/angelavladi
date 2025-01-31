<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Коллекции | AngelaVladi - дизайнерская одежда г. Краснодар");
$APPLICATION->SetPageProperty("description", "Коллекции дизайнерской одежды, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle("Коллекции");
?>

<?php FUNC::includeComponent("collections/collections-index"); ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>