<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagemetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messagemeta', function (Blueprint $table) {
            $table->id();
            $table->integer('message_id')->unsigned()->index()->nullable();
            $table->string('meta_key');
            $table->string('meta_value');
            $table->timestamps();            
        });

        Schema::table('messagemeta', function (Blueprint $table) {
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messagemeta');
    }
}
