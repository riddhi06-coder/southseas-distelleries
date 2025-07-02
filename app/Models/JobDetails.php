<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobDetails extends Model
{
    use HasFactory;

    protected $table = 'job_details';
    public $timestamps = false;

    protected $fillable = [
        'job_id',
        'banner_heading',
        'banner_image',
        'section_heading',
        'job_details',
        'inserted_at',
        'inserted_by',
        'modified_at',
        'modified_by',
        'deleted_at',
        'deleted_by',
    ];

    public function category()
    {
        return $this->belongsTo(CareerCategory::class, 'category_name'); 
    }

    public function categoryList()
    {
        return $this->belongsTo(CareerCategoryList::class, 'job_id', 'id');
    }




}
