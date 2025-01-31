<?php
require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/core/form-helper.php");

$helper = new FormHelper("12", "NEW_REQUEST", "NAME", true);
$helper->help();