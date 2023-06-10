<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'image','director','actors','duration','score'];

    public function show(){
        return $this->hasMany(Show::class);
    }

    public function carousel(){
        return $this->hasOne(Carousel::class);
    }

    public function genre():BelongsToMany{
        return  $this->belongsToMany(Genre::class);
    }
}
