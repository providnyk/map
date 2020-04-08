<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePublishedColumnPlacesTable extends Migration
{
    const DB_CONNECTION = 'psc';
    const TABLE_MIGRATION = 'places';
    const FIELD_MIGRATION = 'published';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(self::DB_CONNECTION)->table(self::TABLE_MIGRATION, function (Blueprint $table) {
        	$table->integer(self::FIELD_MIGRATION)->default(1)->change();
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
        	$table->integer(self::FIELD_MIGRATION)->default(0)->change();
        });
    }
}
