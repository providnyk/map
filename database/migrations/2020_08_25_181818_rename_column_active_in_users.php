<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnActiveInUsers extends Migration
{
    const DB_CONNECTION     = 'mysql';
    const TABLE_MIGRATION   = 'users';
    const COLUMN_OLDNAME    = 'active';
    const COLUMN_NEWNAME    = 'enabled';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(self::DB_CONNECTION)->table(self::TABLE_MIGRATION, function (Blueprint $table) {
            $table->renameColumn(self::COLUMN_OLDNAME, self::COLUMN_NEWNAME);
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
            $table->renameColumn(self::COLUMN_NEWNAME, self::COLUMN_OLDNAME);
        });
    }
}
