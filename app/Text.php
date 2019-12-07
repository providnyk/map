<?php

namespace App;

use App\Traits\GeneralTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use GeneralTrait;
    use Translatable;

    protected $fillable = [
        'name',
        'codename',
    ];

    public $translatedAttributes = [
        'name',
        'slug',
        'description',
    ];

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
