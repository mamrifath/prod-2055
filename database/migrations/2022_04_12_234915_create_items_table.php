<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('qty')->nullable();
            $table->string('brand')->nullable();
            $table->float('selling_price')->nullable();
            $table->float('buying_price')->nullable();
            $table->decimal('profit_margin')->nullable();
            $table->string('warranty')->nullable();
            $table->date('expiry_date')->nullable();
            $table->enum('status', ['Inactive', 'Active']);
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
        Schema::dropIfExists('items');
    }
}
