<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus('404 Not Found');
@define('ERROR_404', 'Y');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetTitle(GetMessage('PAGE_NOT_FOUND'));
$APPLICATION->AddChainItem('404', '/404');
?>

<section class="page__not-found not-found">
    <svg class="not-found__logo" viewBox="0 0 500 500" width="500" height="500" xmlns="http://www.w3.org/2000/svg">
        <use xlink:href="<?= SITE_TEMPLATE_PATH ?>/public/images/sprite.svg#404" />
    </svg>
</section>

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');