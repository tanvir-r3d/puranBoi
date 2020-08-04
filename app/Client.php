<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='clients';

    protected $primaryKey = 'client_id';

    protected $fillable=["client_name","client_gender","client_slug","client_phone","client_email","client_image","permanent_address","present_address","client_dob","client_inst","client_dept","details","delivery_location","status"];

    public function clientdoc()
    {
        return $this->hasMany('App\ClientDoc','client_id');
    }
}
