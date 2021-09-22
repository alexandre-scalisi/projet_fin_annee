<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimeGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anime_genre', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            $table->id();
            $table->foreignId('anime_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('anime_genre');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
