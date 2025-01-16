<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'stat_name',
        'stat_value',
        'package_id'
    ];

    public $timestamps = false;

    public function packages(){
        return $this->belongsTo(Package::class);
    }
}
