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
        Schema::create('campuses', function (Blueprint $table) {
            
            $table->increments('id');

            $table->string('name',20)->unique();
            
            $table->string('address',60);
            $table->string('phone',15);
            $table->string('email',30);
            
            $table->tinyInteger('active_session');
            $table->string('logo',100)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_delete')->default(0);

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
        Schema::dropIfExists('campuses');
    }
};
