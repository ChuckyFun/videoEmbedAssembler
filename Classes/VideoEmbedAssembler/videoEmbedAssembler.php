<?php
/**
 * Created by PhpStorm.
 * User: Gurcan Akyuz
 * Date: 22.07.2017
 * Time: 23:48
 */

namespace IGA\VideoEmbedAssembler;

use IGA\LinkAssembler\linkAssembler;

class videoEmbedAssembler
{

    protected static $embedHeight = 360;
    protected static $regexYoutubeNormal = "/youtube.com\/watch\?v=(.*?)(\s|$)/";
    protected static $regexYoutubeShort = "/youtu.be\/(.*?)(\s|$)/";
    protected static $regexVimeo = "/vimeo.com\/(.*?)(\s|$)/";
    protected static $regexDailymotionNormal = "/dailymotion.com\/video\/(.*?)(\s|$)/";
    protected static $regexDailymotionShort = "/dai.ly\/(.*?)(\s|$)/";
    protected static $isAddedEmbed = false;

    /**
     * @param string $string
     * @return string
     */
    public static function convertText(string $string, int $embedHeight = 0):string
    {

        $string = urldecode($string);

        $output = linkAssembler::link($string);
        $output = (self::$isAddedEmbed == false) ? self::youtubeEmbed($output, $embedHeight) : $output;
        $output = (self::$isAddedEmbed == false) ? self::vimeoEmbed($output, $embedHeight) : $output;
        $output = (self::$isAddedEmbed == false) ? self::dailymotionEmbed($output, $embedHeight) : $output;

        return $output;

    }


    /**
     * youtube.com/watch?v=*
     * youtu.be/*
     *
     * @param string $string
     * @return string
     */
    protected static function youtubeEmbed(string $string, int $embedHeight):string
    {

        if(stripos($string, "youtube.com") !== false || stripos($string, "youtu.be") !== false) {

            preg_match(self::$regexYoutubeNormal, $string, $video_id);
            if(count($video_id) == 0) {
                preg_match(self::$regexYoutubeShort, $string, $video_id);
            }
            if(count($video_id) > 1 && strlen($video_id[1]) > 0) {
                $embedHeight = ($embedHeight > 0) ? $embedHeight : self::$embedHeight;
                $string .= "<iframe width=\"100%\" height=\"".$embedHeight."\" src=\"https://www.youtube.com/embed/{$video_id[1]}\" frameborder=\"0\" allowfullscreen></iframe>";
                self::$isAddedEmbed = true;
            }

        }

        return $string;

    }

    /**
     * vimeo.com/*
     *
     * @param string $string
     * @return string
     */
    protected static function vimeoEmbed(string $string, int $embedHeight):string
    {

        if(stripos($string, "vimeo.com") !== false) {

            preg_match(self::$regexVimeo, $string, $video_id);

            if(count($video_id) > 1 && strlen($video_id[1]) > 0) {
                $embedHeight = ($embedHeight > 0) ? $embedHeight : self::$embedHeight;
                $string .= "<iframe src=\"https://player.vimeo.com/video/{$video_id[1]}\" width=\"100%\" height=\"".$embedHeight."\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
                self::$isAddedEmbed = true;
            }

        }

        return $string;

    }

    /**
     * dailymotion.com/video/*
     * dai.ly/*
     *
     * @param string $string
     * @return string
     */
    protected static function dailymotionEmbed(string $string, int $embedHeight):string
    {

        if(stripos($string, "dailymotion.com") !== false) {

            preg_match(self::$regexDailymotionNormal, $string, $video_id);
            if(count($video_id) == 0) {
                preg_match(self::$regexDailymotionShort, $string, $video_id);
            }
            if(count($video_id) > 1 && strlen($video_id[1]) > 0) {
                $embedHeight = ($embedHeight > 0) ? $embedHeight : self::$embedHeight;
                $string .= "<iframe frameborder=\"0\" width=\"100%\" height=\"".$embedHeight."\" src=\"//www.dailymotion.com/embed/video/{$video_id[1]}\" allowfullscreen></iframe>";
                self::$isAddedEmbed = true;
            }

        }

        return $string;

    }

}