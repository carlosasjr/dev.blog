<?php
namespace App\Helper;

use Carbon\Carbon;

class Helper
{
    public static function sanitizeString($string)
    {
        // Valores informados
        $what = array(
            'ä',
            'ã',
            'à',
            'á',
            'â',
            'ê',
            'ë',
            'è',
            'é',
            'ï',
            'ì',
            'í',
            'ö',
            'õ',
            'ò',
            'ó',
            'ô',
            'ü',
            'ù',
            'ú',
            'û',
            'À',
            'Á',
            'É',
            'Í',
            'Ó',
            'Ú',
            'ñ',
            'Ñ',
            'ç',
            'Ç',
            '-',
            '(',
            ')',
            ',',
            ';',
            ':',
            '|',
            '!',
            '"',
            '#',
            '$',
            '%',
            '&',
            '/',
            '=',
            '?',
            '~',
            '^',
            '>',
            '<',
            'ª',
            'º',
            'Ã',
            'Õ',
            '&'
        );

        // Valores a serem substituídos
        $by = array(
            'a',
            'a',
            'a',
            'a',
            'a',
            'e',
            'e',
            'e',
            'e',
            'i',
            'i',
            'i',
            'o',
            'o',
            'o',
            'o',
            'o',
            'u',
            'u',
            'u',
            'u',
            'A',
            'A',
            'E',
            'I',
            'O',
            'U',
            'n',
            'n',
            'c',
            'C',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            '_',
            'A',
            'O',
            ''
        );

        // String Formatada
        return str_replace($what, $by, $string);
    }

    public static function createUrl($string)
    {
        //Retira os acentos
        $url = self::sanitizeString($string);

        //Deixa o texto em minusculo retira todos encodes html
        return str_replace(' ', '-', strtolower(filter_var($url, FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
    }

    public static function formatDateTime($value, $format  = 'd/m/Y')
    {
        return Carbon::parse($value)->format($format);
    }
}
