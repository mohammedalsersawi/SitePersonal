<?php

namespace App\Models;

use App\Models\User;
use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use SoftDeletes, HasFactory, HasTranslations;
    protected $guarded = [];
    protected $translatable = ['name'];
    protected $appends = ['name_text'];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->where('status', 1);
    }
    public function MenuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id', 'id');
    }

    public function last_updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getNameTextAttribute()
    {
        return @$this->name;
    }

    // public function getNameCategoryAttribute()
    // {
    //     return @$this->MenuCategory->name;
    // }
    // public function getNameParentAttribute()
    // {
    //     if ($this->parent) {
    //         return $this->parent->name;
    //     }

    //     return null;
    // }
}
