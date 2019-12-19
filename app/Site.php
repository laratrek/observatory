<?php

namespace App;

class Site
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
}
