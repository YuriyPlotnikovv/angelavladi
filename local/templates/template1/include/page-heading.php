<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();
$this->setFrameMode(true);
?>

<section class="page__heading heading">
    <div class="heading__wrapper">
        <h1 class="heading__title"><?php $APPLICATION->ShowTitle(false) ?></h1>

        <?php FUNC::includeComponent('breadcrumbs');?>
    </div>
</section>
