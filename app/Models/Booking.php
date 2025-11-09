<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model {
    protected $fillable = [
        'tour_id','name','phone','date','people','has_children','children_count','notes','status'
    ];
    protected $casts = [
        'has_children' => 'boolean',
        'date' => 'date',
    ];
    public function tour(){ return $this->belongsTo(Tour::class); }
}
