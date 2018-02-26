<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration {
    /**
      * Run the migrations.
      *
      * @return void
      */
    public function up()
    {
        Schema::create('activity_log', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->nullable();
            $table->integer('content_id')->nullable();

            $table->string('content', 72)->nullable();
            $table->string('action', 32)->nullable();
            $table->string('state', 32)->nullable();

            $table->longText('details')->nullable();
            $table->longText('data')->nullable();

            $table->string('version', 10)->nullable();
            $table->string('ip_address', 64);
            $table->string('user_agent', 255);

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
      * Reverse the migrations.
      *
      * @return void
      */
    public function down()
    {
        Schema::drop('activity_log');
    }
}
