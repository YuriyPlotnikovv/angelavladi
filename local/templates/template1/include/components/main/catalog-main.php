<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$GLOBALS['sectionsFilter'] = Array("UF_SHOW_ON_MAIN" => true);

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "catalog-main",
    array(
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "Y",
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
        "FILTER_NAME" => "sectionsFilter",
        "IBLOCK_ID" => CATALOG_IBLOCK_ID,
        "IBLOCK_TYPE" => "catalog",
        "SECTION_CODE" => LANGUAGE_ID,
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_ID" => "",
        "SECTION_URL" => "#CODE#",
        "SECTION_USER_FIELDS" => array(
            0 => "UF_SHOW_ON_MAIN",
            1 => "",
        ),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "2",
        "VIEW_MODE" => "LINE",
        "COMPONENT_TEMPLATE" => "catalog-main"
    ),
    false
);?>
