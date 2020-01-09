<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SitePing extends Model
{
    protected $guarded = [
        'id',
        'created_at',
    ];
    const UPDATED_AT = null;

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
