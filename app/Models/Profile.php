<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization_type(){
        return $this->belongsTo(OrganizationType::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }
}
