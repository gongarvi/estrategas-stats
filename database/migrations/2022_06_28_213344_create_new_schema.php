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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("user_banner");
            $table->boolean("admin");
            $table->timestamps();
        });

        Schema::create('game', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->string("last_save_load_job")->nullable();
            $table->string("name");
            $table->string("edition");
            $table->timestamps();

            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->onDelete("set null");
        });

        Schema::create('country', function (Blueprint $table) {
            $table->string("tag", 3)->nullable(false)->primary();
            $table->string('name');
            $table->string("color")->default("#000");
            $table->timestamps();
        });

        Schema::create('game_session', function (Blueprint $table) {
            $table->unsignedBigInteger("game_id")->nullable(false);
            $table->integer("session")->nullable(false);
            $table->string("country_tag", 3)->nullable(false);
            $table->string("overlord", 3)->nullable()->default(null);
            $table->timestamps();

            $table->index("overlord");
            $table->index(["game_id", "session", "country_tag"]);
            $table->primary(["game_id", "session", "country_tag"]);

            $table->foreign("country_tag")
                ->references("tag")
                ->on("country")
                ->onDelete("cascade");

            $table->foreign("game_id")
                ->references("id")
                ->on("game")
                ->onDelete("cascade");

            $table->foreign("overlord")
                ->references("country_tag")
                ->on("game_session")
                ->onDelete("set null");
        });

        Schema::create('country_historic_data', function (Blueprint $table) {
            $table->unsignedBigInteger("game_id")->nullable(false);
            $table->integer("session")->nullable(false);
            $table->string("country_tag", 3)->nullable(false);

            $table->index(["game_id", "session", "country_tag"]);
            $table->foreign(["game_id", "session", "country_tag"])
                ->references(["game_id", "session", "country_tag"])
                ->on("game_session")
                ->onDelete("cascade");

            //Discipline
            $table->float("discipline")->nullable(false)->default(0.0);
            $table->float("discipline_constant")->nullable(false)->default(0.0);
            $table->float("effective_discipline")->nullable(false)->default(0.0);

            //Morale
            $table->float("morale")->nullable(false)->default(0.0);
            $table->float("morale_constant")->nullable(false)->default(0.0);
            $table->float("effective_morale")->nullable(false)->default(0.0);

            //Infantry power
            $table->float("infantry_power")->nullable(false)->default(0.0);

            //Cavalry power
            $table->float("cavalry_power")->nullable(false)->default(0.0);
            
            //Artillery power
            $table->float("artillery_power")->nullable(false)->default(0.0);

            $table->float("force_limit")->nullable(false)->default(0.0);
            $table->float("max_manpower")->nullable(false)->default(0.0);
            $table->float("manpower_recovery")->nullable(false)->default(0.0);
            $table->integer("development_clicks")->nullable(false)->default(0.0);
            $table->float("income")->nullable()->default(0.0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_historic_data');
        Schema::dropIfExists('game_session');
        Schema::dropIfExists('country');
        Schema::dropIfExists('game');
        Schema::dropIfExists('users');
    }
};