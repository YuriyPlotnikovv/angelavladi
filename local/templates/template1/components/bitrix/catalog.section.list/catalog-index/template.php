<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="catalog__sections sections">
    <div class="sections__wrapper">
        <ul class="sections__list">
            <?php foreach ($arResult['SECTIONS'] as $item):
                $image = $item['PICTURE']['ID'];
                $name = $item['NAME'];
                $link = '/catalog/' . $item['SECTION_PAGE_URL'] . "/";
                ?>
                <li class="sections__item">
                    <a href="<?= $link ?>" class="sections__item-link link">
                        <h3 class="sections__item-title"><?= $name ?></h3>

                        <?= GetPicture::getMarkup(
                            (int)$image,
                            ImageViewConfig::getMediaScreenParamsCatalogSections(),
                            $name,
                            'sections__item-picture',
                            'sections__item-image',
                            true,
                            ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE
                        ) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
