<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>

<div class="cookie-notification cookie-notification--hide">
    <div class="cookie-notification__wrapper">
        <p class="cookie-notification__text">
            <?= GetMessage('COOKIE_TEXT') ?>
        </p>

        <button class="button button--cookie" type="button" data-agree>
            <?= GetMessage('COOKIE_BUTTON_AGREE') ?>
        </button>
    </div>
</div>