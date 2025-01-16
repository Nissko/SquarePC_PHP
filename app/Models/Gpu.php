<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gpu extends Model
{
    protected $fillable = ['name', 'model', 'volume_ram', 'brand', 'price', 'img', 'complectation_name', 'model_id'];
    public $timestamps = false;

    public function positions(){
        return $this->hasMany(Position::class);
    }

    public function ComputerModel(){
        return $this->belongsTo(ComputerModel::class, 'model_id');
    }
}
