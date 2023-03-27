<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];

    const IMAGE = 1;
    const VIDEO = 2;
    public function getTypeAttachmentAttribute()
    {
        if ($this->type == 2) {
            return  'video';
        } else {
            return  'image';
        }
    }
    public function imageable()
    {
        return $this->morphTo();
    }
}
