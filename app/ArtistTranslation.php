<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ArtistTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
#        'profession',
        'description',
        'name'
    ];
}
