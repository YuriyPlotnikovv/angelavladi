<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$textAnnounce = $arResult["PREVIEW_TEXT"];
?>

<section class="main__info main-info">
    <div class="main-info__wrapper">
        <h2 class="visually-hidden"><?= GetMessage("MAIN_PAGE_ABOUT_TITLE") ?></h2>

        <p class="main-info__text"><?= $textAnnounce ?></p>

        <svg class="main-info__logo" viewBox="0 0 482 255" width="400" height="200"
             xmlns="http://www.w3.org/2000/svg">
            <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#angelavladi-logo"/>
        </svg>

        <a href="/about/" class="main-info__link button button--link"><?= GetMessage("MORE") ?></a>
    </div>
</section>
