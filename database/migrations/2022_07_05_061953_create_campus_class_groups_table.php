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
        Schema::create('campus_class_groups', function (Blueprint $table) {
            
            $table->increments('id');
            
            $table->unsignedInteger('campus_class_id')->nullable();
            $table->foreign('campus_class_id')->references('id')->on('campus_classes')->onDelete('cascade');

            $table->unsignedInteger('class_group_id')->nullable();
            $table->foreign('class_group_id')->references('id')->on('class_groups')->onDelete('cascade');

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
        Schema::dropIfExists('campus_class_groups');
    }
};
