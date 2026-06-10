<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of courses
     */
    public function index(Request $request)
    {
        try {
            $query = Course::with('faculty');
            
            if ($request->search) {
                $query->where('course_name', 'LIKE', "%{$request->search}%")
                      ->orWhere('course_code', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            if ($request->category) {
                $query->where('category', $request->category);
            }
            
            $courses = $query->paginate(15);
            return view('admin.courses.index', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Course index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading courses.');
        }
    }

    /**
     * Show the form for creating a new course
     */
    public function create()
    {
        try {
            $faculties  = Faculty::where('status', 'active')->get();
            return view('admin.courses.create', compact('faculties'));
        } catch (\Exception $e) {
            Log::error('Course create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading form.');
        }
    }

    /**
     * Store a newly created course
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_code' => 'required|string|unique:courses,course_code',
                'course_name' => 'required|string|max:150',
                'description' => 'nullable|string',
                'category' => 'nullable|string|max:100',
                'level' => 'nullable|in:beginner,intermediate,advanced',
                'duration_hours' => 'nullable|integer',
                'max_students' => 'nullable|integer',
                'faculty_id' => 'nullable|exists:faculty,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'fee' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Course::create([
                'course_code' => $request->course_code,
                'course_name' => $request->course_name,
                'description' => $request->description,
                'category' => $request->category,
                'level' => $request->level ?? 'beginner',
                'duration_hours' => $request->duration_hours,
                'max_students' => $request->max_students,
                'faculty_id' => $request->faculty_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'fee' => $request->fee,
                'status' => 'active',
            ]);

            Log::info('Course created: ' . $request->course_code);
            return redirect()->route('admin.courses.index')
                ->with('success', 'Course created successfully.');

        } catch (\Exception $e) {
            Log::error('Course store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating course.')
                ->withInput();
        }
    }

    /**
     * Display the specified course
     */
    public function show($id)
    {
        try {
            $course = Course::with('faculty', 'enrollments', 'exams')->findOrFail($id);
            return view('admin.courses.show', compact('course'));
        } catch (\Exception $e) {
            Log::error('Course show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    /**
     * Show the form for editing course
     */
    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            $faculty = Faculty::where('status', 'active')->get();
            return view('admin.courses.edit', compact('course', 'faculty'));
        } catch (\Exception $e) {
            Log::error('Course edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    /**
     * Update the specified course
     */
    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'course_name' => 'required|string|max:150',
                'description' => 'nullable|string',
                'category' => 'nullable|string|max:100',
                'level' => 'nullable|in:beginner,intermediate,advanced',
                'duration_hours' => 'nullable|integer',
                'max_students' => 'nullable|integer',
                'faculty_id' => 'nullable|exists:faculty,id',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'fee' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $course->update([
                'course_name' => $request->course_name,
                'course_code'=>$request->course_code,
                'description' => $request->description,
                'category' => $request->category,
                'level' => $request->level,
                'duration_hours' => $request->duration_hours,
                'max_students' => $request->max_students,
                'faculty_id' => $request->faculty_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'fee' => $request->fee,
            ]);

            Log::info('Course updated: ' . $course->id);
            return redirect()->route('admin.courses.index')
                ->with('success', 'Course updated successfully.');

        } catch (\Exception $e) {
            Log::error('Course update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating course.')
                ->withInput();
        }
    }

    /**
     * Remove the specified course
     */
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->delete();

            Log::info('Course deleted: ' . $id);
            return redirect()->route('admin.courses.index')
                ->with('success', 'Course deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Course destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting course.');
        }
    }

    /**
     * Show course enrollments
     */
    public function enrollments($id)
    {
        try {
            $course = Course::with('enrollments.student.user')->findOrFail($id);
            return view('admin.courses.enrollments', compact('course'));
        } catch (\Exception $e) {
            Log::error('Course enrollments error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    /**
     * Update course status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive,completed,upcoming',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $course = Course::findOrFail($id);
            $course->update(['status' => $request->status]);

            Log::info('Course status updated: ' . $id . ' to ' . $request->status);
            return redirect()->back()
                ->with('success', 'Course status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Course status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating status.');
        }
    }
}
