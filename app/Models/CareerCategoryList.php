<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerCategoryList extends Model
{
    use HasFactory;

    protected $table = 'career_category_listing';
    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'banner_heading',
        'banner_image',
        'section_heading',
        'job_role',
        'slug',
        'department',
        'location',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    // CareerCategoryList.php
    public function category()
    {
        return $this->belongsTo(CareerCategory::class, 'category_id');
    }

}
