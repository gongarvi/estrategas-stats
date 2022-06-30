<?php

use Google\Service\Blogger\Blog;
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
        Schema::create('country', function (Blueprint $table) {
            $table->string("tag", 3)->nullable(false)->primary();
            $table->string('name');
            $table->string("color")->default("#000");
            $table->timestamps();
        });

        Schema::create('game', function(Blueprint $table){
            $table->uuid()->nullable(false)->primary();
            $table->string("name");
            $table->string("edition");
            $table->timestamps();
        });

        Schema::create('game_session', function(Blueprint $table){
            $table->uuid("game_uuid")->nullable(false);
            $table->smallInteger("session")->nullable(false)->default(0);
            $table->string("skan_game_id")->nullable(false)->unique();

            $table->index(["game_uuid", "session"]);

            $table->string("skan_user_token")->nullable(false);
            $table->foreign("game_uuid")
                ->references("uuid")
                ->on("game")
                ->onDelete("cascade");
        });

        Schema::create("country_historic_data", function(Blueprint $table){
            $table->unsignedBigInteger("id")->nullable(false)->primary();
            $table->float("income");
            $table->float("max_manpower");
            $table->float("innovativeness");
            $table->float("professionalism");
            $table->float("development");
            $table->float("force_limit");
            $table->float("development_ratio");
            $table->float("total_spent");
            $table->float("manpower_recovery");
            $table->integer("provinces");
            $table->float("absolutism");
            $table->float("army_strength");
            $table->integer("buildings_value");
            $table->float("naval_strength");
            $table->float("quality_score");
            $table->float("spent_on_advisors");
            $table->float("development_average_cost");
            $table->integer("development_clicks");
            $table->float("weighted_avg_monarch");
            $table->float("overall_strength");
            $table->float("overall_strength_with_subjects");
        });

        Schema::create('game_historic', function(Blueprint $table){
            $table->uuid("game_uuid")->nullable(false);
            $table->smallInteger("session")->nullable(false);
            $table->string("country_tag", 3)->nullable(false);
            $table->unsignedBigInteger("country_historic_id");

            $table->index(["session", "game_uuid", "country_tag"]);
            
            $table->foreign(["game_uuid", "session"])
                ->references(["game_uuid", "session"])
                ->on("game_session")
                ->onDelete("cascade");

            $table->foreign("country_tag")
                ->references("tag")
                ->on("country");

            $table->foreign("country_historic_id")
                ->references("id")
                ->on("country_historic_data")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_historic');
        Schema::dropIfExists('country_historic_data');
        Schema::dropIfExists('game_session');
        Schema::dropIfExists('game');
        Schema::dropIfExists('country');
    }
};