<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
    "PATH" => "",
    "SITE_ID" => "",
    "START_FROM" => "0",
    "COMPONENT_TEMPLATE" => "universal"
),
    false
);
