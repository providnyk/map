<?php

namespace App;

use App\Traits\Filable;

use App\Traits\GeneralTrait;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use Filable;

    use Translatable;
    use GeneralTrait;

    protected $fillable = [
        'city_id'
    ];

    public $translatedAttributes = [
        'name',
    ];

    public function city()
    {
        return $this->belongsTo('App\City');
    }
    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }

}
