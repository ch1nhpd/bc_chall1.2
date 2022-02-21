<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAssesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_asses', function (Blueprint $table) {
            $table->integer('account_id')->unsigned();
            $table->integer('assignment_id')->unsigned();
            $table->string('link_file');
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts') ->onDelete('cascade');
            $table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_asses');
    }
}
