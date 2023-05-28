<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['seat','row','price','showtime_id','user_id'];

    public function showtime(){
        return $this->belongsTo(Showtime::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

}
