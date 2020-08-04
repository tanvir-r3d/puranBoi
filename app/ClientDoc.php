<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDoc extends Model
{
    protected $table='client_docs';

    protected $primaryKey = 'client_doc_id';

    protected $fillable=['client_id','client_doc','doc_type'];

    public function client()
    {
        return $this->belongsTo('App\Client','client_id');
    }
}
