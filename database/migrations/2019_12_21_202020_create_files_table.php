<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
	const DB_CONNECTION = 'pr';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(self::DB_CONNECTION)->create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('filable_id')->unsigned()->nullable()->index();
            $table->string('filable_type')->nullable()->index();
            $table->string('title');
            $table->string('original')->nullable();
            $table->string('type')->nullable();
            $table->string('url');
            $table->string('path');
            $table->string('medium_image_url')->nullable();
            $table->string('medium_image_path')->nullable();
            $table->string('small_image_url')->nullable();
            $table->string('small_image_path')->nullable();
            $table->string('alt')->nullable();
            $table->string('size')->nullable();
            $table->string('role')->nullable();
            $table->integer('position')->unsigned()->nullable();
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
        Schema::connection(self::DB_CONNECTION)->dropIfExists('files');
    }
}
