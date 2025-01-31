<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$textDetail = $arResult["DETAIL_TEXT"];
$orderCatalog = $arResult["DISPLAY_PROPERTIES"]["ORDER_CATALOG"]["VALUE"]["TEXT"];
$orderSelf = $arResult["DISPLAY_PROPERTIES"]["ORDER_SELF"]["VALUE"]["TEXT"];
$orderCollections = $arResult["DISPLAY_PROPERTIES"]["ORDER_COLLECTIONS"]["VALUE"]["TEXT"];
$orderFitting = $arResult["DISPLAY_PROPERTIES"]["ORDER_FITTING"]["VALUE"]["TEXT"];
?>

<section class="order__instructions instructions">
    <div class="instructions__wrapper">
        <p class="instructions__main-text"><?= $textDetail ?></p>

        <ul class="instructions__list">
            <li class="instructions__item">
                <p class="instructions__text">
                    <?= $orderCatalog ?>
                </p>
            </li>

            <li class="instructions__item">
                <p class="instructions__text">
                    <?= $orderSelf ?>
                </p>
            </li>

            <li class="instructions__item">
                <p class="instructions__text">
                    <?= $orderCollections ?>
                </p>
            </li>
        </ul>
    </div>
</section>

<section class="order__fitting fitting">
    <div class="fitting__wrapper">
        <h2 class="fitting__title"><?= GetMessage("ORDER_TITLE_FITTING") ?></h2>

        <p class="fitting__text"><?= $orderFitting ?></p>
    </div>
</section>
