<?php

declare(strict_types=1);

namespace Database\Seeders;

use                                             DB;
use                Illuminate\Database\Eloquent\Model as BaseModel;
use                                         App\Model;
use               Illuminate\Foundation\Testing\RefreshDatabaseState;
use                         Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $toTruncate =
    [
#        'country_translations'      => false,
#        'country'                 => true,
        'setting'                 => true,
    ];
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        # ---- truncate
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        foreach($this->toTruncate as $s_table_name => $b_seed) 
        {
            $s_model_main = Model::getModelNameWithNamespace($s_table_name);
            $s_model_seed = Model::seedTableMainAndTranslation($s_model_main);

            if ($b_seed && !RefreshDatabaseState::$migrated)
            {
                Model::getModelSeederWithNamespace($s_model_main, $s_model_seed, false);
            }

        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
        # ---- /truncate
    }
}
