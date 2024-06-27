<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewfieldsToVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->text('registrar_observations')->after('votes_degree_certainty')->nullable();
            $table->text('admin_observations')->after('votes_degree_certainty')->nullable();
            $table->string('polling_place')->after('votes_degree_certainty')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voters', function (Blueprint $table) {
            $table->dropColumn('polling_place');
            $table->dropColumn('admin_observations');
            $table->dropColumn('registrar_observations');
        });
    }
}
