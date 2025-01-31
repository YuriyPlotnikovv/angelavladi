<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="main__slider-main slider-main">
    <h2 class="visually-hidden"><?= GetMessage("MAIN_PAGE_SLIDER_TITLE") ?></h2>
    <div class="slider-main__wrapper slider swiper-container" data-autoplay data-navigation>

        <ul class="slider__list swiper-wrapper">
            <?php foreach ($arResult['CURRENT_ELEMENT']['ITEMS'] as $item):
                $image = $item['DETAIL_PICTURE']['ID'];
                $name = $item['NAME'];
                $text = $item['PREVIEW_TEXT'];
                $link = $item['DISPLAY_PROPERTIES']['LINK']['DISPLAY_VALUE'];
                ?>
                <li class="slider__item swiper-slide">
                    <h3 class="visually-hidden"><?= $name ?></h3>

                    <?= GetPicture::getMarkup(
                        (int)$image,
                        ImageViewConfig::getMediaScreenParamsSliderMain(),
                        $name,
                        'slider__picture',
                        'slider__image',
                        true,
                        ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                    ) ?>

                    <?php if ($text || $link): ?>
                        <div class="slider__content slider-content">
                            <?php if ($text): ?>
                                <p class="slider-content__text"><?= $text ?></p>
                            <?php endif; ?>

                            <?php if ($link): ?>
                                <a href="<?= $link ?>" class="slider-content__link button button--card"><?= GetMessage("MORE") ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="slider__navigation slider-navigation">
            <div class="slider-navigation__button button button--left">
                <span class="visually-hidden"><?= GetMessage("SLIDER_BUTTON_LEFT") ?></span>
            </div>

            <div class="slider-navigation__button button button--right">
                <span class="visually-hidden"><?= GetMessage("SLIDER_BUTTON_RIGHT") ?></span>
            </div>
        </div>
    </div>
</section>
