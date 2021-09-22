<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_user', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->id();
            $table->foreignId('anime_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('anime_user');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
