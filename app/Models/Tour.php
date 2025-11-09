<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Journal;
use App\Models\Booking;
class Tour extends Model {
    protected $fillable = ['title','description','price','location','image','is_active'];
    public function journals(){ return $this->hasMany(Journal::class); }
    public function bookings(){ return $this->hasMany(Booking::class); }
}
