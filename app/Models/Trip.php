<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'title','slug','date','participants','has_kids','customer_name','testimonial','photos'
    ];

    protected $casts = [
        'date'        => 'date',
        'has_kids'    => 'boolean',
        'photos'      => 'array',
        'participants'=> 'integer',
    ];

    public function getCoverAttribute()
    {
        return $this->photos[0] ?? null;
    }
}
