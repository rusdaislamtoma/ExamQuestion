<?php
namespace App\Traits;


trait SlugHelper
{
    public function str_slug($string) {
        $string = mb_strtolower($string);
        $string = str_replace('?', '', $string);
        $string = str_replace('%', '', $string);
        $string = preg_replace('/\s+/u', '-', trim($string));
        return $string;
    }
}
