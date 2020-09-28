<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetracksTable extends Migration {

	const DB_CONNECTION		= 'psc';
	const DB_PREFIX			= 'pr';
	const DB_TABLE_KEY		= 'id';
	const DB_NAME_SGL		= 'track';
	const DB_NAME_PLR		= 'tracks';
	const DB_TABLE_TRAN 	= '_translations';
	const DB_NAME_SGL5		= 'user';
	const DB_NAME_PLR5		= 'users';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$s_tkey5	= self::DB_NAME_SGL5.'_'.self::DB_TABLE_KEY;
		Schema::connection(self::DB_CONNECTION)->create(self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey5) {
			$table->bigIncrements(self::DB_TABLE_KEY);
			$table->unsignedInteger($s_tkey5)->nullable()->comment('user who was lookiing to follow the route');
			$table->boolean('published')->default(0)->index();
			$table->string('response_status', 250)->nullable(FALSE)->default('')->index()->comment('response status as told by API which also might contain failure description in case of error');

			$table->string('travel_mode', 20)->nullable(FALSE)->default('')->index()->comment('means of transportation');
			$table->mediumInteger('length')->unsigned()->nullable(FALSE)->default(0)->index()->comment('travel distance in meters');
			$table->mediumInteger('time')->unsigned()->nullable(FALSE)->default(0)->index()->comment('travel time in seconds');
			$table->tinyInteger('route_selected')->nullable(FALSE)->default(-1)->index()->comment('the last route viewed by human is considered to be the route of their preference and selected for usage');
			$table->tinyInteger('route_qty')->nullable(FALSE)->default(-1)->index()->comment('how mane routes found between the 2 points');
			$table->decimal('from_lat', 9, 7)->nullable(FALSE)->default(0)->index();
			$table->decimal('from_lng', 10, 7)->nullable(FALSE)->default(0)->index();
			$table->decimal('to_lat', 9, 7)->nullable(FALSE)->default(0)->index();
			$table->decimal('to_lng', 10, 7)->nullable(FALSE)->default(0)->index();
			/**
			 *	The JSON alias was added in MariaDB 10.2.7
			 *	JSON is an alias for LONGTEXT introduced for compatibility reasons with MySQL's JSON data type
			 */
			$table->longtext('response_raw')->nullable(FALSE)->default('')->comment('response from API as is');

			$table->timestamps();
		});

		Schema::table(self::DB_PREFIX.'_'.self::DB_NAME_PLR, function (Blueprint $table) use ($s_tkey5) {
			$table->foreign($s_tkey5)->references(self::DB_TABLE_KEY)->on(self::DB_NAME_PLR5)->onDelete('cascade');
		});

		$s_fkey = self::DB_NAME_SGL.'_'.self::DB_TABLE_KEY;
		Schema::connection(self::DB_CONNECTION)->create(self::DB_NAME_SGL.self::DB_TABLE_TRAN, function (Blueprint $table) use ($s_fkey) {
			$table->increments(self::DB_TABLE_KEY);
			$table->bigInteger($s_fkey)->unsigned();
			$table->string('locale')->index();
			$table->string('title')->default('')->nullable(false);
			$table->string('from_address')->nullable(FALSE)->default('')->index()->comment('starting addrress as per google');
			$table->string('to_address')->nullable(FALSE)->default('')->index()->comment('destination addrress as per google');
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
