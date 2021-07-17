<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax', function (Blueprint $table) {
            $table->bigIncrements('tax_id');
            $table->string('tax_name', 150)->nullable();
            $table->integer('tax_amount')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('created_date', 20)->nullable();
            $table->string('created_time', 10)->nullable();
            $table->integer('updated_by')->nullable();
            $table->string('updated_date', 20)->nullable();
            $table->string('updated_time', 10)->nullable();
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
        Schema::dropIfExists('tax');
    }
}
