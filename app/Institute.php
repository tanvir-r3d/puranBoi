<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table='institutes';

    protected $primaryKey = 'inst_id';

    protected $fillable=['inst_name','inst_details'];

    public function client(){
        return $this->hasMany('App\Client','inst_id');
    }

    public function book(){
        return $this->hasMany('App\Book','inst_id');
    }
}
