<?php
require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/core/form-helper.php");

$helper = new FormHelper("10", "NEW_REVIEW", "NAME", true);
$helper->help();