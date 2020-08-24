<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPrice extends Model
{
    protected $table='book_prices';

    protected $primaryKey = 'book_price_id';

    protected $fillable=['book_id','book_purchase_price','book_rent_price','book_resell_price','book_rent_number'];

    public function book()
    {
        return $this->belongsTo('App\Book','book_id');
    }
}
