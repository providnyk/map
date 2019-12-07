<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;

    protected $fillable = [
        'name',
        'value',
    ];

    public $translatedAttributes = [
        'translated_value'
    ];

    public $timestamps = false;

    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->firstOrFail();
    }
}
