<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model {
    protected $fillable = ['tour_id','title','content','journal_date','photo','video'];

    public function tour(){
        return $this->belongsTo(Tour::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }

    public function getVideoUrlAttribute()
    {
        return $this->video ? asset('storage/' . $this->video) : null;
    }
}
