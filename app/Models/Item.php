<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    
    protected $table = 'items';

    
    protected $fillable = [
        'name',
        'image',
        'price',
        'quantity',
        'is_unlimited',
        'note',
        'user_id',
    ];
    
   /*
    protected $casts = [
        'price' => 'decimal:2', 
        'is_unlimited' => 'boolean', 
    ];
*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
