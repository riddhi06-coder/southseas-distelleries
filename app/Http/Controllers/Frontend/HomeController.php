<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Models\CareerCategory;
use App\Models\CareerCategoryList;
use App\Models\JobDetails;


use Carbon\Carbon;

class HomeController extends Controller
{


    public function index()
    {
        $banner = CareerCategory::orderBy('inserted_at', 'asc')->wherenull('deleted_by')->first();
        $details = CareerCategory::wherenull('deleted_by')->get();

        return view('frontend.careers', compact('banner','details'));
    }
    

    public function career_category($slug, Request $request)
    {
        $job = CareerCategory::where('category_slug', $slug)->whereNull('deleted_by')->firstOrFail();

        $banner = CareerCategoryList::where('category_id', $job->id)
                    ->whereNull('deleted_by')
                    ->orderBy('inserted_at', 'asc')
                    ->first();

        $keyword = $request->input('keyword');
        $jobType = $request->input('job_type');


        // Get filters
        $keyword = $request->input('keyword');
        $jobType = $request->input('job_type');

        // Base query with join to job_details
        $details = CareerCategoryList::where('career_category_listing.category_id', $job->id)
            ->whereNull('career_category_listing.deleted_by')
            ->leftJoin('job_details', 'career_category_listing.id', '=', 'job_details.job_id')
            ->select('career_category_listing.*'); 

        // Keyword-based search (title, dept, location)
        if (!empty($keyword)) {
            $details = $details->where(function ($q) use ($keyword) {
                $q->where('career_category_listing.job_role', 'like', '%' . $keyword . '%')
                ->orWhere('career_category_listing.department', 'like', '%' . $keyword . '%')
                ->orWhere('career_category_listing.location', 'like', '%' . $keyword . '%');
            });
        }

        // Filter by Job Type found in job_details.job_details
        if (!empty($jobType)) {
            $details = $details->where('job_details.job_details', 'like', '%' . $jobType . '%');
        }

        // Execute the query
        $details = $details->get();

        return view('frontend.career-listing', compact('job', 'banner', 'details', 'keyword', 'jobType'));

    }


    public function job_details($slug)
    {
        $category = DB::table('career_category_listing as ccl')
                    ->join('career_category as cc', 'cc.id', '=', 'ccl.category_id')
                    ->select('ccl.*', 'cc.category_slug as category_slug')
                    ->where('ccl.slug', $slug)
                    ->whereNull('ccl.deleted_by')
                    ->firstOrFail();

        // dd($category);

        $jobDetails = JobDetails::with('categoryList')
                ->whereNull('deleted_by')
                ->firstOrFail();
        // dd($jobDetails);

        $jobDetail = JobDetails::with('categoryList')
                ->where('job_id', $category->id)
                ->whereNull('deleted_by')
                ->firstOrFail();


        $otherJobs = JobDetails::with('categoryList')
                ->where('id', '!=', $jobDetail->id)
                ->whereNull('deleted_by')
                ->limit(5)
                ->get();

        return view('frontend.job-details', compact('jobDetail','otherJobs','category','jobDetails'));
    }

    public function careers_form(Request $request)
    {
        $position = $request->query('position');
        return view('frontend.careers-form', compact('position'));
    }


    public function submitCareerForm(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email',
            'subject' => 'required|string',
            'position' => 'required|string',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'coverletter' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'video_resume' => 'nullable|file|mimes:mp4,mov|max:4096',
            'portfolio' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Prepare file attachment info for view
        $attachedNames = [];
        foreach (['resume', 'coverletter', 'video_resume', 'portfolio'] as $field) {
            if ($request->hasFile($field)) {
                $attachedNames[$field] = $request->file($field)->getClientOriginalName();
            }
        }

        // Email Data
        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'subject'  => $request->subject,
            'position' => $request->position,
            'attached' => $attachedNames,
        ];

        // Send Email to Admin
        Mail::send('frontend.career-form-mail', $data, function ($message) use ($data, $request) {
            $message->to('riddhi@matrixbricks.com', 'Career Enquiry Details')
                    ->subject('New Career Application - ' . $data['position']);

            foreach (['resume', 'coverletter', 'video_resume', 'portfolio'] as $field) {
                if ($request->hasFile($field)) {
                    $file     = $request->file($field);
                    $filename = $file->getClientOriginalName();
                    $message->attach($file->getRealPath(), [
                        'as'   => $filename,
                        'mime' => $file->getClientMimeType(),
                    ]);
                }
            }
        });

        // Optional: Confirmation email to user
        Mail::send('frontend.contact_mail_confirmation', [], function ($message) use ($data) {
            $message->to($data['email'])->subject('Thanks for Reaching Out!');
        });

        return redirect()->back()->with('message', 'Application submitted successfully!');
    }


  


}