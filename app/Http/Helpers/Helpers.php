<?php

use App\Models\Category;
use App\Models\Image;
use App\Models\Uplode;
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
function sendResponse($result = null, $msg = '')
{
    $response = [
        'success' => 200,
        'data' => $result,
        'message' => $msg,
    ];
    return response()->json($response, 200);
}
function languages()
{
    if (app()->getLocale() == 'de') {
        return ['ar' => 'arabic', 'de' => 'German'];
    } else {
        return ['ar' => 'العربية', 'de' => 'الالمانية'];
    }
}
function Uploads($file, $path = null, $file_type, $relation_id, $update = false, $id = null)
{
    $full_name = uniqid() . '.' . $file->getClientOriginalExtension();
    $public_path = 'uploads/' . $path . '/' . $full_name;
    $file->move(public_path('uploads/' . $path), $full_name);
    if (!$update) {
        Uplode::create([
            'name' =>  $file->getClientOriginalName(),
            'filename' =>  $full_name,
            'full_large_path' =>  $public_path,
            'full_original_path' => $public_path,
            'relation_id' => $relation_id,
            'path' => $path,
            'file_type' => $file_type,
        ]);
    } else {
        $dataFile = Uplode::where('relation_id', $relation_id)->where('file_type', $file_type)->first();
        if ($dataFile) {
            File::delete(public_path($dataFile->full_large_path));
            $dataFile->update([
                'name' => $file->getClientOriginalName(),
                'filename' => $full_name,
                'full_large_path' => $public_path,
                'full_original_path' => $public_path,
                'relation_id' => $relation_id,
                'path' => $path,
                'file_type' => $file_type,
            ]);
        } else {
            // إنشاء سجل جديد
            Uplode::create([
                'name' => $file->getClientOriginalName(),
                'filename' => $full_name,
                'full_large_path' => $public_path,
                'full_original_path' => $public_path,
                'relation_id' => $relation_id,
                'path' => $path,
                'file_type' => $file_type,
            ]);
        }
    }
}
