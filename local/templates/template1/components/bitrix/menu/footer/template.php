<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<?php if (!empty($arResult)): ?>
    <ul class="footer-navigation__list">
        <?php foreach ($arResult as $arItem):
            $link = $arItem["LINK"];
            $text = $arItem["TEXT"];
            ?>
            <li class="footer-navigation__item <?php if ($arItem["SELECTED"]): ?>footer-navigation__item--current<?php endif; ?>">
                <?php if (!$arItem["SELECTED"] || ($link === '/catalog/' || $link === '/collections/')): ?>
                    <a class="footer-navigation__link link" href="<?= $link ?>"><?= $text ?></a>
                <?php else: ?>
                    <span class="footer-navigation__link link"><?= $text ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
