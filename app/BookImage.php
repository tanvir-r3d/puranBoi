<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookImage extends Model
{
    protected $table='book_images';

    protected $primaryKey = 'image_id';

    protected $fillable=['book_id','image_type','book_image'];

    public function book()
    {
        return $this->belongsTo('App\Book','book_id');
    }
}
