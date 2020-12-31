<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->tinyInteger('home_team_goals');
            $table->tinyInteger('away_team_goals');
            $table->string('result');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('home_team_id')->references('id')->on('teams');
            $table->foreign('away_team_id')->references('id')->on('teams');
            $table->foreign('winner_id')->references('id')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
