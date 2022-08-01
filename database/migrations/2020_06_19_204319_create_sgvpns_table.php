<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSgvpnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sgvpns', function (Blueprint $table) {
            $table->id();
            $table->boolean('owner')->default(false);
            $table->string('employee');
            $table->string('username');
            $table->string('password');
            $table->string('prev_password');
            $table->string('status');
            $table->string('location');
            $table->string('why_change')->nullable();
            $table->string('last_agent');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('sgvpns');
    }
}
