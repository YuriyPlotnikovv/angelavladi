<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="catalog__products products">
    <div class="products__wrapper">
        <ul class="products__list">
            <?php foreach ($arResult['ITEMS'] as $item):
                $name = $item['NAME'];
                $price = FUNC::getFormattedPrice($item['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']);
                $link = $item["DETAIL_PAGE_URL"];
                $gallery = $item["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"];
                $colors = $item['DISPLAY_PROPERTIES']['COLORS']["VALUE"];
                ?>
                <li class="products__item card">
                    <div class="card__slider slider slider-card swiper-container" data-pagination>
                        <ul class="slider__list swiper-wrapper">
                            <?php foreach ($gallery as $item):
                                if ($item["CONTENT_TYPE"] === "video/mp4") continue;
                                ?>
                                <li class="slider__item slider-card__item swiper-slide">
                                    <?= GetPicture::getMarkup(
                                        (int)$item["ID"],
                                        ImageViewConfig::getMediaScreenParamsCatalogCards(),
                                        $name,
                                        'slider__picture',
                                        'slider__image',
                                        true,
                                        ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                                    ) ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="slider__pagination slider-pagination"></div>
                    </div>

                    <div class="card__content">
                        <h3 class="card__title"><?= $name ?></h3>

                        <?php if ($colors): ?>
                            <ul class="card__colors colors">
                                <?php foreach ($colors as $key => $color):
                                    $propertyName = FUNC::getFeatures(2);
                                    $currentColor = $propertyName[$color]["UF_COLOR_CODE"];
                                    $name = $propertyName[$color]["UF_NAME"];
                                    ?>
                                    <li class="colors__item" style="background-color: <?= $currentColor ?>">
                                        <span class="visually-hidden"><?= $name ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <div class="card__price">
                            <span class="card__price-label">от</span>
                            <span class="card__price-value"><?= $price ?></span>

                            <a href="<?= $link ?>" class="card__link button button--card"><?= GetMessage("MORE") ?></a>
                        </div>

                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
</section>

<?= $arResult['NAV_STRING'] ?>
