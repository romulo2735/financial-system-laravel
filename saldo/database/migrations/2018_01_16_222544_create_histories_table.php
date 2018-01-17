<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->increments          ('id');
            $table->integer             ('user_hist')->unsigned();
            $table->integer             ('user_hists')->references('id')->on('users')->onDelete('cascade');
            $table->enum                ('type' , ['I', 'O' , 'T']);
            $table->double              ('amount', 10 , 2);
            $table->double              ('total_before', 10, 2);
            $table->double              ('total_after', 10, 2);
            $table->integer             ('user_id_transaction')->nullable();
            $table->date                ('date');
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
        Schema::dropIfExists('histories');
    }
}
