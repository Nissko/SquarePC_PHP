<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooling extends Model
{
    protected $fillable = ['name', 'model', 'TDW', 'height', 'type', 'price', 'img'];
    public $timestamps = false;

    public function positions(){
        return $this->hasMany(Position::class);
    }
}
