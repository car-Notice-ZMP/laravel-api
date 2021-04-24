<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('message');
            $table->unsignedBigInteger('user_id');
            $table->string('notice_author')->nullable();
            $table->string('notice_author_email')->nullable();
            $table->string('author_avatar')->nullable();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->string('color')->nullable();
            $table->double('year')->nullable();
            $table->double('mileage')->nullable();
            $table->double('price')->nullable();
            $table->string('body')->nullable();
            $table->string('image')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
