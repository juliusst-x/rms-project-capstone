<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->id();
            $table->uuid('identifiers')->default(DB::raw('(UUID())'));
            $table->integer('trash_level')->default(0);
            $table->integer('threshold')->default(8);
            $table->integer('area_id');
            $table->string('status')->default('Empty');
            $table->timestamp('Created_at')->useCurrent();
            $table->timestamp('Updated_at')->useCurrent();
            $table->timestamp('Notif_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trashes');
    }
}
