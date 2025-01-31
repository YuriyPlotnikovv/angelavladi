<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die(); ?>

<footer class="page__footer footer">
    <div class="footer__wrapper">
        <div class="footer__contacts-wrapper">
            <div class="footer__social social">
                <?php FUNC::includeFile("blocks/social"); ?>
            </div>

            <div class="footer__contacts footer-contacts">
                <ul class="footer-contacts__list">
                    <li class="footer-contacts__item phone">
                        <a href="tel:" class="footer-contacts__link link"><?= GetMessage("PHONE") ?></a>
                    </li>

                    <li class="footer-contacts__item phone">
                        <a href="tel:" class="footer-contacts__link link"><?= GetMessage("PHONE2") ?></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer__navigation footer-navigation">
            <?php FUNC::includeComponent('navigation-footer'); ?>

            <?php FUNC::includeComponent("footer-catalog-sections"); ?>
        </div>

        <div class="footer__info footer-info">
            <a class="footer-info__docs link" href="/upload/docs/privacy-policy.pdf" target="_blank">Политика конфиденциальности</a>

            <span class="footer-info__copyright"><?= GetMessage("COPYRIGHT") ?></span>

            <a href="https://yuriyplotnikovv.ru/" class="footer-info__developer link">
                <span class="footer-info__text"><?= GetMessage("DEVELOPER") ?></span>

                <svg class="footer-info__logo" viewBox="0 0 50 50" width="30" height="30"
                     xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#developer-logo"/>
                </svg>
            </a>

            <a href='https://icons8.com' class="footer-info__icons link">
                <span class="footer-info__text"><?= GetMessage("ICONS") ?></span>

                <svg class="footer-info__logo" viewBox="0 0 50 50" width="30" height="30"
                     xmlns="http://www.w3.org/2000/svg">
                    <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#icons-author"/>
                </svg>
            </a>
        </div>
    </div>
</footer>

