<?php

namespace App\Http\Controllers\API;

use App\File;
use Spatie\Image\Image as SpatieImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function file(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file'
        ]);

        $types = [
            'archive' => [
                'zip',
                'rar',
                '7z'
            ],
            'doc' => [
                'pdf',
                'doc',
                'docx',
            ],
        ];

        $file = $request->file;

        foreach($types as $file_type => $extensions) {
            if (array_search($file->getClientOriginalExtension(), $extensions) !== false) {
                $type = $file_type;
                break;
            } else {
                $type = 'doc';
            }
        }

        $today = today();
        $file_path = File::getRelativeStoragePath($today);
        $file_name = Storage::putFile($file_path, $file);
        $file_name = collect(explode('/', $file_name))->last();

        $file = File::create([
            'url'           => File::getFilePath($today) . $file_name,
            'path'          => $file_path . $file_name,
            'type'          => $type,
            'alt'           => $request->alt,
            'name'          => $file_name,
            'copyright'     => ($request->copyright ? $request->copyright : ''),
            'original'      => $file->getClientOriginalName(),
            'size'          => round($file->getSize() / 1024, 2)
        ]);

        return [
            'file'    => $file
        ];
    }

    public function image(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $sizes = [
            'small' => [
                'width' => 320,
                'height' => 240,
            ],
            'medium' => [
                'width' => 1024,
                'height' => 768,
            ]
        ];

        $original_image = $request->image;

        $today = today();
        $image_path = File::getRelativeStoragePath($today);

        $original_image_name = collect(explode('/',
                Storage::putFile($image_path, $original_image)
            ))
            ->last();

        $strings = explode('.', $original_image_name);

        $image_hash = $strings[0];
        $image_extension = $original_image->guessExtension();#$strings[1];

        $image_manipulator = SpatieImage::load($original_image);

        foreach ($sizes as $size => $dimensions) {
            $image_name = $image_hash . '-' . $size . '.' . $image_extension;
            $images[$size] = $image_name;

            $image_manipulator->width($dimensions['width'])
                ->height($dimensions['height'])
                ->save(
                    storage_path() . '/app/' . $image_path . $image_name
                );
        }

        $image_url = File::getFilePath($today);

        $image = File::create([
            'url'               => $image_url . $original_image_name,
            'path'              => $image_path . $original_image_name,
            'medium_image_url'  => $image_url . $images['medium'],
            'medium_image_path' => $image_path . $images['medium'],
            'small_image_url'   => $image_url . $images['small'],
            'small_image_path'  => $image_path . $images['small'],
            'type'              => 'image',
            'alt'               => $request->alt,
            'name'              => $original_image_name,
            'copyright'         => ($request->copyright ? $request->copyright : ''),
            'original'          => $original_image->getClientOriginalName(),
            'size'              => round($original_image->getSize() / 1024, 2),
        ]);

		$image['size'] = round($image['size']/1024, 2);

        return [
            'image'    => $image
        ];
    }
}
