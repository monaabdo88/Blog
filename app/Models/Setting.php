<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    protected $fillable = ['logo', 'favicon', 'facebook', 'twitter', 'site_mail', 'site_phone', 'site_status'];
    public $translatedAttributes = ['site_name', 'site_keywords', 'site_desc', 'site_copyrights', 'site_about', 'site_close_msg'];
}
