<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->Increments('product_id');
            
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
            
            $table->string('p_name');
            $table->string('p_image')->nullable();
            $table->string('sku')->nullable();
            $table->Integer('type')->nullable();
            
            $table->text('sales_des')->nullable();
            $table->float('sales_price')->default(0.0)->nullable();
            $table->float('cost')->default(0.0)->nullable();
            
            $table->Integer('q_on_hand')->nullable();
            $table->Integer('reorder_point')->nullable();
            
            $table->Integer('asset_account')->nullable();
            $table->Integer('income_account')->nullable();
            $table->Integer('expense_account')->nullable();
            
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
