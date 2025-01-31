<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/core/ReCaptcha_v3.php");
CModule::IncludeModule("iblock");

header('Content-Type: application/json');

class FormHelper {
    const STATE_NO_DATA = "NO_DATA";
    const STATE_VALIDATION_ERROR = "VALIDATION_ERROR";
    const STATE_SAVE_ERROR = "SAVE_ERROR";
    const STATE_RECAPTCHA_ERROR = "RECAPTCHA_ERROR";
    const STATE_SUCCESS = "SUCCESS";
    const LINK_TEMPLATE = "/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=%s&type=%s&ID=%s";

    private $iblockId = null;
    private $sectionId = null;
    private $event = null;
    private $data = null;
    private $fields = null;
    private $elementNameFieldCode = null;
    private $newItemId = null;
    private $useCaptcha = null;
    private $isCaptchaPassed = null;

    function __construct ($iblockId, $event = "", $elementNameFieldCode = "", $useCaptcha = false) {
        $this->iblockId = $iblockId;
        $this->sectionId = self::getIBlockSection($iblockId);
        $this->event = $event;
        $this->elementNameFieldCode = $elementNameFieldCode;
        $this->useCaptcha = $useCaptcha;
        $this->fields = self::getIBlockFields($this->iblockId);
        $this->data = self::getData();
        $this->verifyCaptcha();
        $this->clearData();
    }

    private function verifyCaptcha() {
        if ($this->useCaptcha) {
            $captcha = new ReCaptcha_v3();
            $this->isCaptchaPassed = $captcha->verify($this->data['RECAPTCHARESPONSE']);
        }
    }

    private static function getIBlockSection($iblockId) {
        $sections = CIBlockSection::GetList(
            array("sort" => "asc"),
            array("IBLOCK_ID" => $iblockId, "CODE" => LANGUAGE_ID)
        );

        $section = $sections->GetNext();

        return ($section) ? $section["ID"] : null;
    }

    private static function respond($success, $code) {
        echo(json_encode(array(
            "success" => $success,
            "state" => $code
        )));

        return $success;
    }

    private static function getData() {
        $data = $_POST;

        if ($data != null) {
            $data = array_change_key_case($data, CASE_UPPER);
        }

        return $data;
    }

    private static function clearString($string) {
        $string = preg_replace("/<[^>]*>/", " ", $string);
        $string = preg_replace("/(\r\n|\n)+/", "\r\n\r\n", $string);
        $string = trim(preg_replace("/ {2,}/", " ", $string));

        return $string;
    }

    private static function getIBlockFields($iblockId) {
        $response = CIBlock::GetProperties($iblockId);
        $fields = array();

        while ($field = $response->Fetch()) {
            $fields[] = $field;
        }

        return $fields;
    }

    public function help() {
        if ($this->data == null) {
            return self::respond(false, self::STATE_NO_DATA);
        }

        if ($this->useCaptcha && (isset($this->isCaptchaPassed) && !$this->isCaptchaPassed)) {
            return self::respond(false, self::STATE_RECAPTCHA_ERROR);
        }

        if (!($this->validateRequired() && $this->validateData())) {
            return self::respond(false, self::STATE_VALIDATION_ERROR);
        }

        $this->prepare();

        if ($this->newItemId = $this->save()) {

            self::respond(true, self::STATE_SUCCESS);

            if ($this->event) {
                $this->triggerPostEvent();
            }

            return true;
        } else {
            return self::respond(false, self::STATE_SAVE_ERROR);
        }
    }

    private function clearData() {
        $cleared = array();

        foreach ($this->data as $key => $dataField) {
            foreach ($this->fields as $field) {
                if ($key == $field["CODE"]) {
                    if (is_numeric($dataField)) {
                        $cleared[$key] = (string)$dataField;
                    }

                    if (is_string($dataField)) {
                        $dataField = self::clearString($dataField);
                        $cleared[$key] = $dataField;
                    }
                }
            }
        }

        $this->data = $cleared;
    }

    private function getElementLink()
    {
        $server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://";
        $element = new CIBlockElement;

        if ($result = $element->GetById($this->newItemId)) {
            $iblock = CIBlock::GetByID($this->iblockId)->GetNext();

            $link = $server . SITE_SERVER_NAME . sprintf(self::LINK_TEMPLATE, $this->iblockId, $iblock["IBLOCK_TYPE_ID"], $this->newItemId);
            return $link;
        }

        return false;
    }

    private function validateRequired() {
        foreach ($this->fields as $field) {
            $found = false;

            if ($field["IS_REQUIRED"] == "Y") {
                foreach ($this->data as $dataKey => $dataField) {
                    if ($dataKey == $field["CODE"]) {
                        $found = true;
                    }
                }
            } else {
                $found = true;
            }

            if (!$found) {
                return false;
            }
        }

        return true;
    }

    private function validateData() {
        foreach ($this->data as $dataKey => $dataField) {
            $correct = false;

            foreach ($this->fields as $field) {
                if ($dataKey == $field["CODE"]) {
                    if ($field["IS_REQUIRED"] == "Y") {
                        if ($dataField) {
                            $correct = true;
                            break;
                        }
                    } else {
                        $correct = true;
                        break;
                    }
                }
            }

            if (!$correct) {
                return false;
            }
        }

        return true;
    }

    private function prepare() {
        foreach ($this->fields as $field) {
            // замена типа строка на html
            if ($field["USER_TYPE"] == "HTML") {
                $this->data[$field["CODE"]] = array("VALUE" => array("TEXT" => $this->data[$field["CODE"]]));
            }
        }
    }

    private function save() {
        try {
            $date = date("j.m.Y H:i:s", time());

            $name = ($this->elementNameFieldCode) ? $this->data[$this->elementNameFieldCode] . " - " . $date : $date;

            $element = new CIBlockElement;

            $arElement = array(
                "IBLOCK_ID" => $this->iblockId,
                "IBLOCK_SECTION_ID" => $this->sectionId,
                "ACTIVE" => "N",
                "NAME" => $name,
                "DATE_ACTIVE_FROM" => $date,
                "PROPERTY_VALUES" => $this->data
            );

            return $element->Add($arElement);
        } catch (Exception $e) {
            return false;
        }
    }

    private function triggerPostEvent() {
        $link = $this->getElementLink();

        CEvent::send($this->event, "s1", array_merge($this->data, array("LINK" => $link)));
    }
}