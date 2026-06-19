<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AdmissionController extends Controller
{
    /**
     * Display a listing of admissions
     */
    public function index(Request $request)
    {
        try {
            $query = Admission::with('applied_course');
            
            if ($request->search) {
                $query->where('first_name', 'LIKE', "%{$request->search}%")
                      ->orWhere('last_name', 'LIKE', "%{$request->search}%")
                      ->orWhere('email', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->status) {
                $query->where('application_status', $request->status);
            }
            
            $admissions = $query->orderBy('application_date', 'desc')->paginate(15);
            return view('admin.admissions.index', compact('admissions'));
        } catch (\Exception $e) {
            Log::error('Admission index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading admissions.');
        }
    }

    /**
     * Display the specified admission
     */
    public function show($id)
    {
        try {
            $admission = Admission::with('applied_course', 'reviewed_by')->findOrFail($id);
            return view('admin.admissions.show', compact('admission'));
        } catch (\Exception $e) {
            Log::error('Admission show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Admission not found.');
        }
    }

    /**
     * Show the form for editing admission
     */
    public function edit($id)
    {
        try {
            $admission = Admission::findOrFail($id);
            $courses = Course::where('status', 'active')->get();
            return view('admin.admissions.edit', compact('admission', 'courses'));
        } catch (\Exception $e) {
            Log::error('Admission edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Admission not found.');
        }
    }

    /**
     * Update the specified admission
     */
    public function update(Request $request, $id)
    {
        try {
            $admission = Admission::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:100',
                'last_name' => 'required|string|max:100',
                'email' => 'required|email',
                'phone' => 'nullable|string|max:15',
                'date_of_birth' => 'nullable|date',
                'education_background' => 'nullable|string',
                'applied_course_id' => 'nullable|exists:courses,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $admission->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'education_background' => $request->education_background,
                'applied_course_id' => $request->applied_course_id,
            ]);

            Log::info('Admission updated: ' . $admission->id);
            return redirect()->route('admin.admissions.index')
                ->with('success', 'Admission updated successfully.');

        } catch (\Exception $e) {
            Log::error('Admission update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating admission.')
                ->withInput();
        }
    }

    /**
     * Approve admission
     */
    public function approve(Request $request, $id)
    {
        try {
            $admission = Admission::findOrFail($id);
            
            $admission->update([
                'application_status' => 'approved',
                'reviewed_by' => auth()->user()->id,
                'review_date' => now(),
            ]);

            Log::info('Admission approved: ' . $admission->id);
            return redirect()->back()
                ->with('success', 'Admission approved successfully.');

        } catch (\Exception $e) {
            Log::error('Admission approve error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error approving admission.');
        }
    }

    /**
     * Reject admission
     */
    public function reject(Request $request, $id)
    {
        try {
            $admission = Admission::findOrFail($id);
            
            $admission->update([
                'application_status' => 'rejected',
                'reviewed_by' => auth()->user()->id,
                'review_date' => now(),
            ]);

            Log::info('Admission rejected: ' . $admission->id);
            return redirect()->back()
                ->with('success', 'Admission rejected successfully.');

        } catch (\Exception $e) {
            Log::error('Admission reject error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error rejecting admission.');
        }
    }

    /**
     * Waitlist admission
     */
    public function waitlist(Request $request, $id)
    {
        try {
            $admission = Admission::findOrFail($id);
            
            $admission->update([
                'application_status' => 'waitlist',
                'reviewed_by' => auth()->user()->id,
                'review_date' => now(),
            ]);

            Log::info('Admission waitlisted: ' . $admission->id);
            return redirect()->back()
                ->with('success', 'Admission waitlisted successfully.');

        } catch (\Exception $e) {
            Log::error('Admission waitlist error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error waitlisting admission.');
        }
    }

    /**
     * Remove the specified admission
     */
    public function destroy($id)
    {
        try {
            $admission = Admission::findOrFail($id);
            $admission->delete();

            Log::info('Admission deleted: ' . $id);
            return redirect()->route('admin.admissions.index')
                ->with('success', 'Admission deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Admission destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting admission.');
        }
    }

    /**
     * Show admission report
     */
    public function report()
    {
      
        try {
            $total = Admission::count();
            $pending = Admission::where('application_status', 'pending')->count();
            $approved = Admission::where('application_status', 'approved')->count();
            $rejected = Admission::where('application_status', 'rejected')->count();
            $admissions = Admission::with('applied_course')->latest()->get();

            return view('admin.admissions.report', compact(
                'total', 'pending', 'approved', 'rejected','admissions'
            ));
        } catch (\Exception $e) { 
             Log::error('Admission report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    public function changeStatus(Request $request, $id)
        {
            try {

                $request->validate([
                    'application_status' => 'required|in:pending,approved,rejected'
                ]);

                $admission = Admission::findOrFail($id);

                $admission->update([

                    'application_status' => $request->application_status,

                    'reviewed_by' => auth()->id(),

                    'review_date' => now(),

                ]);

                return redirect()
                    ->back()
                    ->with('success', 'Admission status updated successfully.');

            } catch (\Exception $e) {

                return redirect()
                    ->back()
                    ->with('error', $e->getMessage());
            }
        }
}
