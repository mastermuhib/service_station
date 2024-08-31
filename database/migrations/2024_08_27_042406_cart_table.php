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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete(null)
                    ->onUpdate(null);
            $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete(null)
                    ->onUpdate(null);
            $table->integer('qty')->default(1);
            $table->integer('is_checked')->default(1);
            $table->date('deleted_at')->nullable();
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
        Schema::dropIfExists('carts');
    }
};
