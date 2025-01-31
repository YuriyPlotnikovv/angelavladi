<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$this->setFrameMode(true);
?>

<div class="detail__slider slider-about">
    <div class="slider-about__wrapper slider slider-images swiper-container" data-with-thumbs>
        <ul class="slider__list swiper-wrapper">
            <?php foreach ($arResult['CURRENT_ELEMENT']['ITEMS'] as $item):
                $image = $item['DETAIL_PICTURE']['ID'];
                $name = $item['NAME'];
                ?>
                <li class="slider__item slider-images__item swiper-slide">
                    <?= GetPicture::getMarkup(
                        (int)$image,
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

    <div class="slider-about__wrapper slider slider-thumbs swiper-container" data-thumb>
        <ul class="slider__list swiper-wrapper">
            <?php foreach ($arResult['CURRENT_ELEMENT']['ITEMS'] as $item):
                $image = $item['DETAIL_PICTURE']['ID'];
                $name = $item['NAME'];
                ?>
                <li class="slider__item slider-thumbs__item swiper-slide">
                    <?= GetPicture::getMarkup(
                        (int)$image,
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
