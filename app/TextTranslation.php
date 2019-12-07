<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TextTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected static function boot()
    {
        static::saving(function ($model) {
            $model->slug = $model->slug ?: SlugService::createSlug(
                TextTranslation::class, 'slug', $model->name
            );
        });
    }
}
