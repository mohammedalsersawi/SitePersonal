<?php

use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


function rtl_assets()
{
    if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl') {
        return '-rtl';
    }
    return '';
}
function locale()
{
    return Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}
function locales()
{
    $arr = [];
    foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __('' . $value['name']);
    }
    return $arr;
}

function languages()
{
    if (app()->getLocale() == 'en') {
        return ['ar' => 'arabic', 'en' => 'english'];
    } else {
        return ['ar' => 'العربية', 'en' => 'النجليزية'];
    }
}
function UploadImage($file, $path = null, $model, $imageable_id, $update = false, $id = null, $type)
{

    $imagename = uniqid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('uploads/' . $path), $imagename);
    if (!$update) {
        Image::create([
            'filename' =>  $imagename,
            'imageable_id' => $imageable_id,
            'imageable_type' => $model,
            'type' => $type
        ]);
    } else {

        $image = Image::where('imageable_id', $imageable_id)->where('imageable_type', $model)->first();
        if ($id) {
            $image = Image::where('id', $id)->first();
        }
        if ($image) {
            File::delete(public_path('uploads/' . @$path . @$image->filename));
            $image->update(
                [
                    'filename' => $imagename,
                    'imageable_id' => $imageable_id,
                    'imageable_type' => $model,
                    'type' => $type
                ]
            );
        } else {
            Image::create([
                'filename' =>  $imagename,
                'imageable_id' => $imageable_id,
                'imageable_type' => $model,
                'type' => $type
            ]);
        }
    }
}
