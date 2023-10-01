<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = ['title', 'content', 'small_desc','tags','post_id'];
}
