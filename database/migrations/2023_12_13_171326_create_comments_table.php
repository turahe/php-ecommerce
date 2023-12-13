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
        Schema::create('comments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->nullableUlidMorphs('model');

            $table->string('title')->nullable();
            $table->text('content');
            $table->integer('published_at')->nullable();
            $table->string('type')->default('comment')->comment('comment, review ,testimony faq, featured');
            $table->unsignedBigInteger('record_left')->nullable();
            $table->unsignedBigInteger('record_right')->nullable();
            $table->unsignedBigInteger('record_ordering')->nullable();
            $table->ulid('parent_id')->nullable();

            $table->foreignUlid('created_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignUlid('updated_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignUlid('deleted_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->integer('created_at')->nullable();
            $table->integer('updated_at')->nullable();
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
