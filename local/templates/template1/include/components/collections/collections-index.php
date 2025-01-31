<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "collections-index",
    array(
        "ADD_SECTIONS_CHAIN" => "N",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COUNT_ELEMENTS" => "Y",
        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
        "FILTER_NAME" => "sectionsFilter",
        "IBLOCK_ID" => COLLECTIONS_IBLOCK_ID,
        "IBLOCK_TYPE" => "catalog",
        "SECTION_CODE" => LANGUAGE_ID,
        "SECTION_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_ID" => "",
        "SECTION_URL" => "#SECTION_CODE#",
        "SECTION_USER_FIELDS" => array(
            0 => "",
            1 => "",
        ),
        "SHOW_PARENT_NAME" => "Y",
        "TOP_DEPTH" => "2",
        "VIEW_MODE" => "LINE",
        "COMPONENT_TEMPLATE" => "catalog-index"
    ),
    false
);?>
