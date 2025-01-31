<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
        return;
}

if ($arResult["NavPageCount"] == 1) return;

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"] . "&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?" . $arResult["NavQueryString"] : "");
$firstPage = 1;
$currentPage = $arResult["NavPageNomer"];
$lastPage = $arResult["NavPageCount"];

if ($currentPage == $firstPage) {
    $beginPage = $firstPage;
} elseif ($currentPage == $lastPage) {
    $beginPage = $lastPage - 2;

    if ($beginPage < $firstPage) {
        $beginPage = $firstPage;
    }
} else {
    $beginPage = $currentPage - 1;
}

$countShow = 3;
$i = 0;
$urlPath = $arResult["sUrlPath"];
$strNavQueryString = $arResult["NavQueryString"];
$url = preg_replace("/([0-9].*)\//", "", $APPLICATION->GetCurDir());
$params = "";

if ($strNavQueryString) {
    $params = "?" . $strNavQueryString;
};

$page_url = explode('/', $_SERVER['REQUEST_URI']);
?>

<section class="page__pagination pagination">
    <div class="pagination__wrapper">
        <ul class="pagination__list">
            <?php if ($firstPage + 1 <= $beginPage) {
                echo "<li class='pagination__item'><a href='$url' class='pagination__link link'>$firstPage</a></li>";
                if ($firstPage + 1 < $beginPage) {
                    echo "<li class='pagination__item'><span class='pagination__dots'>...</span></li>";
                }
            }

            while (($i < $countShow)
                && (($beginPage + $i) <= $lastPage)) {
                $urlShow = ($beginPage + $i == $firstPage) ? $url . $params : $url . ($beginPage + $i) . "/" . $params;
                $pageShow = $beginPage + $i;
                $classShow = "pagination__link link" . ($pageShow == $currentPage ? ' pagination__link--active' : '');

                if ($pageShow == $currentPage) {
                    echo "<li class='pagination__item'><span class='$classShow'>$pageShow</span></li>";
                } else {
                    echo "<li class='pagination__item'><a href='$urlShow' class='$classShow'>$pageShow</a></li>";
                }
                $i++;
            }

            $beginPage += $countShow;
            if ($beginPage < $lastPage) {
                echo "<li class='pagination__item'><span class='pagination__dots'>...</span></li>";
                echo "<li class='pagination__item'><a href='$url$lastPage/$params' class='pagination__link link'>$lastPage</a></li>";
            }

            if ($beginPage == $lastPage) {
                echo "<li class='pagination__item'><a href='$url$lastPage/$params' class='pagination__link link'>$lastPage</a></li>";
            } ?>
        </ul>
    </div>
</section>