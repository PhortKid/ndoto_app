<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        $table->foreignId('wallet_id')->constrained()->onDelete('cascade'); 
        $table->decimal('amount', 10, 2);
        $table->enum('type', ['withdrawal', 'deposit']);
        $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); 
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('transactions');
}

};
