<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = ['time','room_id' ,'show_id'];

    public function room(){
        return $this->belongsTo(Room::class);
    }
    public function show(){
        return $this->belongsTo(Show::class);
    }

    public function ticket(){
        return $this->hasMany(Ticket::class);
    }
}
