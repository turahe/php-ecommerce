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
        Schema::create('posts', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('slug')->unique();
            $table->string('title');
            $table->foreignUlid('category_id');
            $table->longText('description')->nullable()->comment('description of post');
            $table->text('content_raw');
            $table->text('content_html');
            $table->string('type');
            $table->boolean('is_sticky')->default(false);

            $table->timestamp('published_at')->nullable();
            $table->string('language')->default('en');
            $table->string('layout')->nullable();

            $table->unsignedBigInteger('record_ordering');
            $table->unsignedBigInteger('record_left')->nullable();
            $table->unsignedBigInteger('record_right')->nullable();
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
        Schema::dropIfExists('posts');
    }
};
