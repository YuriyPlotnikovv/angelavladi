<?php
require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/core/ReCaptcha_v3.php");

$captchaPublicKey = (new ReCaptcha_v3())->getPublicKey();

echo json_encode(array("publicKey" => $captchaPublicKey));
