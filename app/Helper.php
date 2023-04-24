<?php

namespace App;

class Helper
{
    const province = [
        'Bagmati',
        'Gandaki',
        'Karnali',
        'Koshi',
        'Lumbini',
        'Madhesh',
        'Sudurpashchim'
    ];

    public static function getProvince()
    {
        return self::province;
    }
}
