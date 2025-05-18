<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    
    protected $table = 'purchases';

    
    protected $fillable = [
        'item_id',
        'username',
        'is_anonymous',
        'quantity',
        'price',
        'purchase_date',
    ];


    protected $casts = [
        'is_anonymous' => 'boolean', 
        'price' => 'decimal:2', 
    ];

  
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    
    public function getFormattedPurchaseDateAttribute()
    {
        return $this->purchase_date->format('Y-m-d H:i:s'); 
    }
}
