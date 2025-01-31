<?php
AddEventHandler("main", "OnBeforeProlog", array("SiteLanguage", "includeLangFile"));

class SiteLanguage
{
    public static function includeLangFile()
    {
        global $APPLICATION;
        $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/lang/ru/template.php");

    }
}

class FUNC
{
    public static function includeFile($name, $lang = false, $params = array())
    {
        global $APPLICATION;
        $name = (stripos($name, ".php") !== false) ? $name : $name . ".php";
        $path = ($lang) ? LANGUAGE_ID . "/" . $name : $name;
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            array(
                "AREA_FILE_SHOW" => "file",
                "PATH" => SITE_TEMPLATE_PATH . "/include/" . $path,
                "AREA_FILE_SUFFIX" => "",
                "EDIT_TEMPLATE" => "",
                "PARAMS" => $params
            ),
            false,
            array(
                "HIDE_ICONS" => "Y"
            )
        );
    }

    public static function includeComponent($name, $params = false)
    {
        FUNC::includeFile("components/$name", false, $params);
    }

    public static function getFormattedPrice($price)
    {
        $int = preg_replace('~\D+~', '', $price);
        return number_format((float)$int, 0, "", " ");
    }

    public static function getDataSliderDetail($galleryId, $iblockId)
    {
        $arFilter = ['IBLOCK_ID' => $iblockId, 'SECTION_ID' => $galleryId, 'ACTIVE' => 'Y'];
        $arSelect = ['IBLOCK_ID', 'ID', 'NAME', 'DETAIL_PICTURE', 'PROPERTY_*'];
        $res = CIBlockElement::GetList(["sort" => "asc"], $arFilter, false, [], $arSelect);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $arProperties = $ob->GetProperties();
            $arData[] = [
                'PICTURE_ID' => $arFields['DETAIL_PICTURE'],
                'PICTURE_ALT' => $arProperties['ALT_' . strtoupper(LANGUAGE_ID)]['VALUE']
            ];
        }
        unset($arFilter, $arSelect, $res, $ob, $arFields, $arProperties);

        return $arData;
    }

    public static function getSeoDesc($desc)
    {
        $limit = 150;

        if (mb_strlen($desc) <= $limit) {
            $result = $desc;
        } else {
            $lastSpacePosition = mb_strrpos(mb_substr($desc, 0, $limit), ' ');
            $result = trim(mb_substr($desc, 0, $lastSpacePosition), '.,;&+-\/?!') . '.';
        }

        return $result;
    }

    public static function getFeatures($id)
    {
        $features = array();
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($id)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();
        $rsData = $entity_data_class::getList(array(
            'select' => array('*')
        ));
        while ($obData = $rsData->fetch()) {
            $features[$obData["UF_XML_ID"]] = array(
                "UF_NAME" => $obData["UF_NAME"],
                "UF_COLOR_CODE" => $obData["UF_COLOR_CODE"],
            );
        }
        unset($hlblock, $entity_data_class, $rsData, $obData);
        return $features;
    }
}