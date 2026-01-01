<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tour extends Model
{
    use HasFactory;

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

    /**
     * Accessor untuk image URL
     */
    public function getImageUrlAttribute()
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }

        return null;
    }

    /**
     * Scope untuk tour aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
