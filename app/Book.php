<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Book extends Model
{
    protected $table='book_details';

    protected $primaryKey = 'book_id';

    protected $fillable=['inst_id','book_dept','book_name','book_writter','book_quantity','status'];

    public function image(){
        return $this->hasMany('App\BookImage','book_id');
    }

    public function price(){
        return $this->hasOne('App\BookPrice','book_id');
    }

    public function institute()
    {
        return $this->belongsTo('App\Institute','inst_id');
    }

    public function code()
    {
        return $this->hasMany('App\BookCode','book_id');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($book) {

            $book->image()->each(function($img) {
                $path=public_path('images/book/').$img->book_image;
                if(File::exists($path))
                unlink($path);
            });
        });
    }
}
