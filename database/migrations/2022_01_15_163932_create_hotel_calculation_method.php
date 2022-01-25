<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelCalculationMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_calculation_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_method_id')->constrained('calculation_methods', 'id')->onDelete('cascade');
            $table->foreignId('hotel_id')->constrained('hotels', 'id')->onDelete('cascade');
            $table->integer('hourly_wage')->nullable();
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
        Schema::dropIfExists('hotel_calculation_method');
    }
}
