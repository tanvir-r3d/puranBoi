<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCode extends Model
{
    protected $table='book_codes';

    protected $primaryKey = 'book_code_id';

    protected $fillable=['book_id','booke_unique_code','rent_status'];

    public function book()
    {
        return $this->belongsTo('App\Book','book_id');
    }
}
