<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteDesignColumnPointsTable extends Migration
{
    const DB_CONNECTION = 'psc';
    const TABLE_MIGRATION = 'points';
    const TABLE_AFTER = 'building_id';
    const TABLE_HASONE = 'designs';
    const HASONE_TABLE = 'design';
    const HASONE_KEY = 'id';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::connection(self::DB_CONNECTION)->table(self::TABLE_MIGRATION, function (Blueprint $table) {
            $table->dropForeign([self::HASONE_TABLE.'_'.self::HASONE_KEY]);
            $table->dropColumn(self::HASONE_TABLE.'_'.self::HASONE_KEY);
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::connection(self::DB_CONNECTION)->table(self::TABLE_MIGRATION, function (Blueprint $table) {
            $table->integer(self::HASONE_TABLE.'_'.self::HASONE_KEY)->unsigned()->nullable()->default(NULL)->after(self::TABLE_AFTER);
        });

        Schema::connection(self::DB_CONNECTION)->table(self::TABLE_MIGRATION, function (Blueprint $table) {
            $table->foreign(self::HASONE_TABLE.'_'.self::HASONE_KEY)->references(self::HASONE_KEY)->on(self::TABLE_HASONE)->onDelete('set null');
        });
	}

}
