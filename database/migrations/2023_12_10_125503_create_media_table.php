<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->unsignedBigInteger('record_left')->nullable();
            $table->unsignedBigInteger('record_right')->nullable();
            $table->unsignedBigInteger('record_dept')->nullable();
            $table->unsignedBigInteger('record_ordering')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('custom_attribute')->nullable();
            $table->softDeletes();
            $table->timestamps();
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
