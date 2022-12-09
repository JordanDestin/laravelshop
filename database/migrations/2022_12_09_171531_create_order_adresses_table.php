<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_adresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('addressbis')->nullable();
            $table->string('postal', 10); 
            $table->string('city', 100);
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_adresses');
    }
};
