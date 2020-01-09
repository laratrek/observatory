<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function pings()
    {
        return $this->hasMany('App\SitePing');
    }

    public function ping()
    {
        return $this->hasOne('App\SitePing');
    }
}
