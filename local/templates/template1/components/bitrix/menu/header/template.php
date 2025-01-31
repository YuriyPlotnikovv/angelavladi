<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<?php if (!empty($arResult)): ?>
    <ul class="navigation__list navigation__list--hidden">
        <?php foreach ($arResult as $arItem):
            $link = $arItem["LINK"];
            $text = $arItem["TEXT"];
            ?>
            <li class="navigation__item <?php if ($arItem["SELECTED"]): ?>navigation__item--current<?php endif; ?>">
                <?php if (!$arItem["SELECTED"] || ($link === '/catalog/' || $link === '/collections/')): ?>
                    <a class="navigation__link link" href="<?= $link ?>"><?= $text ?></a>
                <?php else: ?>
                    <span class="navigation__link link"><?= $text ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
