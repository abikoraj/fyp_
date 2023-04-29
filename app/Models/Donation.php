<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function food_category()
    {
        return $this->belongsTo(FoodCategory::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
