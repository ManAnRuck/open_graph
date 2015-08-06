<?php

namespace maru\og;

/**
 * Created by PhpStorm.
 * User: manuelruck
 * Date: 06.08.15
 * Time: 13:20
 */
class OpenGraph
{
    /** @var \OOArticle $curArticle */
    protected static $curArticle;
    protected static $images = array();
    protected static $description;
    protected static $title;
    protected static $url;
    protected static $siteName;
    protected static $type;
    public static $debug = false;

    public static function initArticle($articleId)
    {
        // to be called after resolve()
        global $REX;

        self::$curArticle = \OOArticle::getArticleById($articleId);
    }

    public static function getAllHTML()
    {
        global $REX;
        $return = '';

        $return .= self::getSiteNameHTML();

        $return .= self::getTypeHTML();

        $return .= self::getTitleHTML();

        $return .= self::getDescriptionHTML();

        $return .= self::getImagesHTML();

        $return .= self::getTypeValuesHTML();

        return $return;
    }

    public static function getSiteNameHTML()
    {
        global $REX;

        /**
         * generate html for og:title
         */
        if (self::$siteName) {
            self::$siteName = self::$siteName;
        } else {
            self::$siteName = $REX['SERVERNAME'];
        }
        $return = '<meta property="og:site_name" content="' . self::$siteName . '">';

        return $return . "\n\t";
    }

    public static function getTypeHTML()
    {
        global $REX;

        /**
         * generate html for og:type
         */
        if (self::$type) {
            self::$type = self::$type;
        } elseif (self::$curArticle->getValue('art_open_graph_type')) {
            self::$type = self::$curArticle->getValue('art_open_graph_type');
        }
        $return = '<meta property="og:type" content="' . self::$type . '">';

        return $return . "\n\t";
    }

    public static function getTitleHTML()
    {
        $return = '';
        /**
         * generate html for og:title
         */
        if (self::$description) {
            self::$title = self::$title;
        } elseif (self::$curArticle->getValue('art_open_graph_title')) {
            self::$title = self::$curArticle->getValue('art_open_graph_title');
        } elseif (\rex_addon::isActivated('seo42') && self::$curArticle->_seo_title) {
            self::$title = self::$curArticle->_seo_title;
        } elseif (self::$curArticle->getValue('art_title')) {
            self::$title = self::$curArticle->getValue('art_title');
        }

        if (self::$title) {
            $return = '<meta property="og:title" content="' . self::$title . '">';
        }

        return $return . "\n\t";
    }

    public static function getDescriptionHTML()
    {
        global $REX;
        $return = '';

        /**
         * generate html for og:description
         */
        if (self::$description) {
            self::$description = self::$description;
        } elseif (self::$curArticle->getValue('art_open_graph_description')) {
            self::$description = self::$curArticle->getValue('art_open_graph_description');
        } elseif (\rex_addon::isActivated('seo42') && self::$curArticle->_seo_description) {
            self::$description = self::$curArticle->_seo_description;
        } elseif (self::$curArticle->getValue('art_description')) {
            self::$description = self::$curArticle->getValue('art_description');
        }

        if (self::$description) {
            $return = '<meta property="og:description" content="' . self::$description . '">';
        }

        return $return . "\n\t";
    }

    public static function getImagesHTML()
    {
        global $REX;
        $return = [];

        /**
         * prepare images from MetaInfo
         */
        if (self::$curArticle->getValue('art_open_graph_images')) {
            $images = explode(',', self::$curArticle->getValue('art_open_graph_images'));
            foreach ($images as $image) {
                $ogImage = new Image();
                $image = \OOMedia::getMediaByFileName($image);
                if (false && \rex_addon::isActivated('seo42')) {
                    $ogImage->setUrl(\seo42::getMediaUrl($image));
                } else {
                    $ogImage->setUrl($REX['SERVER'] . $REX['MEDIA_DIR'] . '/' . $image->getFileName());
                }
                $ogImage->setType($image->getType());
                $ogImage->setWidth($image->getWidth());
                $ogImage->setHeigt($image->getHeight());
                self::addImage($ogImage);
            }
        }

        /** @var Image $image */
        foreach (self::$images as $image) {
            $return[] = '<meta property="og:image" content="' . $image->getUrl() . '">';
            if ($image->getSecureUrl()) {
                $return[] = '<meta property="og:image:secure_url" content="' . $image->getSecureUrl() . '">';
            }
            if ($image->getWidth()) {
                $return[] = '<meta property="og:image:width" content="' . $image->getWidth() . '">';
            }
            if ($image->getHeigt()) {
                $return[] = '<meta property="og:image:height" content="' . $image->getHeigt() . '">';
            }
            if ($image->getType()) {
                $return[] = '<meta property="og:image:type" content="' . $image->getType() . '">';
            }
        }

        return implode("\n\t", $return) . "\n\t";
    }

    public static function getTypeValuesHTML()
    {
        global $REX;
        $return = [];

        /**
         * prepare Opengraph from MetaInfo TypeValues
         */
        if(self::$curArticle->getValue('art_open_graph_typevalues')) {
            $typeValues = explode("\n", self::$curArticle->getValue('art_open_graph_typevalues'));

            foreach($typeValues as $typeValue) {
                $typeValue = explode('|', $typeValue);

                $return[] = '<meta property="'.trim($typeValue[0]).'" content="'.trim($typeValue[1]).'">';
            }
        }

        return implode("\n\t", $return) . "\n\t";
    }

    /**
     * @param $image Image
     */
    public static function addImage($image)
    {
        if (!$image instanceof Image) {
            if (self::$debug) {
                throw new \Exception('Image must be a type of \maru\og\Image');
            }
        } else {
            self::$images[] = $image;
        }
    }

    /**
     * @return mixed
     */
    public static function getDescription()
    {
        return self::$description;
    }

    /**
     * @param mixed $description
     */
    public static function setDescription($description)
    {
        self::$description = $description;
    }

    /**
     * @return mixed
     */
    public static function getTitle()
    {
        return self::$title;
    }

    /**
     * @param mixed $title
     */
    public static function setTitle($title)
    {
        self::$title = $title;
    }

    /**
     * @return mixed
     */
    public static function getUrl()
    {
        return self::$url;
    }

    /**
     * @param mixed $url
     */
    public static function setUrl($url)
    {
        self::$url = $url;
    }

    /**
     * @return mixed
     */
    public static function getSiteName()
    {
        return self::$siteName;
    }

    /**
     * @param mixed $siteName
     */
    public static function setSiteName($siteName)
    {
        self::$siteName = $siteName;
    }

    /**
     * @return mixed
     */
    public static function getType()
    {
        return self::$type;
    }

    /**
     * @param mixed $type
     */
    public static function setType($type)
    {
        self::$type = $type;
    }




}