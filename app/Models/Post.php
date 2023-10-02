<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
class Post extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes,HasEagerLimit;
    public $translatedAttributes = ['title', 'content', 'small_desc','tags'];
    protected $fillable = ['main_img', 'user_id', 'category_id', 'status'];
    public function category()
    {
       return $this->belongsTo(Category::class , 'category_id');
    }


    public function user()
    {
       return $this->belongsTo(User::class , 'user_id');
    }
}
