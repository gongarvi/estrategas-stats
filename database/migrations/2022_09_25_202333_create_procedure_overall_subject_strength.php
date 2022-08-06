<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
        // $procedure = "
        // DROP PROCEDURE IF EXISTS `calculate_with_subject_strengths`;

        // CREATE  PROCEDURE `calculate_with_subject_strengths`(IN sessionId int)
        // BEGIN
        //     DECLARE overlordSubjectsStrengh FLOAT DEFAULT 0.0;
        //     DECLARE overlordStrength FLOAT DEFAULT 0.0;
        //     DECLARE total FLOAT DEFAULT 0.0;
        //     DECLARE tag VARCHAR(3) DEFAULT '';
        //     DECLARE countryHistoricDataId INT DEFAULT 0;
        //     DECLARE terminate BOOL DEFAULT FALSE;
        //     DECLARE collectCountryTag CURSOR FOR SELECT country_tag, country_historic_id FROM session_historic WHERE session_id = sessionId;
        //     DECLARE CONTINUE HANDLER FOR NOT FOUND SET terminate = FALSE;
        //     OPEN collectCountryTag;
        //     SET NOCOUNT ON;
        //     COUNTRY_TAG: LOOP
        //         FETCH collectCountryTag INTO tag, countryHistoricDataId;
        //         IF terminate = TRUE THEN
        //             LEAVE COUNTRY_TAG;
        //         END IF;
        //         SELECT SUM(chd.overall_strength) INTO overlordSubjectsStrengh FROM country_historic_data as chd INNER JOIN session_historic as sh ON sh.country_historic_id = chd.id WHERE sh.session_id = sessionId AND chd.overlord = tag;
        //         SELECT overall_strength INTO overlordStrength FROM country_historic_data WHERE id = countryHistoricDataId;
        //         IF overlordSubjectsStrengh IS NULL THEN
        //             SET overlordSubjectsStrengh = 0.0;
        //         END IF;
        //         SET total = overlordStrength + overlordSubjectsStrengh;
        //         UPDATE country_historic_data SET overall_strength_with_subjects = total WHERE id = countryHistoricDataId;
        //     END LOOP COUNTRY_TAG;
        //     CLOSE collectCountryTag;
        // END";

        // DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
