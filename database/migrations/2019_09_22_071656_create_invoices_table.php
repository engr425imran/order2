<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) 
        {
            $table->increments('invoice_id');
            
            $table->unsignedInteger('cust_id');
            $table->foreign('cust_id')->references('cust_id')
                  ->on('customers')->onDelete('cascade');
            
            $table->string('email')->nullable();
            $table->string('bill_address')->nullable();
            
            $table->Integer('terms');
            $table->date('invoice_date');
            $table->date('due_date');
            
            $table->text('msg_invoice')->nullable();
            $table->text('msg_state')->nullable();
            $table->string('attach_file')->nullable();
            
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
        Schema::dropIfExists('invoices');
    }
}
