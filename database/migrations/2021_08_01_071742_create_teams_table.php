<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('team_name');
            $table->string('movie_url');
            $table->string('teacher');
            $table->string('start_page1');
            $table->string('start_page2');
            $table->string('start_page3');
            $table->string('end_page1');
            $table->string('end_page2');
            $table->string('end_page3');
            $table->string('img1');
            $table->string('img2');
            $table->string('img3');
	        $table->integer('user_id');
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
        Schema::dropIfExists('teams');
    }
}
