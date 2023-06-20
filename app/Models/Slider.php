<?php

namespace App\Models;

use App\Models\Uplode;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['info', 'title', 'button'];

    public function image()
    {
        return $this->belongsTo(Uplode::class, 'id', 'relation_id')->where('file_type', 'slider_cover');
    }

    protected $appends = ['info_text', 'title_text', 'button_text'];


    public function getInfoTextAttribute()
    {
        return @$this->info;
    }
    public function getTitleTextAttribute()
    {
        return @$this->title;
    }
    public function getButtonTextAttribute()
    {
        $button = $this->button;
        if ($button) {
            return $button;
        } else {
            return "********";
        }
    }
}
