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
use App\Models\CareerCategoryList;
use App\Models\JobDetails; 

use Carbon\Carbon;

class JobDetailsController extends Controller
{

    public function index()
    {    
        $details = JobDetails::with('categoryList')->whereNull('deleted_by')->get();
        return view('backend.career.details.index', compact('details'));
    }

    public function create()
    {
        $jobRoles = CareerCategoryList::whereNull('deleted_by')->pluck('job_role', 'id');
        return view('backend.career.details.create', compact('jobRoles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'banner_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_category'   => 'required|integer|exists:career_category_listing,id',
            'section_heading'=> 'nullable|string|max:255',
            'job_details'    => 'nullable|string',
        ], [
            'banner_image.image'   => 'The banner must be an image.',
            'banner_image.mimes'   => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'     => 'The banner image must be less than 2MB.',
            'job_category.required'=> 'The job role is required.',
            'job_category.exists'  => 'The selected job role does not exist.',
        ]);

        $bannerImageName = null;

        // Upload banner image
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(100, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);
        }

        // Create a new job details record
        $jobDetails = new JobDetails(); // Replace with your actual model name
        $jobDetails->job_id  = $request->input('job_category');
        $jobDetails->banner_heading   = $request->input('banner_heading');
        $jobDetails->banner_image     = $bannerImageName;
        $jobDetails->section_heading  = $request->input('section_heading');
        $jobDetails->job_details      = $request->input('job_details');
        $jobDetails->inserted_by      = Auth::id();
        $jobDetails->inserted_at      = Carbon::now();

        $jobDetails->save();

        return redirect()->route('manage-job-details.index')->with('message', 'Job details added successfully.');
    }

    public function edit($id)
    {
        $details = JobDetails::findOrFail($id);
        $categories = CareerCategoryList::whereNull('deleted_by')->get();
        return view('backend.career.details.edit', compact('details','categories'));
    }

}