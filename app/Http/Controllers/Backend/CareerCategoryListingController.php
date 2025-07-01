<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\CareerCategory;

use Carbon\Carbon;

class CareerCategoryListingController extends Controller
{

    public function index()
    {    
        return view('backend.career.listing.index');
    }
    
    public function create(Request $request)
    { 
        return view('backend.career.listing.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'banner_heading'     => 'nullable|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_heading'    => 'nullable|string|max:255',
            'job_role'           => 'required|string|max:255',
            'department'         => 'required|string|max:255',
            'location'           => 'required|string|max:255',
        ], [
            'banner_image.image'   => 'The banner must be an image.',
            'banner_image.mimes'   => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'     => 'The banner image must be less than 2MB.',
            'job_role.required'    => 'The job role is required.',
            'department.required'  => 'The department is required.',
            'location.required'    => 'The location is required.',
        ]);

        $bannerImageName = null;

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);
        }

        $careerCategory = new CareerCategoryList();
        $careerCategory->banner_heading  = $request->input('banner_heading');
        $careerCategory->banner_image    = $bannerImageName;
        $careerCategory->section_heading = $request->input('section_heading');
        $careerCategory->job_role        = $request->input('job_role');
        $careerCategory->department      = $request->input('department');
        $careerCategory->location        = $request->input('location');
        $careerCategory->inserted_at     = Carbon::now();
        $careerCategory->inserted_by     = Auth::id();

        $careerCategory->save();

        return redirect()->route('manage-category-listing.index')->with('message', 'Job created successfully.');
    }

}