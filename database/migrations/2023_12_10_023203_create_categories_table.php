<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name')->unique();
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->integer('status')->default(0);
            NestedSet::columns($table);
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
        Schema::dropIfExists('categories');
    }
};
