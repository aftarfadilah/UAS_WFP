<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type(){
        return $this->belongsTo('App\Models\HotelType')->withTrashed();
    }

    public function products(){
        return $this->hasMany(Product::class, 'hotel_id', 'id');
    }
}
