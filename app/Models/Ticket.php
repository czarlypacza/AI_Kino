<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['seat','row','price','showtime_id'];

    public function showtime(){
        return $this->belongsTo(Showtime::class);
    }

}
