<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('file_name');
            $table->string('disk');
            $table->string('mime_type');
            $table->unsignedInteger('size');
            $table->string('custom_attribute')->nullable();

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

        Schema::create('mediables', function (Blueprint $table) {
            $table->foreignUlid('media_id')->index();
            $table->ulidMorphs('mediable');
            $table->string('group');

            $table->foreign('media_id')
                ->references('id')
                ->on('media')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('mediables');
        Schema::dropIfExists('media');
    }
};
