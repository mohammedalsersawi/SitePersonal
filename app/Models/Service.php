<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{

    use HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['name', 'description'];

    protected $appends = ['description_text' , 'name_text'];


    public function getNameTextAttribute()
    {
        return @$this->name;
    }
    public function getDescriptionTextAttribute()
    {
        return @$this->description;
    }
}
