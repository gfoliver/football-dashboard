<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSeasonStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_standings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('season_id');
            $table->unsignedBigInteger('team_id');
            $table->integer('points');
            $table->integer('matches');
            $table->integer('wins');
            $table->integer('draws');
            $table->integer('losses');
            $table->integer('goal_difference');
            $table->integer('goals_scored');
            $table->integer('goals_conceded');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('season_id')->references('id')->on('seasons')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('season_standings');
    }
}
