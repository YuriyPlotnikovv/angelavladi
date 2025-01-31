<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();?>

<header class="page__header header">
    <div class="header__wrapper">
        <?php if (PAGE_TYPE === "main"): ?>
            <span class="header__logo-link">
                <span class="visually-hidden"><?= GetMessage("PAGE_MAIN") ?></span>

                <svg class="header__logo" viewBox="0 0 100 50" width="150" height="75"
                     xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#angelavladi-logo"/>
                </svg>
            </span>
        <?php else: ?>
            <a href="/" class="header__logo-link link">
                <span class="visually-hidden"><?= GetMessage("PAGE_MAIN") ?></span>

                <svg class="header__logo" viewBox="0 0 100 50" width="150" height="75"
                     xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#angelavladi-logo"/>
                </svg>
            </a>
        <?php endif; ?>
        <nav class="header__navigation navigation">
            <button class="navigation__button button button--menu" type="button">
                <span class="visually-hidden"><?= GetMessage("MENU_BUTTON") ?></span>
            </button>

            <?php FUNC::includeComponent('navigation-header'); ?>
        </nav>

        <?php if (PAGE_TYPE !== 'contacts'): ?>
            <div class="header__social social">
                <?php FUNC::includeFile("blocks/social"); ?>
            </div>
        <?php endif; ?>
    </div>
</header>

