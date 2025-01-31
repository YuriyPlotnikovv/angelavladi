<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();

if (count($arResult['ITEMS']) === 0) {
    LocalRedirect(SITE_DIR);
}

$cp = $this->__component;
if (is_object($cp)) {
    $cp->arResult['NavPageCount'] = $arResult['NAV_RESULT']->NavPageCount;
    $cp->arResult['PAGEN'] = $arResult['NAV_RESULT']->PAGEN;
    $cp->SetResultCacheKeys(['NavPageCount', 'PAGEN']);
}