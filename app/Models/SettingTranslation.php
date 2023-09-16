<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['site_name', 'site_keywords', 'site_desc', 'site_copyrights', 'site_about', 'site_close_msg'];
}
