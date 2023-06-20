<?php

namespace App\Models;

use App\Models\Uplode;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['info', 'title'];

    public function image()
    {
        return $this->belongsTo(Uplode::class, 'id', 'relation_id')->where('file_type', 'feature_cover');
    }

    protected $appends = ['info_text', 'title_text'];


    public function getInfoTextAttribute()
    {
        return @$this->info;
    }
    public function getTitleTextAttribute()
    {
        return @$this->title;
    }

}
