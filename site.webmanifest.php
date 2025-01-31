<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
header("Content-Type: application/manifest+json;charset=UTF-8");
?>
{
"name": "<?= GetMessage("COMPANY_NAME") ?>",
"short_name": "<?= GetMessage("COMPANY_SHORT_NAME") ?>",
"icons": [
{
"src": "/android-chrome-192x192.png",
"sizes": "192x192",
"type": "image/png"
},
{
"src": "/android-chrome-512x512.png",
"sizes": "512x512",
"type": "image/png"
}
],
"display": "standalone"
}


