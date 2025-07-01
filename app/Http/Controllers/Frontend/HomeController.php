<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\CareerCategory;
use App\Models\CareerCategoryList;


use Carbon\Carbon;

class HomeController extends Controller
{


    public function index()
    {
        $banner = CareerCategory::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->first();
        $details = CareerCategory::wherenull('deleted_by')->get();

        return view('frontend.careers', compact('banner','details'));
    }
    


    public function career_category($slug)
    {
        $job = CareerCategory::where('category_slug', $slug)->whereNull('deleted_by')->firstOrFail();

        $banner = CareerCategoryList::where('category_id', $job->id)
                    ->whereNull('deleted_by')
                    ->orderBy('inserted_at', 'asc')
                    ->first();

        $details = CareerCategoryList::where('category_id', $job->id)
                    ->whereNull('deleted_by')
                    ->get();

        return view('frontend.career-listing', compact('job', 'banner', 'details'));
    }



}