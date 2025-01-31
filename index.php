<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?>

    <?php FUNC::includeComponent("slider/slider-main");?>

    <?php FUNC::includeComponent("main/catalog-main");?>

    <?php FUNC::includeComponent("main/about-main");?>

    <?php FUNC::includeComponent("slider/slider-promo");?>

    <?php FUNC::includeComponent("main/order-main");?>

    <?php
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');
    ?>