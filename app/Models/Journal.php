<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model {
    protected $fillable = ['tour_id','title','content','journal_date'];
    public function tour(){ return $this->belongsTo(Tour::class); }
}
