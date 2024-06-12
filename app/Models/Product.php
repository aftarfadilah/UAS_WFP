<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function hotel(){
        return $this->belongsTo(Hotel::class, 'hotel_id')->withTrashed();
    }

    public static function retrieveByHotelId($hotelid)
    {
        $dataku = self::where('hotel_id', $hotelid)
                    ->get();
        return $dataku;
    }

    /**
     * The roles that belong to the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function transactions(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class, 'product_transaction', 'product_id', 'transaction_id')->withTrashed();
    }
}
