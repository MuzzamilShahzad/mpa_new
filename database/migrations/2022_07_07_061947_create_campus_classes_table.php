<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus_classes', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->unsignedInteger('campus_details_id')->nullable();
            $table->foreign('campus_details_id')->references('id')->on('campus_details')->onDelete('cascade');

            $table->unsignedInteger('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');

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
        Schema::dropIfExists('campus_classes');
    }
};
