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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained()->onDelete('cascade');  
            $table->String('username');
           // $table->enum('is_anonymous',['0','1'])->default('1');
            $table->integer('quantity'); 
            $table->decimal('price', 10, 2); 
            $table->timestamp('purchase_date')->useCurrent();  
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
};
