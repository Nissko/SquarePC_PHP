<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disk extends Model
{
    protected $fillable = ['name', 'model', 'type', 'size', 'price', 'img'];
    public $timestamps = false;

    public function positions(){
        return $this->hasMany(Position::class);
    }
}
