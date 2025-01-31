<?php
routing();

function routing()
{
    global $APPLICATION;

    try {
        $routing = json_decode(file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/routing.json"), true);
        if (!$routing) {
            setDefaultRoutes();
            return;
        }

    } catch (Exception $e) {
        setDefaultRoutes();
        return;
    }

    $dir = $APPLICATION->GetCurDir();
    $file = $APPLICATION->GetCurPage(true);
    $class = $routing["default"]["class"];
    $type = $routing["default"]["type"];
    $subtype = $routing["default"]["subtype"];

    foreach ($routing["rules"] as $rule) {
        $fileMatch = $file == $rule["file"];
        $dirMatch = $dir == $rule["dir"];
        $recursiveDirMatch = ($rule["recursive"] && stripos($dir, $rule["dir"]) === 0);

        if ($rule["exclude_root"] && $dirMatch) {
            $dirMatch = false;
            $recursiveDirMatch = false;
        }

        $ruleMatch = preg_match($rule["rule"], $dir);

        if ($fileMatch || $dirMatch || $recursiveDirMatch || $ruleMatch) {
            if ($rule["class"]) {
                $class = $rule["class"];
            }
            ("class: " . $rule["type"] . "<br><br>");
            if ($rule["type"]) {
                $type = $rule["type"];
            }
            if ($rule["subtype"]) {
                $subtype = $rule["subtype"];
            }
            foreach ($rule["page_properties"] as $key => $value) {
                $APPLICATION->SetPageProperty($key, $value);
            }
        }
    }

    if (defined('ERROR_404') && ERROR_404 == 'Y') {
        $subtype = "404";
        $type = $routing["default"]["type"];
    }

    $class .= " type-" . $type;
    if ($subtype) {
        $class .= " type-" . $subtype;
    }

    define("PAGE_CLASS", $class);
    define("PAGE_TYPE", $type);
    define("PAGE_SUBTYPE", $subtype);
}

function setDefaultRoutes()
{
    define("PAGE_CLASS", "");
    define("PAGE_TYPE", "");
    define("PAGE_SUBTYPE", "");
    define("PAGE_IMAGE", "");
}
