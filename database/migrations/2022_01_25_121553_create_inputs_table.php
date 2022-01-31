<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('service_plan_id')->constrained('service_plans', 'id')->onDelete('cascade');
            $table->date('day');
            $table->string('input_key')->index();
            $table->foreignId('calculation_method_id')->constrained('service_plan_calculation_method', 'id');
            $table->unsignedDouble('value', 10, 2)->nullable();
            $table->unsignedDouble('value_2', 10, 2)->nullable();
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
        Schema::dropIfExists('inputs');
    }
}
