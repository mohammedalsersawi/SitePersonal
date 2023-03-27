<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class About extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    protected $translatable = ['name' ,'about' , 'description' ,'freelance'  ,'degree' ,'city'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
        // return $this->belongsTo(Image::class, 'id','imageable_id')->where('imageable_type','App\Models\About');

    }
}
