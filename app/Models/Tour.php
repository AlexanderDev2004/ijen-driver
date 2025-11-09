<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'image',
        'is_active',
        'slug',
    ];

    public function journals()
    {
        return $this->hasMany(Journal::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
