<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$textAnnounce = $arResult["PREVIEW_TEXT"];
?>

<section class="main__order main-order">
    <div class="main-order__wrapper">
        <h2 class="main-order__title"><?= GetMessage("MAIN_PAGE_ORDER_TITLE") ?></h2>

        <p class="main-order__text"><?= $textAnnounce ?></p>

        <a href="/order/" class="main-order__link button button--link"><?= GetMessage("MORE") ?></a>
    </div>
</section>
