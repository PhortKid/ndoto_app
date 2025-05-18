<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Define the table name if it differs from the default
    protected $table = 'transactions';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'type',
        'status',
    ];

    // Cast 'amount' as decimal with two decimal places
    protected $casts = [
        'amount' => 'decimal:2', // Ensures amount is always stored with 2 decimal places
    ];

    // Define the relationship between Transaction and User (one-to-many inverse)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship between Transaction and Wallet (many-to-one inverse)
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    // Accessor for status (optional, for better readability in your app)
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status); // Capitalizes the first letter of the status
    }
}
