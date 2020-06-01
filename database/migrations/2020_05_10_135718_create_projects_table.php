<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('project_id');
            $table->string('name');
            $table->string('slag');
            $table->string('logo')->nullable();
            $table->integer('category_id');
            $table->integer('customer_id');
            $table->bigInteger('reference_id');
            $table->longText('description');
            $table->string('invoice');
            $table->string('ammount');
            $table->string('starting_date');
            $table->string('deadline');
            $table->integer('duration');
            $table->string('status');
            $table->string('privacy');
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
        Schema::dropIfExists('projects');
    }
}
