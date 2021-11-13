<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->decimal('price', 12, 2);
            $table->string("publisher");
            $table->text("description");
            $table->text("includes");
            $table->string("language");
            $table->integer("release_date");
            $table->integer("min_age");
            $table->integer("min_play_time");
            $table->integer("min_players");
            $table->integer("max_players");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
