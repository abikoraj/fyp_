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

    const unit = [
        'plate',
        'pcs',
        'bottle',
        'serving',
        'can',
        'jar',
        'packet',
        'kg',
        'gm',
        'ltr',
        'ml',
    ];

    public static function getUnit()
    {
        return self::unit;
    }

    const status = [
        'Fresh',
        'Interested',
        'Expired',
        'Wasted',
        'Completed',
    ];

    public static function getStatus()
    {
        return self::status;
    }

    const approval = [
        'Pending',
        'Approved',
        'Rejected',
    ];

    public static function getApproval()
    {
        return self::approval;
    }
}
