<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConcernReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concern_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('identifiers')->default(DB::raw('(UUID())'));
            // $table->string('user_nik');
            // $table->string('name');
            $table->integer('user_id');
            $table->text('description');
            $table->string('image');
            $table->string('status')->default('Not yet Process');
            $table->softDeletes();

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
        Schema::dropIfExists('concern_reports');
    }
}