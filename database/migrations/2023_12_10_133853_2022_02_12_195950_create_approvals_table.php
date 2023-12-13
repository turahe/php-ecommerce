<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    public function up()
    {
        Schema::create(table: 'approvals', callback: function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->nullableUlidMorphs(config(key: 'approval.approval.approval_pivot'));
            $table->enum('state', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('new_data')->nullable();
            $table->json('original_data')->nullable();
            $table->timestamp(column: 'rolled_back_at')->nullable();

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

    public function down()
    {
        Schema::dropIfExists(table: 'approvals');
    }
};
