<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evidence', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name');
            $table->string('location')->unique();
            $table->string('type');
            $table->string('userType');
            $table->integer('userId');
            $table->string('url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evidence');
    }
}
