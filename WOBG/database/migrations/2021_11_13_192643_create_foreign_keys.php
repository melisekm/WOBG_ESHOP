<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('product_category_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('product_sub_category_id')->nullable()->constrained()->onDelete('set null');
        });
        Schema::table('product_photos', function (Blueprint $table) {
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->dropForeign(['product_sub_category_id']);
        });
        Schema::table('product_photos', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
}
