<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    protected $table='institutes';

    protected $primaryKey = 'inst_id';

    protected $fillable=['inst_name','inst_details'];
}
