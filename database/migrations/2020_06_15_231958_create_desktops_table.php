<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesktopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desktops', function (Blueprint $table) {
            $table->id();
            $table->string('assettag',8)->unique();
            $table->string('ram', 10);
            $table->string('hdd', 10);
            $table->string('antivirus', 50);
            $table->string('os', 50);
            $table->string('office', 50);
            $table->boolean('has_monitor')->default(false);
            $table->string('monitor_name')->nullable();
            $table->string('monitor_serial')->nullable();
            $table->boolean('has_keyboard')->default(false);
            $table->string('keyboard_name')->nullable();
            $table->string('keyboard_serial')->nullable();
            $table->boolean('has_mouse')->default(false);
            $table->string('mouse_name')->nullable();
            $table->string('mouse_serial')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desktops');
    }
}
