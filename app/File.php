<?php

namespace App;

use Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class File extends Model
{
    protected $fillable = [
        'type',
        'path',
        'medium_image_url',
        'medium_image_path',
        'small_image_url',
        'small_image_path',
        'name',
        'size',
        'url',
        'alt',
        'position',
        'original',
    ];

    protected $hidden = [
        'filable_type',
        'filable_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('position');
        });

        static::deleted(function($model) {
            Storage::delete($model->path);

            if($model->medium_image_path){
                Storage::delete($model->medium_image_path);
            }

            if($model->small_image_path){
                Storage::delete($model->small_image_path);
            }
        });
    }

    public function filable()
    {
        return $this->morphTo();
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public static function getRelativeStoragePath($today)
    {
        return 'public/' . $today->year . '/' . $today->month . '/';
    }

    public static function getFilePath($today)
    {
        return '/storage/' . $today->year . '/' . $today->month . '/';
    }

	public function showImage($image_size)
	{
		# https://stackoverflow.com/questions/29300331/laravel-responsedownload-to-show-images-in-laravel
		/*
		Storage::download() allows you to inject HTTP headers into the response. By default, it includes
		a sneaky 'Content-Disposition:attachment', this is why your browser doesn't "display" the picture, and triggers download instead
		You want to turn that into a 'Content-Disposition:inline'.
		Here's how to overwrite it:
		*/
		/*
		# Overwrite the annoying header
		*/
		$s_path = '';
		if ($image_size != '')
			$s_path = $image_size . '_image_';
		$headers = array(
			'Content-Disposition' => 'inline',
		);
		return Storage::download($this->{$s_path . 'path'}, Str::ascii($this->original['original']), $headers);
	}

	public function downloadImage()
	{
		return response()->download(getcwd() . $this->url, $this->original['original'], [ 'Content-Type' => Storage::getMimeType($this->path) ]);
	}

    function getSmallImageUrlAttribute($value){
        return $value ? $value : '/admin/images/no-image-logo.jpg';
    }
}
