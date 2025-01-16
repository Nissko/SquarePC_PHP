<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['price', 'package_name', 'description', 'recommendation', 'qty_ram', 'model_id', 'count'];

    public function stat(){
        return $this->hasMany(Stat::class);
    }

    public function ComputerModel(){
        return $this->belongsTo(ComputerModel::class, 'model_id');
    }
}
