<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDesignsTable extends Migration {

    const DB_CONNECTION = 'pr';
    const DB_TABLE_KEY = 'id';
    const DB_NAME_SGL = 'design';
    const DB_NAME_PLR = 'designs';
    const DB_TABLE_TRAN = '_translations';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::connection(self::DB_CONNECTION)->create(self::DB_NAME_PLR, function (Blueprint $table) {
            $table->increments(self::DB_TABLE_KEY);
            $table->boolean('enabled')->default(0);
            $table->timestamps();
        });
		$s_fkey = self::DB_NAME_SGL.'_'.self::DB_TABLE_KEY;
        Schema::connection(self::DB_CONNECTION)->create(self::DB_NAME_SGL.self::DB_TABLE_TRAN, function (Blueprint $table) use ($s_fkey) {
            $table->increments(self::DB_TABLE_KEY);
            $table->unsignedInteger($s_fkey);
            $table->string('locale')->index();
            $table->string('name');
            $table->string('description');

            $table->unique([$s_fkey, 'locale']);
            $table->foreign($s_fkey)->references(self::DB_TABLE_KEY)->on(self::DB_NAME_PLR)->onDelete('cascade');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::connection(self::DB_CONNECTION)->dropIfExists(self::DB_NAME_SGL.self::DB_TABLE_TRAN);
        Schema::connection(self::DB_CONNECTION)->dropIfExists(self::DB_NAME_PLR);
	}

}
