<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['cpu_id', 'motherboard_id', 'ram_id', 'gpu_id', 'psu_id', 'cooling_id', 'case_id', 'corp_id', 'disk_id', 'ssd_id', 'count_ram', 'price', 'model_name', 'package_name'];

    public function Cpuses(){
        return $this->belongsTo(Cpu::class, 'cpu_id');
    }

    public function Motherboardses(){
        return $this->belongsTo(Motherboard::class, 'motherboard_id');
    }

    public function Rams(){
        return $this->belongsTo(Ram::class, 'ram_id');
    }

    public function Gpuses(){
        return $this->belongsTo(Gpu::class, 'gpu_id');
    }

    public function Psuses(){
        return $this->belongsTo(Psu::class, 'psu_id');
    }

    public function Disks(){
        return $this->belongsTo(Disk::class, 'disk_id');
    }

    public function Ssds(){
        return $this->belongsTo(Disk::class, 'ssd_id');
    }

    public function ComputerCases(){
        return $this->belongsTo(Corp::class, 'case_id');
    }

    public function Coolings(){
        return $this->belongsTo(Cooling::class, 'cooling_id');
    }

    public function Orders(){
        return $this->belongsToMany(Order::class, 'order_position')->withPivot('count_position');
    }
}
