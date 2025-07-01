<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerCategory extends Model
{
     use HasFactory;

    protected $table = 'career_category';
    public $timestamps = false;

    protected $fillable = [
        'banner_heading',
        'banner_image',
        'section_images',
        'introduction',
        'section_heading',
        'category_name',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];
}
