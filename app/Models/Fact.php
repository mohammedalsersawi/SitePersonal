<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fact extends Model
{
    use HasFactory, HasTranslations;
    protected $guarded = [];

    protected $translatable = ['key'];
    protected $appends = ['key_text'];

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function getKeyTextAttribute()
    {
        return @$this->key;
    }

    }
