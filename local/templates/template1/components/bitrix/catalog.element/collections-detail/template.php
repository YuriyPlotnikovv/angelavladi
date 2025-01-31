<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$name = $arResult['NAME'];
$description = $arResult['DETAIL_TEXT'];
$price = FUNC::getFormattedPrice($arResult['DISPLAY_PROPERTIES']['PRICE']['DISPLAY_VALUE']);
$colors = $arResult['DISPLAY_PROPERTIES']['COLORS']["VALUE"];
$gallery = $arResult["DISPLAY_PROPERTIES"]["GALLERY"]["FILE_VALUE"];
$poster = $arResult["DISPLAY_PROPERTIES"]["VIDEO_POSTER"]["FILE_VALUE"];
?>

<section class="detail__content">
    <div class="detail__wrapper">
        <div class="detail__slider slider-detail">
            <div class="slider-detail__wrapper slider slider-images swiper-container" data-with-thumbs data-gallery>
                <ul class="slider__list swiper-wrapper">
                    <?php foreach ($gallery as $item):
                        $class = $item["CONTENT_TYPE"] === "video/mp4" ? "slider-images__item--video" : "slider-images__item--photo";
                        $file = $item["CONTENT_TYPE"] === "video/mp4" ? $poster["ID"] : $item["ID"];
                        ?>
                        <li class="slider__item slider-images__item <?= $class ?> swiper-slide"
                            <?php if ($item["CONTENT_TYPE"] === "video/mp4"): ?>
                                data-video='{"source": [{"src":"<?= $item["SRC"] ?>", "type":"video/mp4"}], "attributes": {"preload": true, "loop": true, "playsinline": true, "controls": true}}'
                                data-thumb="<?= $poster['SRC'] ?>"
                            <?php else: ?>
                                data-src="<?= $item['SRC'] ?>"
                                data-thumb="<?= $item['SRC'] ?>"
                            <?php endif; ?>
                        >
                            <?= GetPicture::getMarkup(
                                (int)$file,
                                ImageViewConfig::getMediaScreenParamsDetailSlider(),
                                $name,
                                'slider__picture',
                                'slider__image',
                                true,
                                ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                            ) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="slider-detail__wrapper slider slider-thumbs swiper-container" data-thumb>
                <ul class="slider__list swiper-wrapper">
                    <?php foreach ($gallery as $item):
                        $file = $item["CONTENT_TYPE"] === "video/mp4" ? $poster["ID"] : $item["ID"];
                        ?>
                        <li class="slider__item slider-thumbs__item swiper-slide">
                            <?= GetPicture::getMarkup(
                                (int)$file,
                                ImageViewConfig::getMediaScreenParamsDetailSliderThumbs(),
                                $name,
                                'slider__picture',
                                'slider__image',
                                true,
                                ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                            ) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>


        <div class="detail__content-wrapper">
            <h2 class="detail__title"><?= $name ?></h2>

            <p class="detail__text"><?= $description ?></p>

            <div class="detail__consist consist">
                <h3 class="consist__title"><?= GetMessage("CATALOG_MATERIALS_TITLE") ?></h3>

                <ul class="consist__list">
                    <?php foreach ($arResult['DISPLAY_PROPERTIES']['CONSIST']["VALUE"] as $key => $consistItem):
                        ?>
                        <li class="consist__item"><?= $consistItem ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="detail__colors colors-detail">
                <h3 class="colors-detail__title"><?= GetMessage("CATALOG_COLORS_TITLE") ?></h3>

                <?php if ($colors): ?>
                    <ul class="colors-detail__colors colors">
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
            </div>

            <div class="detail__price price-detail">
                <h3 class="price-detail__title"><?= GetMessage("CATALOG_PRICE_TITLE") ?></h3>

                <div class="price-detail__wrapper">
                    <span class="price-detail__label"><?= GetMessage("FROM") ?></span>

                    <span class="price-detail__value"><?= $price ?></span>
                </div>
            </div>

            <a href="/order/" class="detail__link button button--link"><?= GetMessage("CATALOG_ORDER_BUTTON") ?></a>
        </div>
    </div>
</section>
