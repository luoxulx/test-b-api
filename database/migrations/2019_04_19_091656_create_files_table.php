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
            $table->string('path', 225)->nullable()->comment('七牛云 path-key');
            $table->string('original_name', 225)->nullable()->comment('original_name');
            $table->string('mime', 64)->nullable()->comment('mime');
            $table->string('size', 32)->nullable()->comment('size');
            $table->string('hash', 225)->nullable()->comment('七牛云hash');
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
