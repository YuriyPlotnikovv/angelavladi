<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "О нас | AngelaVladi - дизайнерская одежда г. Краснодар");
$APPLICATION->SetPageProperty("description", "О нас, дизайнерская одежда AngelaVladi на заказ по вашим меркам и эскизам в г. Краснодар.");
$APPLICATION->SetTitle("О нас");
?>

<?php FUNC::includeComponent("pages/about-index"); ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>