<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesOpinionsTable extends Migration {

	const DB_CONNECTION = 'psc';
	const DB_PREFIX = 'pr';

	const DB_NAME_SGL = 'opinion';
	const DB_NAME_PLR = 'opinions';

	const DB_TABLE_KEY = 'id';
	const DB_NAME_SGL1 = 'element';
	const DB_NAME_SGL2 = 'mark';
	const DB_NAME_SGL3 = 'opinion';
	const DB_NAME_SGL4 = 'place';
	const DB_NAME_SGL5 = 'user';
	const DB_NAME_PLR1 = 'elements';
	const DB_NAME_PLR2 = 'marks';
	const DB_NAME_PLR3 = 'opinions';
	const DB_NAME_PLR4 = 'places';
	const DB_NAME_PLR5 = 'users';

	const TABLE_HASONE = 'users';
	const HASONE_TABLE = 'user';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$s_tname	= self::DB_NAME_PLR;
		$s_tkey1	= self::DB_NAME_SGL1.'_'.self::DB_TABLE_KEY;
		$s_tkey2	= self::DB_NAME_SGL2.'_'.self::DB_TABLE_KEY;
		$s_tkey3	= self::DB_NAME_SGL3.'_'.self::DB_TABLE_KEY;
		$s_tkey4	= self::DB_NAME_SGL4.'_'.self::DB_TABLE_KEY;
		$s_tkey5	= self::DB_NAME_SGL5.'_'.self::DB_TABLE_KEY;

		/**
		 * remove duplicate values so we could create unique index
		 */
		Schema::table(self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4, $s_tkey5) {
			DB::statement(
				'DELETE p2 FROM `' . self::DB_PREFIX . '_' . self::DB_NAME_PLR . '` AS p2 CROSS JOIN
				(
					SELECT p1.`id`
					FROM `' . self::DB_PREFIX . '_' . self::DB_NAME_PLR . '` as p1
					INNER JOIN (
						SELECT `' . $s_tkey4 . '`, `' . $s_tkey5 . '`,  count(*)  as rows
						FROM `pr_opinions`
						GROUP BY `' . $s_tkey4 . '`, `' . $s_tkey5 . '`
						HAVING count(rows) > 1) as p
					WHERE p.`' . $s_tkey4 . '` = p1.`' . $s_tkey4 . '` and p.`' . $s_tkey5 . '` = p1.`' . $s_tkey5 . '`
				) AS pp
				USING (id)
				;'
			);
		});

		/**
		 * remove malfomed names for foreign key
		 */
		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4) {
			$s_tmp = 'opinions_' . $s_tkey4 . '_foreign';
			$table->dropForeign($s_tmp);
			$table->dropIndex($s_tmp);
		});
		/**
		 * create foreign key correct way
		 */
		Schema::connection(self::DB_CONNECTION)->table(self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4) {
			$table->index($s_tkey4);
			$table->foreign($s_tkey4)->references(self::DB_TABLE_KEY)->on(self::DB_NAME_PLR4)->onDelete('cascade');
		});

		/**
		 * add new foreign key to users table
		 */
		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey5) {
			$table->index($s_tkey5);
			$table->foreign($s_tkey5)->references(self::DB_TABLE_KEY)->on(self::TABLE_HASONE)->onDelete('cascade');
		});

		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4, $s_tkey5) {
			$table->unique([$s_tkey4, $s_tkey5]);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$s_tname	= self::DB_NAME_PLR;
		$s_tkey1	= self::DB_NAME_SGL1.'_'.self::DB_TABLE_KEY;
		$s_tkey2	= self::DB_NAME_SGL2.'_'.self::DB_TABLE_KEY;
		$s_tkey3	= self::DB_NAME_SGL3.'_'.self::DB_TABLE_KEY;
		$s_tkey4	= self::DB_NAME_SGL4.'_'.self::DB_TABLE_KEY;
		$s_tkey5	= self::DB_NAME_SGL5.'_'.self::DB_TABLE_KEY;

		/**
		 * remove foreign key with new correct name
		 */
		Schema::connection(self::DB_CONNECTION)->table(self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4) {
			$table->dropForeign([$s_tkey4]);
			$table->dropIndex([$s_tkey4]);
		});
		/**
		 * remove new foreign key to users table
		 */
		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey5) {
			$table->dropForeign([$s_tkey5]);
			$table->dropIndex([$s_tkey5]);
		});

		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4, $s_tkey5) {
			$table->dropUnique([$s_tkey4, $s_tkey5]);
		});

		/**
		 * create foreign key with old incorrect name
		 */
		Schema::connection(self::DB_CONNECTION)->table(self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey4) {
			$table->foreign($s_tkey4)->references(self::DB_TABLE_KEY)->on(self::DB_NAME_PLR4)->onDelete('cascade');
		});
	}

}
