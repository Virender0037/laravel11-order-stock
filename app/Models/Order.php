<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{   
    use SoftDeletes, HasFactory;

     protected $fillable = [
        'customer_id',
        'created_by',
        'order_no',
        'status',
        'total_amount',
    ];

    public function customer(){
      return $this->belongsTo(Customer::class);
    }

    public function user(){
      return $this->belongsTo(User::class, 'created_by');
    }

    public function items(){
      return $this->hasMany(OrderItem::class);
    }
}
