<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrsMstrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prs_mstr', function (Blueprint $table) {
            $table->integer('prs_nbr')->primary();
            $table->string('prs_name', 50);
            $table->string('prs_role', 50);
            $table->char('prs_active', 1)->default('Y');
            $table->dateTime('prs_added');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prs_mstr');
    }
}
