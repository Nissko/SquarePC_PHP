<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    protected $fillable = ['name', 'model', 'socket', 'chipset', 'size', 'qty_ram', 'brand', 'max_clock_ram', 'm2_slots_qty', 'sata_slots_qty', 'price', 'img', 'complectation_name', 'model_id'];
    public $timestamps = false;

    public function positions(){
        return $this->hasMany(Position::class);
    }

    public function ComputerModel(){
        return $this->belongsTo(ComputerModel::class, 'model_id');
    }
}
