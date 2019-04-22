<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename', 225)->nullable()->comment('filename');
            $table->string('original_name', 225)->nullable()->comment('original_name');
            $table->string('mime', 128)->nullable()->comment('mime');
            $table->string('size', 16)->nullable()->comment('size');
            $table->string('real_path', 225)->nullable()->comment('real_path');
            $table->string('relative_url', 225)->nullable()->comment('relative_url');
            $table->string('url', 225)->nullable()->comment('url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
