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

class CareerListingController extends Controller
{

    public function index()
    {    
        $details = CareerCategory::whereNull('deleted_by')
                    ->get();

        return view('backend.career.category.index', compact('details'));
    }
    
    public function create(Request $request)
    { 
        return view('backend.career.category.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'banner_heading'     => 'nullable|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_images'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'introduction'       => 'nullable|string',
            'section_heading'    => 'nullable|string|max:255',
            'category_name'      => 'required|string|max:255',
        ], [
            'banner_image.image'         => 'The banner must be an image.',
            'banner_image.mimes'         => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'           => 'The banner image must be less than 2MB.',
            'section_images.image'       => 'The section image must be an image.',
            'section_images.mimes'       => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for section image.',
            'section_images.max'         => 'The section image must be less than 2MB.',
            'category_name.required'     => 'The category name is required.',
            'category_name.max'          => 'The category name must not exceed 255 characters.',
        ]);


        $bannerImageName = null;
        $sectionImageName = null;


        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);
        }


        if ($request->hasFile('section_images')) {
            $sectionImage = $request->file('section_images');
            $sectionImageName = time() . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
            $sectionImage->move(public_path('uploads/careers/'), $sectionImageName);
        }

        $careerCategory = new CareerCategory();
        $careerCategory->banner_heading  = $request->input('banner_heading');
        $careerCategory->banner_image    = $bannerImageName;
        $careerCategory->section_images  = $sectionImageName;
        $careerCategory->introduction    = $request->input('introduction');
        $careerCategory->section_heading = $request->input('section_heading');
        $careerCategory->category_name   = $request->input('category_name');
        $careerCategory->category_slug            = Str::slug($request->input('category_name'));
        $careerCategory->inserted_at   = Carbon::now();
        $careerCategory->inserted_by   =  Auth::id();
        $careerCategory->save();

        return redirect()->route('manage-career-category.index')->with('message', 'Career category created successfully.');
    }

     public function edit($id)
    {
        $details = CareerCategory::findOrFail($id);
        return view('backend.career.category.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'banner_heading'     => 'nullable|string|max:255',
            'banner_image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'section_images'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'introduction'       => 'nullable|string',
            'section_heading'    => 'nullable|string|max:255',
            'category_name'      => 'required|string|max:255',
        ], [
            'banner_image.image'         => 'The banner must be an image.',
            'banner_image.mimes'         => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for banner.',
            'banner_image.max'           => 'The banner image must be less than 2MB.',
            'section_images.image'       => 'The section image must be an image.',
            'section_images.mimes'       => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for section image.',
            'section_images.max'         => 'The section image must be less than 2MB.',
            'category_name.required'     => 'The category name is required.',
            'category_name.max'          => 'The category name must not exceed 255 characters.',
        ]);

        $careerCategory = CareerCategory::findOrFail($id);

        // Handle banner image update
        if ($request->hasFile('banner_image')) {

            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/careers/'), $bannerImageName);
            $careerCategory->banner_image = $bannerImageName;
        }

        // Handle section image update
        if ($request->hasFile('section_images')) {
           
            $sectionImage = $request->file('section_images');
            $sectionImageName = time() . rand(1000, 9999) . '.' . $sectionImage->getClientOriginalExtension();
            $sectionImage->move(public_path('uploads/careers/'), $sectionImageName);
            $careerCategory->section_images = $sectionImageName;
        }

        // Update other fields
        $careerCategory->banner_heading  = $request->input('banner_heading');
        $careerCategory->introduction    = $request->input('introduction');
        $careerCategory->section_heading = $request->input('section_heading');
        $careerCategory->category_name   = $request->input('category_name');
        $careerCategory->category_slug   = Str::slug($request->input('category_name'));
        $careerCategory->modified_at     = Carbon::now();
        $careerCategory->modified_by     = Auth::id();

        $careerCategory->save();

        return redirect()->route('manage-career-category.index')->with('message', 'Career category updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = CareerCategory::findOrFail($id);
            $industries->update($data);

            return redirect()->route('manage-career-category.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}