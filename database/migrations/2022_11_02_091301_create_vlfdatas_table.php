<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVlfdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vlfdatas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('SKU')->unique();
            $table->string('parent_SKU');
            $table->string('parent_id');
            $table->string('vehicle_type');
            $table->string('vehicle_make');
            $table->string('vehicle_model');
            $table->string('variant');
            $table->string('vlf_type');
            $table->string('fuel_type');
            $table->string('price');
            $table->string('k_type');
            $table->string('economy_gain_bhp');
            $table->string('economy_gain_nm');
            $table->string('fuel_saving');
            $table->string('original_bhp');
            $table->string('original_torque');
            $table->string('power_bhp');
            $table->string('torque_nm');
            $table->string('vswitch_support');
            $table->string('perm_type');
            $table->string('perm_make');
            $table->string('perm_model');
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
        Schema::dropIfExists('vlfdatas');
    }
}
