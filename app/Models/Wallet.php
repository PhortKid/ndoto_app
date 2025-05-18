<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    // Define the table name if it differs from the default
    protected $table = 'wallets';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'balance',
        'currency',
    ];

    // Cast 'balance' as decimal with two decimal places
    protected $casts = [
        'balance' => 'decimal:2', // Ensures balance is always stored with 2 decimal places
    ];

    // Define the relationship between Wallet and User (one-to-one)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
