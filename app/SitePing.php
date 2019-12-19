<?php

namespace App;

class SiteCheck
{
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function site()
    {
        return $this->belongsTo('App\Site');
    }
}
