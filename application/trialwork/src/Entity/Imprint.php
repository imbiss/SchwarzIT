<?php
namespace App\Entity;

class Imprint
{
    static private string $content_de = 'Impressum Text auf Deutsche';
    static private string $content_en = 'Imprint Text in english';


    public static function getContent(string $lang='en'): string
    {
        switch($lang) {
            case 'de':
                return self::$content_de;

            default:
                return self::$content_en;

        }
    }
}