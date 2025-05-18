<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'withdrawals';

    // The attributes that are mass assignable
    protected $fillable = [
        'user_id', 
        'wallet_id', 
        'transaction_id', 
        'amount', 
        'payment_method', 
        'payment_details', 
        'status', 
        'notes', 
        'processed_at'
    ];

    // The attributes that should be cast to native types
    protected $casts = [
        'payment_details' => 'array', // Automatically casts payment_details to an array
        'processed_at' => 'datetime',
    ];

    // Relationships with other models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
