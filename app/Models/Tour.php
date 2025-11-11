<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tour extends Model
{
    use HasFactory, SoftDeletes;

    // Pastikan tabel benar
    protected $table = 'tours';

    protected $fillable = [
        'title',
        'description',
        'price',
        'location',
        'image',
        'is_active',
        'slug',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

     public function journals()
    {
        return $this->hasMany(Journal::class, 'tour_id');
    }
}
