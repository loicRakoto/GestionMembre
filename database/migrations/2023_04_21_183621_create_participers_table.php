<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activite_id')->constrained();
            $table->foreignId('membre_id')->constrained();
            $table->string('Status_payement');
            $table->bigInteger('Reste');
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
        Schema::dropIfExists('participers');
    }
}
