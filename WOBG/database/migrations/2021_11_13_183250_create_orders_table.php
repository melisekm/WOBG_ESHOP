<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("email");
            $table->string("first_name");
            $table->string("surname");
            $table->decimal("total", 12, 2);
            $table->string("postal_code");
            $table->string("country");
            $table->string("street");
            $table->string("city");
            $table->string("phone_number");
            $table->integer("payment");
            $table->integer("shipping");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
