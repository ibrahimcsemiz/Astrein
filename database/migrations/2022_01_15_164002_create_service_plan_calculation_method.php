<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePlanCalculationMethod extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_plan_calculation_method', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_plan_id')->constrained('service_plans', 'id')->onDelete('cascade');
            $table->foreignId('calculation_method_id')->constrained('calculation_methods', 'id')->onDelete('cascade');
            $table->integer('price');
            $table->integer('price_2');
            $table->time('time');
            $table->time('time_2');
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
        Schema::dropIfExists('service_plan_calculation_method');
    }
}
