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

use Carbon\Carbon;

class CareerCategoryListingController extends Controller
{

    public function index()
    {    
        $details = CareerCategoryList::with('category')->whereNull('deleted_by')->get();
        return view('backend.career.listing.index', compact('details'));
    }
    
    public function create()
    {
        $categories = CareerCategory::whereNull('deleted_by')->get();
        return view('backend.career.listing.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_category'       => 'required|integer|exists:career_category,id',
            'banner_heading'     => 'nullable|string|max:255',
            'section_heading'     => 'nullable|string|ma',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_role'           => 'required|string|max:255',
            'department'         => 'required|string|max:255',
            'location'           => 'required|string|max:255',
        ], [
            'job_category.required' => 'The job category is required.',
            'job_category.integer'  => 'Invalid job category selected.',
            'job_category.exists'   => 'Selected category does not exist.',
            'banner_image.image'    => 'The banner must be an image.',
            'banner_image.mimes'    => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'      => 'The banner image must be less than 2MB.',
            'job_role.required'     => 'The job role is required.',
            'department.required'   => 'The department is required.',
            'location.required'     => 'The location is required.',
        ]);


        $bannerImageName = null;

        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);
        }

        $careerCategory = new CareerCategoryList();
        $careerCategory->category_id = $request->input('job_category');
        $careerCategory->banner_heading   = $request->input('banner_heading');
        $careerCategory->banner_image     = $bannerImageName;
        $careerCategory->section_heading   = $request->input('section_heading');
        $careerCategory->job_role         = $request->input('job_role');
        $careerCategory->slug             = Str::slug($request->input('job_role'));
        $careerCategory->department       = $request->input('department');
        $careerCategory->location         = $request->input('location');
        $careerCategory->inserted_at      = Carbon::now();
        $careerCategory->inserted_by      = Auth::id();

        $careerCategory->save();

        return redirect()->route('manage-category-listing.index')->with('message', 'Job created successfully.');
    }


    public function edit($id)
    {
        $details = CareerCategoryList::findOrFail($id);
        $categories = CareerCategory::whereNull('deleted_by')->get();
        return view('backend.career.listing.edit', compact('details','categories'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'job_category'       => 'required|integer|exists:career_category,id',
            'banner_heading'     => 'nullable|string|max:255',
            'section_heading'    => 'nullable|string',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'job_role'           => 'required|string|max:255',
            'department'         => 'required|string|max:255',
            'location'           => 'required|string|max:255',
        ], [
            'job_category.required' => 'The job category is required.',
            'job_category.integer'  => 'Invalid job category selected.',
            'job_category.exists'   => 'Selected category does not exist.',
            'banner_image.image'    => 'The banner must be an image.',
            'banner_image.mimes'    => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'      => 'The banner image must be less than 2MB.',
            'job_role.required'     => 'The job role is required.',
            'department.required'   => 'The department is required.',
            'location.required'     => 'The location is required.',
        ]);

        $careerCategory = CareerCategoryList::findOrFail($id);

        // Handle new banner image if uploaded
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);

            $careerCategory->banner_image = $bannerImageName;
        }

        // Update other fields
        $careerCategory->category_id      = $request->input('job_category');
        $careerCategory->banner_heading   = $request->input('banner_heading');
        $careerCategory->section_heading  = $request->input('section_heading');
        $careerCategory->job_role         = $request->input('job_role');
        $careerCategory->slug             = Str::slug($request->input('job_role'));
        $careerCategory->department       = $request->input('department');
        $careerCategory->location         = $request->input('location');
        $careerCategory->modified_at       = Carbon::now();
        $careerCategory->modified_by       = Auth::id();

        $careerCategory->save();

        return redirect()->route('manage-category-listing.index')->with('message', 'Job updated successfully.');
    }


     public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CareerCategoryList::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-category-listing.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}