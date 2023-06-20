<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuCategory extends Model
{
    use SoftDeletes, HasFactory , HasTranslations;

    protected $table = 'menu_categories';
    protected $translatable = ['name'];


    public function subMenu()
    {
        return $this->hasMany(Menu::class, 'category_id', 'id');
    }
}
