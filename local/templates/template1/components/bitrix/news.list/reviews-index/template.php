<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<section class="reviews__comments comments">
    <ul class="comments__list">
        <?php foreach ($arResult['ITEMS'] as $item):
            $name = $item["DISPLAY_PROPERTIES"]["NAME"]["VALUE"];
            $date = $item["DISPLAY_ACTIVE_FROM"];
            $text = $item["DISPLAY_PROPERTIES"]["MESSAGE"]["VALUE"]["TEXT"];
            ?>
            <li class="comments__item comments-item">
                <div class="comments-item__wrapper">
                    <span class="comments-item__name"><?= $name ?></span>
                    <span class="comments-item__date"><?= $date ?></span>
                </div>

                <p class="comments-item__text"><?= $text ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?= $arResult['NAV_STRING'] ?>

<?php FUNC::includeFile("form/review"); ?>
