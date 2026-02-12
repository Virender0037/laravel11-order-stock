<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockLog extends Model
{   
    use HasFactory; 
    
    protected $fillable = [
     'product_id',
     'type',
     'qty',
     'reference_type',
     'reference_id',
     'meta',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
