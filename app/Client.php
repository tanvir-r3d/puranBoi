<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='clients';

    protected $primaryKey = 'client_id';

    protected $fillable=["client_name","client_gender","client_code","client_phone","client_email","client_image","permanent_address","present_address","client_dob","inst_id","client_dept","details","status"];

    public function clientdoc()
    {
        return $this->hasMany('App\ClientDoc','client_id');
    }
    public function institute()
    {
        return $this->belongsTo('App\Institute','inst_id');
    }

    public static function boot() {
        parent::boot();
        self::deleting(function($client) {
            $client->clientdoc()->each(function($doc) {
                File::delete('/docs/client/'.$doc->client_doc);
            });
        });
    }
}
