<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$countSections = 0;
?>

<section class="main__catalog main-catalog">
    <div class="main-catalog__wrapper">
        <h2 class="visually-hidden"><?= GetMessage("PAGE_ABOUT") ?></h2>
        <ul class="main-catalog__list">
            <?php foreach ($arResult['SECTIONS'] as $item):
                $image = $item['PICTURE']['ID'];
                $name = $item['NAME'];
                $link = '/catalog/' . $item['SECTION_PAGE_URL'] . "/";

                if ($countSections === 6) break;
                ?>
                <li class="main-catalog__item">
                    <a href="<?= $link ?>" class="main-catalog__item-link link">
                        <h3 class="main-catalog__item-title"><?= $name ?></h3>

                        <?= GetPicture::getMarkup(
                            (int)$image,
                            ImageViewConfig::getMediaScreenParamsCatalogMain(),
                            $name,
                            'main-catalog__item-picture',
                            'main-catalog__item-image',
                            true,
                            ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                        ) ?>
                    </a>
                </li>
                <?php $countSections++ ?>
            <?php endforeach; ?>
        </ul>

        <a href="/catalog/" class="main-catalog__link button button--link"><?= GetMessage("MAIN_PAGE_CATALOG_BUTTON") ?></a>
    </div>
</section>
