<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper
{
    public static function numberGenerator($type, $data)
    {
        $now = \Carbon\Carbon::now();

        if (! $data) {
            return $type.'0001-'.$now->year;
        }

        $int = preg_replace("/[^0-9\.]/", '', $data);
        
        return $type.sprintf('%04d', $int+1).'-'.$now->year;
    }

    public static function numberGeneratorRandomCodeWithYear($type)
    {
        $now = \Carbon\Carbon::now();

        return $type.Str::random(10).'-'.$now->year;
        
    }
}