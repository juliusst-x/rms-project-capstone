<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('responses')) {
            Schema::create('responses', function (Blueprint $table) {
                $table->id();
                $table->uuid('identifiers')->default(DB::raw('(UUID())'));
                $table->integer('concern_id');
                $table->string('response', 255);
                $table->integer('user_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
