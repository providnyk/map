<?php

namespace App;

use App\Traits\GeneralTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use GeneralTrait;
    use Translatable;

    public $translatedAttributes = [
        'name',
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
