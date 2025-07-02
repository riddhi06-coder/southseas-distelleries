<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use App\Models\CareerCategory;
use App\Models\CareerCategoryList;
use App\Models\JobDetails; 

use Carbon\Carbon;

class JobDetailsController extends Controller
{

    public function index()
    {
        $details = DB::table('job_details')
            ->join('career_category_listing', 'job_details.job_id', '=', 'career_category_listing.id')
            ->join('career_category', 'career_category_listing.category_id', '=', 'career_category.id')
            ->whereNull('job_details.deleted_by')
            ->select(
                'job_details.id',
                'job_details.banner_heading',
                'job_details.banner_image',
                'job_details.section_heading',
                'job_details.job_details as job_description',
                'career_category_listing.job_role',
                'career_category.category_name'
            )
            ->get();

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
            'banner_heading'   => 'nullable|string|max:255',
            'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_category'     => [
                'required',
                'integer',
                'exists:career_category_listing,id',
                Rule::unique('job_details', 'job_id')->whereNull('deleted_by'),
            ],
            'section_heading'  => 'nullable|string|max:255',
            'job_details'      => 'nullable|string',
        ], [
            'banner_image.image'    => 'The banner must be an image.',
            'banner_image.mimes'    => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'      => 'The banner image must be less than 2MB.',
            'job_category.required' => 'The job role is required.',
            'job_category.exists'   => 'The selected job role does not exist.',
            'job_category.unique'   => 'This job role already exists.',
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

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'banner_heading'   => 'nullable|string|max:255',
            'banner_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_category'     => 'required|integer|exists:career_category_listing,id',
            'section_heading'  => 'nullable|string|max:255',
            'job_details'      => 'nullable|string',
        ], [
            'banner_image.image'   => 'The banner must be an image.',   
            'banner_image.mimes'   => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'     => 'The banner image must be less than 2MB.',
            'job_category.required'=> 'The job role is required.',
            'job_category.exists'  => 'The selected job role does not exist.',
        ]);

        $jobDetails = JobDetails::findOrFail($id);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(100, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);

            $jobDetails->banner_image = $bannerImageName;
        }

        // Update other fields
        $jobDetails->job_id         = $request->input('job_category');
        $jobDetails->banner_heading = $request->input('banner_heading');
        $jobDetails->section_heading = $request->input('section_heading');
        $jobDetails->job_details    = $request->input('job_details');
        $jobDetails->modified_by    = Auth::id();
        $jobDetails->modified_at    = Carbon::now();

        $jobDetails->save();

        return redirect()->route('manage-job-details.index')->with('message', 'Job details updated successfully.');
    }


     public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = JobDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-job-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}