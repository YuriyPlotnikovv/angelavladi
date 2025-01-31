<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();

$arResult['CURRENT_ELEMENT'] = [
    'ITEMS' => $arResult['ITEMS'],
    'IS_SLIDER' => isset($arResult['ITEMS'][1]),
];

$cp = $this->__component;
if (is_object($cp)) {
    $cp->SetResultCacheKeys(['CURRENT_ELEMENT']);
}