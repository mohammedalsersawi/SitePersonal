<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['name'];
    protected $appends = ['name_text'];

    public function getNameTextAttribute()
    {
        return @$this->name;
    }
}
