<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invdetails', function (Blueprint $table) 
        {
            $table->unsignedInteger('invoice_id');
            $table->foreign('invoice_id')->references('invoice_id')
                  ->on('invoices')->onDelete('cascade');
            
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('product_id')
                  ->on('products')->nulable();
            $table->text('description')->nullable();
            $table->Integer('quantity');
            $table->float('rate');
            $table->float('total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invdetails');
    }
}
