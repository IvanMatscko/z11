<?php

namespace App\Custom;

use App\Custom\Common;

class Language {

    public static $enabledLocales = [
        'en'=>[
            'img' => 'flag-1.png'
        ],
        'ua'=>[
            'img' => 'flag-2.png'
        ],
        'ru'=>[
            'img' => 'flag-3.png'
        ]
    ]; 

    public static function getURLwithLanguages($url, $currentLanguage = NULL, $step = 0, $rec = [])
    {
        $localesList = self::getLocalesList();
        $urlParts = Common::parsePath($url);
        if (empty($rec))
        {
            if (is_null($currentLanguage))
                if (self::checkLocale($urlParts[0]))
                    $currentLanguage = $urlParts[0];
            return self::getURLwithLanguages($url, $currentLanguage, $step, $localesList);
        }
        // var_dump($urlParts);
        $urlParts[0] = $localesList[$step];
        $rec[$step] = [
            'url'       => '/'.implode('/', $urlParts),
            'current'   => ($step==array_search($currentLanguage, $localesList)),
            'img'       => self::$enabledLocales[$localesList[$step]]['img'],
        ];
        if (count(self::$enabledLocales)<=$step+1)
        {
            return $rec;
        }
        else
        {
            return self::getURLwithLanguages($url, $currentLanguage, $step+1, $rec);
        }
    }

    public static function getLocalesList()
    {
        return array_keys(self::$enabledLocales);
    }

    public static function checkLocale($locale)
    {
        return (isset(self::$enabledLocales[$locale]));
    }
}