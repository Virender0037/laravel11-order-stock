<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{   
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'price',
        'stock',
        'status',
    ];

    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }

    public function stocklogs(){
        return $this->hasMany(StockLog::class);
    }
}
