<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name', 64);
            $table->string('last_name', 64);
            $table->string('username', 64)->unique();
            $table->string('email', 254)->unique();
            $table->string('password', 255);
            $table->boolean('active')->nullable();
            $table->boolean('approved')->nullable();
            $table->unsignedInteger('approved_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('username');
            $table->index('email');
            $table->index('active');
            $table->index('approved');

            // Foreign Keys
            $table->foreign('approved_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
