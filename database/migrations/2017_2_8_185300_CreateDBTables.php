<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDBTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('members')) {
            Schema::create('members', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();

                $table->string('email')->unique();
            });
        }

        if (!Schema::hasTable('schools')) {
            Schema::create('schools', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();

                $table->string('name')->unique();
            });
        }

        if (!Schema::hasTable('member_school')) {
            Schema::create('member_school', function (Blueprint $table) {
                $table->unsignedInteger('member_id');
                $table->unsignedInteger('school_id');

                $table->unique(['member_id', 'school_id']);
                $table->foreign('member_id')->references('id')->on('members');
                $table->foreign('school_id')->references('id')->on('schools');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_school');
        Schema::dropIfExists('schools');
        Schema::dropIfExists('members');
    }
}
