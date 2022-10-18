<?php

namespace App\Helper;

class Helper
{
    public static function debug($string) {
        echo '<pre>';
        print_r($string);
        echo '</pre>';
        die();
    }
}