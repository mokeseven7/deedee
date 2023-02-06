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
        Schema::create('dee_dees', function (Blueprint $table) {
            $table->id();
            $table->string('surname');
            $table->string('character_name');
            $table->smallInteger('age');
            $table->string('character_type');
            $table->string('character_level');
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
        Schema::dropIfExists('dee_dees');
    }
};
