<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voters', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('sponsor_id')->nullable();
            $table->foreign('sponsor_id')->references('id')->on('voters')->onDelete('cascade');

            $table->string('name');
            $table->string('surname')->nullable();
            $table->date('birthday')->nullable();
            $table->smallInteger('years_approximate')->nullable();
            $table->string('image')->nullable();

            $table->boolean( 'death' )->default( 0 );
            $table->date('death_date')->nullable();

            $table->string('cpf',20)->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp',20)->nullable();
            $table->string('other_phones')->nullable();
            $table->string('instagram')->nullable();

            $table->string('voter_registration_zone')->nullable();
            $table->string('voter_registration_session')->nullable();
            $table->mediumText('social_history')->nullable();
            $table->integer('votes_estimate')->default(0);
            $table->smallInteger('votes_degree_certainty')->default(0);
            $table->boolean( 'supporter' )->default( 1 );
            $table->boolean( 'electoral_campaigner' )->default( 0 );

            $table->boolean( 'status' )->default( 1 );

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voters');
    }
}
