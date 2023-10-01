<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes, HasEagerLimit;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['thumbnail', 'parent_id', 'status'];
    public function parents()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }
    
    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function posts()
    {
       return $this->hasMany(Post::class);
    }
}
