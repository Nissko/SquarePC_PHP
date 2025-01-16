<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerModel extends Model
{
    protected $fillable = ['name', 'description', 'img'];

    public function Package(){
        return $this->hasMany(Package::class);
    }

    public function Cpu(){
        return $this->hasMany(Cpu::class, 'model_id');
    }

    public function Motherboard(){
        return $this->hasMany(Motherboard::class, 'model_id');
    }

    public function Ram(){
        return $this->hasMany(Ram::class, 'model_id');
    }

    public function Gpu(){
        return $this->hasMany(Gpu::class, 'model_id');
    }

    public function Psu(){
        return $this->hasMany(Psu::class, 'model_id');
    }

    public function Corp(){
        return $this->hasMany(Corp::class, 'model_id');
    }
}
