<?php

namespace AppBundle\Utils;

class UrlCompressHelper
{
    public static function isGoodResponse($url)
    {
        $code = self::getHttpResponseCode($url);

        return $code === 200;
    }

    public static function getShortUri()
    {
        $symbols = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j'];
        $string = time() . mt_rand(10, 99);

        $url = '';
        for ($i=0; $i < strlen($string); $i++) {
            $url .= $symbols[ $string[$i] ];
        }

        return $url;
    }

    private static function getHttpResponseCode($url)
    {
        $headers = get_headers($url);

        return (integer) substr($headers[0], 9, 3);
    }
}
