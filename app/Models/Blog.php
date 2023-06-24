<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['info', 'title' , 'description'];

    public function image()
    {
        return $this->belongsTo(Uplode::class, 'id', 'relation_id')->where('file_type', 'blog_cover');
    }
    public function albom()
    {
        return $this->hasMany(Uplode::class , 'relation_id')->where('file_type', 'blog_cover');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->withTrashed();
    }


    protected $appends = ['title_text'];


    public function getTitleTextAttribute()
    {
        return @$this->title;
    }

}
