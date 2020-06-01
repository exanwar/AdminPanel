<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slag');
            $table->bigInteger('category');
            $table->string('image')->nullable();
            $table->string('duration');
            $table->string('price');
            $table->string('status');
            $table->mediumText('short_description');
            $table->longText('description');
            $table->longText('responsibilities_duties');
            $table->mediumText('required_things');
            $table->integer('rating');
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
        Schema::dropIfExists('services');
    }
}
