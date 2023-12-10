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
        Schema::create('products', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('quantity');
            $table->decimal('price');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUlid('created_by')->nullable();
            $table->foreignUlid('updated_by')->nullable();
            $table->foreignUlid('deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
