<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Spravit toto az po cviceni
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn("name", "first_name");
            $table->string("surname");
            $table->string("city");
            $table->string("street");
            $table->string("country");
            $table->string("postal_code");
            $table->string("phone_number");
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
            $table->renameColumn('first_name', 'name');
            $table->dropColumn('surname');
            $table->dropColumn('city');
            $table->dropColumn('street');
            $table->dropColumn('country');
            $table->dropColumn('postal_code');
            $table->dropColumn('phone_number');
        });
    }
}
