<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUserToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
            $table->string('surname')->nullable()->change();
            $table->string('city')->nullable()->change();
            $table->string('street')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->string('postal_code')->nullable()->change();
            $table->string('phone_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('surname')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('street')->nullable(false)->change();
            $table->string('country')->nullable(false)->change();
            $table->string('postal_code')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
        });
    }
}
