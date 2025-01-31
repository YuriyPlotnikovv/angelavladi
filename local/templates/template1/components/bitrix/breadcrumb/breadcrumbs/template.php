<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();
global $APPLICATION;

if (empty($arResult)) return '';

$itemsToShowCount = 2;

$strReturn = '<ul class="page__breadcrumbs breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';

$arResultCount = count($arResult);
$previousLevel = $arResultCount - $itemsToShowCount;
for ($i = $previousLevel, $itemPropPosition = 1; $i < $arResultCount; $i++, $itemPropPosition++) {
    $title = htmlspecialcharsex($arResult[$i]["TITLE"]);
    $link = $arResult[$i]["LINK"];

    $contentMetaName = $title;

    if ($i == ($arResultCount - 1) || !$link) {
        $strReturn .=
            '<li class="breadcrumbs__item breadcrumbs__item--current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span class="breadcrumbs__link" itemprop="item" href=' . $link . ' title=' . $title . '>
                    ' . $title . '
                    <meta itemprop="name" content=' . $contentMetaName . '>
                    <meta itemprop="position" content=' . $itemPropPosition . '>
                </span>
            </li>';
    } else {
        $strReturn .=
            '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope
                itemtype="https://schema.org/ListItem">
                <a class="breadcrumbs__link link" itemprop="item" href=' . $link . ' title=' . $title . '>
                    ' . $title . '
                    <meta itemprop="name" content=' . $contentMetaName . '>
                    <meta itemprop="position" content=' . $itemPropPosition . '>
                </a>
            </li>';
    }
}

$strReturn .= '</ul>';
return $strReturn;



