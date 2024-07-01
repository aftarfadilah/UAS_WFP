<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class Facility extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'product_id', 'description'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
