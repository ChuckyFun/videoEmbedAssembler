<?php
/**
 * Created by PhpStorm.
 * User: Gurcan Akyuz
 * Date: 23.07.2017
 * Time: 13:31
 */

namespace IGA\LinkAssembler;

class linkAssembler
{

    protected static $regexLink = "/(^|\s)((https?:\/\/)?[\w-]+(\.[\w-]+)+\.?(:\d+)?(\/\S*)?)/si";

    public static function link(string $string)
    {

        preg_match_all(self::$regexLink, $string, $linkArray);

        if(count($linkArray) > 2 && count($linkArray[2]) > 0) {
            foreach($linkArray[2] as $link) {
                $string = str_replace($link, "<a href=\"{$link}\" target=\"_blank\">{$link}</a>", $string);
            }
        }

        return $string;

    }

}