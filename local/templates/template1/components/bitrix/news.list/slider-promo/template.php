<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="page__slider slider-promo">
    <div class="slider-promo__wrapper slider swiper-container" data-slides data-autoplay>
        <h2 class="slider-promo__title"><?= GetMessage("SLIDER_PROMO_TITLE") ?></h2>
        <ul class="slider-promo__list slider__list swiper-wrapper">
            <?php foreach ($arResult['ITEMS'] as $item):
                $name = $item['NAME'];
                $price = $item['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE'];
                $link = $item["DETAIL_PAGE_URL"];
                $colors = $item['DISPLAY_PROPERTIES']['COLORS']["VALUE"];
                $gallery = $item["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"];
                ?>
                <li class="slider-promo__item card slider__item swiper-slide">
                    <div class="card__slider slider slider-card swiper-container" data-pagination>
                        <ul class="slider__list swiper-wrapper">
                            <?php foreach ($gallery as $item):
                                if ($item["CONTENT_TYPE"] === "video/mp4") continue;
                                ?>
                                <li class="slider__item slider-card__item swiper-slide">
                                    <?= GetPicture::getMarkup(
                                        (int)$item["ID"],
                                        ImageViewConfig::getMediaScreenParamsSliderPromo(),
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
                            <span class="card__price-label"><?= GetMessage("FROM") ?></span>

                            <span class="card__price-value"><?= $price ?></span>

                            <a href="<?= $link ?>" class="card__link button button--card"><?= GetMessage("MORE") ?></a>
                        </div>

                    </div>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
</section>
