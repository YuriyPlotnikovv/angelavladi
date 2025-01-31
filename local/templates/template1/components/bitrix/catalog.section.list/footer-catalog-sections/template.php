<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

$countSections = 0;
?>

<ul class="footer-navigation__list footer-navigation__list--desktop">
    <?php foreach ($arResult['SECTIONS'] as $item):
        $name = $item['NAME'];
        $link = '/catalog/' . $item['SECTION_PAGE_URL'] . '/';

        if ($countSections === 6) break;
        ?>
        <li class="footer-navigation__item">
            <a href="<?= $link ?>" class="footer-navigation__link link"><?= $name ?></a>
        </li>
        <?php $countSections++ ?>
    <?php endforeach; ?>
</ul>
