<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();
$assets = \Bitrix\Main\Page\Asset::getInstance();
?>
<!DOCTYPE html>
<html class="page" lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1.0">

    <title><?php $APPLICATION->ShowTitle() ?></title>

    <?php
    if (!$USER->IsAdmin()) {
        $APPLICATION->ShowMeta('keywords');
        $APPLICATION->ShowMeta('description');
    } else {
        $APPLICATION->ShowHead();
    }
    ?>

    <link rel="preload" href="<?= SITE_TEMPLATE_PATH ?>/public/fonts/ProximaNova-Bold.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= SITE_TEMPLATE_PATH ?>/public/fonts/ProximaNova-Light.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= SITE_TEMPLATE_PATH ?>/public/fonts/ProximaNova-LightIt.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= SITE_TEMPLATE_PATH ?>/public/fonts/ProximaNovaCond-Black.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
    <link rel="preload" href="<?= SITE_TEMPLATE_PATH ?>/public/fonts/Orpheus-Bold.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">

    <link rel="apple-touch-icon" href="/apple-touch-icon-180x180.png?v=1.0.0">
    <link rel="icon" href="/icon.svg?v=1.0.0" type="image/svg+xml">
    <link rel="icon" href="/favicon.ico?v=1.0.0">
    <link rel="manifest" href="/site.webmanifest?v=1.0.0">
    <meta name="application-name" content="<?= GetMessage("COMPANY_NAME") ?>">

    <?php
    $assets->addCss(SITE_TEMPLATE_PATH . STYLE_VENDOR_PUBLIC_PATH . 'swiper.min.css');

    if (PAGE_TYPE === 'about' || PAGE_SUBTYPE === 'detail') {
        $assets->addCss(SITE_TEMPLATE_PATH . STYLE_VENDOR_PUBLIC_PATH . 'lightgallery.min.css');
    }

    $assets->addCss(SITE_TEMPLATE_PATH . STYLE_PUBLIC_PATH . 'style.min.css');

    $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'swiper-bundle.min.js');

    if (PAGE_TYPE === 'about' || PAGE_SUBTYPE === 'detail') {
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'lightgallery.min.js');
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'lg/lg-thumbnails.min.js');
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'lg/lg-video.min.js');
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'lg/lg-zoom.min.js');
    }

    if (PAGE_TYPE === 'contacts' || PAGE_TYPE === 'reviews') {
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'vue.min.js');
        $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_VENDOR_PUBLIC_PATH . 'v-mask.min.js');
    }

    if (PAGE_TYPE === 'contacts') {
        $assets->addJs("https://api-maps.yandex.ru/v3/?apikey=a10be16e-88ea-49a6-9493-f04cac85ef58&lang=ru_RU");
    }

    $assets->addJs(SITE_TEMPLATE_PATH . SCRIPT_PUBLIC_PATH . 'script.min.js');

    $APPLICATION->ShowCSS(true);
    $APPLICATION->ShowHeadStrings();
    $APPLICATION->ShowHeadScripts();
    ?>
</head>

<body class="page__body">
<?php
if ($USER->IsAdmin()) {
    $APPLICATION->ShowPanel();
}

FUNC::includeFile('header');
?>

<main class="page__main <?= PAGE_CLASS ?>">
    <?php if (PAGE_TYPE !== "main"): ?>
        <?php FUNC::includeFile('page-heading'); ?>
    <?php else: ?>
        <h1 class="visually-hidden"><?= GetMessage("MAIN_PAGE") ?></h1>
    <?php endif; ?>
