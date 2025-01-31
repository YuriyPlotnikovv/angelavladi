<?php if (!defined('B_PROLOG_INCLUDED') || (B_PROLOG_INCLUDED !== true)) die();
$APPLICATION->SetPageProperty("title", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"]);
$APPLICATION->SetPageProperty("keywords", $arResult["IPROPERTY_VALUES"]["ELEMENT_META_KEYWORDS"]);
$APPLICATION->SetPageProperty("description", FUNC::getSeoDesc($arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]));

$APPLICATION->SetTitle($arResult['NAME']);
$APPLICATION->AddChainItem($arResult['SECTION']['NAME'], $arResult["SECTION"]['SECTION_PAGE_URL']);
$APPLICATION->AddChainItem($arResult['NAME']);
