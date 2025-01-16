<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id','name', 'status', 'price', 'user_id', 'message_status', 'updated_at', 'created_at'];

    public function Positions(){
        return $this->belongsToMany(Position::class, 'order_position')->withPivot('count_position');
    }

    public function Users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
