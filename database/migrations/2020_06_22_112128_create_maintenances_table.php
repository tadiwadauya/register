<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('agent');
            $table->string('ip_address');
            $table->string('username');
            $table->string('department');
            $table->boolean('all_five');
            $table->boolean('monitor');
            $table->boolean('cpu');
            $table->boolean('keyboard');
            $table->boolean('mouse');
            $table->boolean('desk');
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
        Schema::dropIfExists('maintenances');
    }
}
