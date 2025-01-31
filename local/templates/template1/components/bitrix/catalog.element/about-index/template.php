<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$aboutDesigner = $arResult["DISPLAY_PROPERTIES"]["ABOUT_DESIGNER"]["VALUE"]["TEXT"];
$aboutBrand = $arResult["DISPLAY_PROPERTIES"]["ABOUT_BRAND"]["VALUE"]["TEXT"];
?>

<section class="about__info about-info">
    <div class="about-info__wrapper">
        <div class="about-info__content">
            <div class="about-info__block-designer">
                <h2 class="visually-hidden"><?= GetMessage("ABOUT_TITLE_DESIGNER") ?></h2>
                <p class="about-info__text"><?= $aboutDesigner ?></p>
            </div>

            <svg class="about-info__logo" viewBox="0 0 100 50" width="500" height="250"
                 xmlns="http://www.w3.org/2000/svg">
                <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#angelavladi-logo" />
            </svg>

            <div class="about-info__block-brand">
                <h2 class="visually-hidden"><?= GetMessage("ABOUT_TITLE_BRAND") ?></h2>
                <p class="about-info__text"><?= $aboutBrand ?></p>
            </div>
        </div>

        <?php FUNC::includeComponent("slider/slider-about"); ?>
    </div>
</section>
