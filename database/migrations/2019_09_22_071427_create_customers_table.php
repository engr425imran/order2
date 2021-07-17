<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->Increments('cust_id');
            
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')
                  ->on('users')->onDelete('cascade');
            
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name');
            $table->string('company')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('other')->nullable();
            $table->string('website')->nullable();
            
            $table->string('b_street')->nullable();
            $table->string('b_city')->nullable();
            $table->string('b_state')->nullable();
            $table->string('b_postal')->nullable();
            $table->string('b_country')->nullable();
            
            $table->string('c_street')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_state')->nullable();
            $table->string('c_postal')->nullable();
            $table->string('c_country')->nullable();
            
            $table->text('note')->nullable();
            $table->string('vat_reg_no')->nullable();
            $table->Integer('payment_method')->nullable();
            $table->Integer('delivery_method')->nullable();
            $table->Integer('terms')->nullable();
            
            $table->float('opening_balance')->default(0.0);
            $table->date('as_of_date')->nullable();
            $table->string('att')->nullable();
            $table->string('status')->default(1);
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
        Schema::dropIfExists('customers');
    }
}
