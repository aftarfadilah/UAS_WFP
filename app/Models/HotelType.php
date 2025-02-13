<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelType extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hotels(){
        return $this->hasMany('App\Models\Hotel')->withTrashed();
    }

    public function __toString(){
        return $this->name;
    }
}
