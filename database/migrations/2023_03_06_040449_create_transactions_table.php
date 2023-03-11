<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('outlet_id')->unsigned();
            $table->foreign('outlet_id')->references('id')->on('outlets')->onDelete('cascade');
            $table->string('invoice_code');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->dateTime('date');
            $table->dateTime('deadline');
            $table->dateTime('payment_date')->nullable();
            $table->integer('additional_cost');
            $table->double('discount');
            $table->integer('tax');
            $table->integer('total');
            $table->enum('status', ['New', 'Processing', 'Completed', 'Taken'])->default('New');
            $table->enum('payment_status', ['Pending', 'Completed'])->default('Pending');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
