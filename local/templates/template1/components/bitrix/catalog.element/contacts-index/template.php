<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$textDetail = $arResult["DETAIL_TEXT"];
?>

<section class="contacts__info contacts-info">
    <div class="contacts-info__wrapper">
        <p class="contacts-info__text"><?= $textDetail ?></p>

        <ul class="contacts-info__phone-list">
            <li class="contacts-info__phone-item">
                <a href="tel:" class="contacts-info__phone-link link"><?= GetMessage("PHONE") ?></a>
            </li>

            <li class="contacts-info__phone-item">
                <a href="tel:" class="contacts-info__phone-link link"><?= GetMessage("PHONE2") ?></a>
            </li>
        </ul>

        <?php FUNC::includeFile("blocks/social"); ?>
    </div>
</section>

<?php FUNC::includeFile("form/request"); ?>

<section class="contacts__map map">
    <div class="map__wrapper" id="map"></div>
</section>