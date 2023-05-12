<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;

    protected $fillable = ['date','movie_id'];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function showtimes(){
        return $this->hasMany(Showtime::class);
    }
}
