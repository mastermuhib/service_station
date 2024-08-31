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
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete(null)
                    ->onUpdate('cascade');
            $table->foreign('address_id')
                    ->references('id')
                    ->on('address')
                    ->onDelete(null)
                    ->onUpdate('cascade');
            $table->float('nominal')->nullable();
            $table->float('discount')->nullable();
            $table->float('total')->nullable();
            $table->float('transaction_fee')->nullable();
            $table->float('delivery_fee')->nullable();
            $table->date('deleted_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
