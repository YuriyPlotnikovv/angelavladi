<?php

class ImageViewConfig
{
    private const IMAGE_QUALITY_AFTER_COMPRESSION = 85;
    private const IMAGE_SCREEN_WIDTH_FOR_RETINA_MIN = 413;
    private const IMAGE_MOBILE_SIZES = 320;
    private const IMAGE_TABLET_SIZES = 769;
    private const IMAGE_DESKTOP_SIZES = 1280;

    private const MEDIA_SCREEN_PARAMS_SLIDER_MAIN = [
        self::IMAGE_MOBILE_SIZES => [768, 500],
        self::IMAGE_TABLET_SIZES => [1279, 500],
        self::IMAGE_DESKTOP_SIZES => [1920, 600]
    ];
    private const MEDIA_SCREEN_PARAMS_CATALOG_MAIN = [
        self::IMAGE_MOBILE_SIZES => [365, 200],
        self::IMAGE_TABLET_SIZES => [200, 250],
        self::IMAGE_DESKTOP_SIZES => [300, 300]
    ];
    private const MEDIA_SCREEN_PARAMS_SLIDER_PROMO = [
        self::IMAGE_MOBILE_SIZES => [330, 250],
        self::IMAGE_TABLET_SIZES => [375, 250],
        self::IMAGE_DESKTOP_SIZES => [330, 250]
    ];
    private const MEDIA_SCREEN_PARAMS_CATALOG_SECTIONS = [
        self::IMAGE_MOBILE_SIZES => [300, 150],
        self::IMAGE_TABLET_SIZES => [300, 300],
        self::IMAGE_DESKTOP_SIZES => [300, 300]
    ];
    private const MEDIA_SCREEN_PARAMS_CATALOG_CARDS = [
        self::IMAGE_MOBILE_SIZES => [230, 230],
        self::IMAGE_TABLET_SIZES => [230, 230],
        self::IMAGE_DESKTOP_SIZES => [230, 230]
    ];
    private const MEDIA_SCREEN_PARAMS_DETAIL_SLIDER = [
        self::IMAGE_MOBILE_SIZES => [720, 400],
        self::IMAGE_TABLET_SIZES => [560, 600],
        self::IMAGE_DESKTOP_SIZES => [885, 600]
    ];
    private const MEDIA_SCREEN_PARAMS_DETAIL_SLIDER_THUMBS = [
        self::IMAGE_MOBILE_SIZES => [200, 100],
        self::IMAGE_TABLET_SIZES => [150, 150],
        self::IMAGE_DESKTOP_SIZES => [170, 150]
    ];
    final public static function getImageQualityAfterCompression(): int
    {
        return self::IMAGE_QUALITY_AFTER_COMPRESSION;
    }

    final public static function getMediaScreenParamsRetinaMin(): int
    {
        return self::IMAGE_SCREEN_WIDTH_FOR_RETINA_MIN;
    }

    final public static function getMediaScreenParamsSliderMain(): array
    {
        return self::MEDIA_SCREEN_PARAMS_SLIDER_MAIN;
    }
    final public static function getMediaScreenParamsCatalogMain(): array
    {
        return self::MEDIA_SCREEN_PARAMS_CATALOG_MAIN;
    }
    final public static function getMediaScreenParamsSliderPromo(): array
    {
        return self::MEDIA_SCREEN_PARAMS_SLIDER_PROMO;
    }
    final public static function getMediaScreenParamsCatalogSections(): array
    {
        return self::MEDIA_SCREEN_PARAMS_CATALOG_SECTIONS;
    }
    final public static function getMediaScreenParamsCatalogCards(): array
    {
        return self::MEDIA_SCREEN_PARAMS_CATALOG_CARDS;
    }
    final public static function getMediaScreenParamsDetailSlider(): array
    {
        return self::MEDIA_SCREEN_PARAMS_DETAIL_SLIDER;
    }
    final public static function getMediaScreenParamsDetailSliderThumbs(): array
    {
        return self::MEDIA_SCREEN_PARAMS_DETAIL_SLIDER_THUMBS;
    }
}

class ImageLazyLoadType
{
    public const LAZY_LOAD_TYPE_NATIVE = 'native';
    public const LAZY_LOAD_TYPE_CUSTOM = 'custom';
    public const LAZY_LOAD_TYPE_NATIVE_DISABLE = 'no_lazy';

    public static function getAllTypes(): array
    {
        return [
            self::LAZY_LOAD_TYPE_NATIVE,
            self::LAZY_LOAD_TYPE_CUSTOM
        ];
    }
}

class ImageWebp
{
    private const IMAGE_TYPE_JPEG = 'jpg';
    private const IMAGE_TYPE_PNG = 'png';

    public static function get(string $fileMimeType, string $fileName, string $filePath, string $rootPath): string
    {
        $imageType = self::getType($fileMimeType);
        if (!$imageType) {
            return '';
        }

        $webpImageFileName = self::getWebpImageFileName($imageType, $fileName);
        $webpImagePath = str_replace($fileName, $webpImageFileName, $filePath);
        $webpImagePhysicalPath = $rootPath . $webpImagePath;

        if (!file_exists($webpImagePhysicalPath)) {
            $imageResource = self::createImageResource($imageType, $rootPath . $filePath);
            $webpImageCreateResult = imagewebp($imageResource, $webpImagePhysicalPath, ImageViewConfig::getImageQualityAfterCompression());
            imagedestroy($imageResource);
            $webpImagePath = ($webpImageCreateResult) ? $webpImagePath : '';
        }

        return $webpImagePath;
    }

    private static function getType(string $fileMimeType): ?string
    {
        if ($fileMimeType === 'image/jpeg') {
            $type = self::IMAGE_TYPE_JPEG;
        } elseif ($fileMimeType === 'image/png') {
            $type = self::IMAGE_TYPE_PNG;
        }

        return $type ?? null;
    }

    private static function getWebpImageFileName(string $imageType, string $fileName): ?string
    {
        $webpImageFileName = '';
        if ($imageType === self::IMAGE_TYPE_JPEG) {
            $webpImageFileName = str_replace('jpeg', 'webp', strtolower($fileName));
            $webpImageFileName = str_replace('jpg', 'webp', strtolower($webpImageFileName));
        } elseif ($imageType === self::IMAGE_TYPE_PNG) {
            $webpImageFileName = str_replace('png', 'webp', strtolower($fileName));
        }

        return $webpImageFileName;
    }

    private static function createImageResource(string $imageType, string $fileFullPath)
    {
        if ($imageType === self::IMAGE_TYPE_JPEG) {
            $image = imagecreatefromjpeg($fileFullPath);
        } elseif ($imageType === self::IMAGE_TYPE_PNG) {
            $image = imagecreatefrompng($fileFullPath);
        }

        return $image ?? null;
    }
}

class PictureMarkup
{
    /**
     * @var string
     */
    private string $alt;

    /**
     * @var string
     */
    private string $imageClass;

    /**
     * @var string
     */
    private string $lazyLoadType;

    /**
     * @var bool
     */
    private bool $useMiniature;

    public function __construct(string $alt, string $imageClass, string $lazyLoadType, bool $useMiniature)
    {
        $this->alt = $alt;
        $this->imageClass = $imageClass;
        $this->lazyLoadType = $lazyLoadType;
        $this->useMiniature = $useMiniature;
    }

    final public function getImgMarkup(
        string $imgSourceSrc1x,
        string $imgSourceSrc2x,
        int $width,
        int $height,
        string $imgMiniatureSrc
    ): string
    {
        $result = "<img src='";
        $result .= ($this->lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_CUSTOM && $this->useMiniature && $imgMiniatureSrc !== '') ?
            $imgMiniatureSrc :
            $imgSourceSrc1x;
        $result .= "' srcset='" . $imgSourceSrc2x . " 2x' ";
        $result .= ($this->lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_CUSTOM) ?
            "data-lazyload='" . $imgSourceSrc1x . "' " : '';
        $result .= ($this->imageClass !== '') ? "class='{$this->imageClass}' " : '';
        $result .= "alt='{$this->alt}' ";
        $result .= "width='{$width}' height='{$height}' decoding='async' ";
        $result .= ($this->lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE) ? "loading='lazy' " : '';
        $result .= ">";

        return $result;
    }

    final public function getSourceMarkup(
        string $imgSourceSrc1x,
        string $imgSourceSrc2x,
        string $addString,
        string $imgMiniatureSrc
    ): string
    {
        $result = '<source ' . $addString . ' ';
        $result .= ($this->lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_CUSTOM) ?
            "data-lazyload='" . $imgSourceSrc1x . " 1x, " . $imgSourceSrc2x . " 2x' " : '';
        $result .= "srcset='";
        $result .= ($this->lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_CUSTOM && $this->useMiniature && $imgMiniatureSrc !== '') ?
            $imgMiniatureSrc :
            $imgSourceSrc1x;
        $result .= " 1x, ";
        $result .= $imgSourceSrc2x;
        $result .= " 2x'>";

        return $result;
    }
}

class GetPicture
{
    private const LAZY_LOAD_MINIATURE_WIDTH = 50;
    private const LAZY_LOAD_MINIATURE_HEIGHT = 30;

    private const USE_MINIATURE_DEFAULT_VALUE = true;
    private const LAZY_LOAD_TYPE_DEFAULT_VALUE = ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE;

    private const IMAGE_PIXELS_RATIO_DEFAULT = 1;
    private const IMAGE_PIXELS_RATIO_FOR_RETINA = 2;

    /**
     * @param int $imageId
     * @param array<int,array<int,int|null>> $media
     * @param string|null $alt
     * @param string|null $imageClass
     * @param string|null $pictureClass
     * @param bool|null $useMiniature
     * @param string|null $lazyLoadType
     * @param int|null $resizeType
     * @return string
     */
    public static function getMarkup(
        int    $imageId,
        array  $media,
        string $alt = null,
        string $pictureClass = null,
        string $imageClass = null,
        bool   $useMiniature = null,
        string $lazyLoadType = null,
        ?int   $resizeType = BX_RESIZE_IMAGE_EXACT
    ): string
    {
        if (!$imageId) {
            return '';
        }

        $pictureMarkup = new PictureMarkup(
            !is_null($alt) ? strip_tags($alt) : '',
            !is_null($imageClass) ? $imageClass : '',
            self::getLazyLoadType($lazyLoadType),
            is_null($useMiniature) ? self::USE_MINIATURE_DEFAULT_VALUE : $useMiniature
        );

        $imageMiniature = self::getImageMiniature($imageId, $resizeType);
        $resultWebpSourceMarkup = '';
        $resultSourceMarkup = '';

        $imageSource1x = self::getImage($imageId);
        $proportion = self::getImageProportion((int)$imageSource1x['WIDTH'], (int)$imageSource1x['HEIGHT']);
        $resultImageMarkup = $pictureMarkup->getImgMarkup(
            $imageSource1x['SRC'],
            $imageSource1x['SRC'],
            (int)$imageSource1x['WIDTH'],
            (int)$imageSource1x['HEIGHT'],
            $imageMiniature['src']
        );

        if ($imageSource1x['src_webp'] !== '') {
            $resultWebpSourceMarkup = $pictureMarkup->getSourceMarkup(
                $imageSource1x['src_webp'],
                $imageSource1x['src_webp'],
                "type='image/webp'",
                $imageMiniature['src_webp']
            );
        }

        if (empty($media)) {
            if (!$imageSource1x) {
                return '';
            }

        } else {
            $index = 0;
            [
                $resultImageMarkup,
                $resultWebpSourceMarkup,
                $resultSourceMarkup
            ] = self::getImagesStructure(
                $media,
                $imageId,
                $resizeType,
                $proportion,
                $index,
                $pictureMarkup,
                $imageMiniature,
                $resultWebpSourceMarkup,
                $resultSourceMarkup
            );
        }

        return '<picture class="' . $pictureClass .'">' . "\n" . $resultWebpSourceMarkup . "\n" . $resultSourceMarkup . "\n" . $resultImageMarkup . "\n" . '</picture>';
    }

    private static function getLazyLoadType(?string $lazyLoadType): string
    {
        if (is_null($lazyLoadType)) {
            $lazyLoadTypeResult = self::LAZY_LOAD_TYPE_DEFAULT_VALUE;
        } elseif ($lazyLoadType === ImageLazyLoadType::LAZY_LOAD_TYPE_NATIVE_DISABLE) {
            $lazyLoadTypeResult = '';
        } else {
            $lazyLoadTypeResult = (!in_array($lazyLoadType, ImageLazyLoadType::getAllTypes(), true))
                ? self::LAZY_LOAD_TYPE_DEFAULT_VALUE
                : $lazyLoadType;
        }

        return $lazyLoadTypeResult;
    }

    private static function getImageMiniature(int $imageId, int $resizeType): array
    {
        $imgMiniature = self::getResizedImage(
            $imageId,
            self::LAZY_LOAD_MINIATURE_WIDTH,
            self::LAZY_LOAD_MINIATURE_HEIGHT,
            ImageViewConfig::getImageQualityAfterCompression(),
            $resizeType
        );

        if (!$imgMiniature) {
            $imgMiniature['src'] = '';
            $imgMiniature['src_webp'] = '';
        }

        return $imgMiniature;
    }

    private static function getResizedImage(
        int $imageId,
        int $width,
        int $height,
        int $quality,
        int $resizeType
    ): ?array
    {
        $result = CFile::ResizeImageGet($imageId, ['width' => $width, 'height' => $height], $resizeType, false, [
            [
                'name' => 'sharpen',
                'precision' => 0
            ]
        ], false, $quality);

        if ($result) {
            $result['src_webp'] = self::getWebpImage($imageId, $result['src']);
        } else {
            $result = null;
        }

        return $result;
    }

    private static function getWebpImage(int $imageFileId, string $imagePath): string
    {
        $imageFileInfo = CFile::GetFileArray($imageFileId);

        return $imageFileInfo ?
            ImageWebp::get(
                $imageFileInfo['CONTENT_TYPE'],
                $imageFileInfo['FILE_NAME'],
                $imagePath,
                $_SERVER['DOCUMENT_ROOT']
            ) :
            '';
    }

    private static function getImage($imageId): ?array
    {
        $result = CFile::GetFileArray($imageId);

        if ($result) {
            $result['src_webp'] = self::getWebpImage($imageId, $result['SRC']);
        }

        return $result ?? null;
    }

    private static function getImageProportion(int $width, int $height): float
    {
        return $width / $height;
    }

    private static function getImagesStructure(
        array         $media,
        int           $imageId,
        int           $resizeType,
        float         $proportion,
        int           $index,
        PictureMarkup $pictureMarkup,
        array         $imageMiniature,
        string        $resultWebpSourceMarkup,
        string        $resultSourceMarkup
    ): array
    {
        $resultImageMarkup = [];

        foreach ($media as $key => $sizesArr) {
            [$width, $height] = $sizesArr;

            if (is_null($height)) {
                $height = $width / $proportion;
            }

            $imageSource1x = self::getImageSourceFromHeightParam(
                $imageId,
                $width,
                self::getImageHeight($width, $proportion),
                $resizeType,
                self::IMAGE_PIXELS_RATIO_DEFAULT
            );

            if (!$imageSource1x) {
                continue;
            }

            $imgSource2x = self::getImageSource2x(
                $key,
                $imageId,
                $width,
                self::getImageHeight($width, $proportion),
                $resizeType,
                $imageSource1x
            );

            if ($index === 0) {
                $resultImageMarkup = $pictureMarkup->getImgMarkup(
                    $imageSource1x['src'],
                    $imgSource2x['src'],
                    (int)$width,
                    (int)$height,
                    $imageMiniature['src']
                );

                if ($imageSource1x['src_webp'] !== '') {
                    $resultWebpSourceMarkup = $pictureMarkup->getSourceMarkup(
                        $imageSource1x['src_webp'],
                        $imgSource2x['src_webp'],
                        "type='image/webp'",
                        $imageMiniature['src_webp']
                    );
                }
            } else {
                $resultSourceMarkup = $pictureMarkup->getSourceMarkup(
                        $imageSource1x['src'],
                        $imgSource2x['src'],
                        "media='(min-width: " . (int)$key . "px)'",
                        $imageMiniature['src']
                    ) .
                    "\n" . $resultSourceMarkup;

                if ($imageSource1x['src_webp'] !== '') {
                    $resultWebpSourceMarkup = $pictureMarkup->getSourceMarkup(
                            $imageSource1x['src_webp'],
                            $imgSource2x['src_webp'],
                            "type='image/webp' media='(min-width: " . (int)$key . "px)'",
                            $imageMiniature['src_webp']
                        ) .
                        "\n" . $resultWebpSourceMarkup;
                }
            }

            $index++;
        }

        return [
            $resultImageMarkup,
            $resultWebpSourceMarkup,
            $resultSourceMarkup
        ];
    }

    private static function getImageSourceFromHeightParam(
        int $imageId,
        int $width,
        int $height,
        int $resizeType,
        int $imagePixelsRatio
    ): ?array
    {

        return self::getResizedImage(
            $imageId,
            $width * $imagePixelsRatio,
            $height * $imagePixelsRatio,
            ImageViewConfig::getImageQualityAfterCompression(),
            $resizeType
        );
    }

    private static function getImageHeight(int $width, float $proportion): int
    {
        return $width / $proportion;
    }

    private static function getImageSource2x(
        int   $key,
        int   $imageId,
        int   $width,
        int   $height,
        int   $resizeType,
        array $imgSource1x
    ): ?array
    {

        if (self::isImage2X($key)) {
            $imageSource2x = self::getImageSourceFromHeightParam(
                $imageId,
                $width,
                $height,
                $resizeType,
                self::IMAGE_PIXELS_RATIO_FOR_RETINA
            );
        } else {
            $imageSource2x = $imgSource1x;
        }

        return $imageSource2x;
    }

    private static function isImage2X(int $screenWidthFromKey): bool
    {
        return ImageViewConfig::getMediaScreenParamsRetinaMin() <= $screenWidthFromKey;
    }
}