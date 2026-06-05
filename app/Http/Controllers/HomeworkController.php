<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HomeworkController extends Controller
{
    /**
     * Display a listing of homework
     */
    public function index(Request $request)
    {
        try {
            $query = Homework::with('course', 'assigned_by.user');
            
            if ($request->search) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                      ->orWhere('homework_code', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->course_id) {
                $query->where('course_id', $request->course_id);
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $homework = $query->orderBy('due_date', 'desc')->paginate(15);
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.homework.index', compact('homework', 'courses'));
        } catch (\Exception $e) {
            Log::error('Homework index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading homework.');
        }
    }

    /**
     * Show the form for creating homework
     */
    public function create()
    {
        try {
            $courses = Course::where('status', 'active')->get();
            return view('admin.homework.create', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Homework create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading form.');
        }
    }

    /**
     * Store a newly created homework
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'homework_code' => 'required|string|unique:homework,homework_code',
                'title' => 'required|string|max:200',
                'description' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'assignment_date' => 'required|date',
                'due_date' => 'required|date|after:assignment_date',
                'total_marks' => 'required|integer|min:1',
                'instructions' => 'nullable|string',
                'attachment' => 'nullable|file|max:10240',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $filePath = null;
            if ($request->hasFile('attachment')) {
                $filePath = Storage::disk('public')->put('homework-attachments', $request->file('attachment'));
            }

            Homework::create([
                'homework_code' => $request->homework_code,
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'assigned_by' => auth()->user()->id,
                'assignment_date' => $request->assignment_date,
                'due_date' => $request->due_date,
                'total_marks' => $request->total_marks,
                'instructions' => $request->instructions,
                'attachment_file_path' => $filePath,
                'status' => 'active',
            ]);

            Log::info('Homework created: ' . $request->homework_code);
            return redirect()->route('admin.homework.index')
                ->with('success', 'Homework created successfully.');

        } catch (\Exception $e) {
            Log::error('Homework store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating homework.')
                ->withInput();
        }
    }

    /**
     * Display the specified homework
     */
    public function show($id)
    {
        try {
            $homework = Homework::with('course', 'assigned_by.user')->findOrFail($id);
            return view('admin.homework.show', compact('homework'));
        } catch (\Exception $e) {
            Log::error('Homework show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Homework not found.');
        }
    }

    /**
     * Show the form for editing homework
     */
    public function edit($id)
    {
        try {
            $homework = Homework::findOrFail($id);
            $courses = Course::where('status', 'active')->get();
            return view('admin.homework.edit', compact('homework', 'courses'));
        } catch (\Exception $e) {
            Log::error('Homework edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Homework not found.');
        }
    }

    /**
     * Update the specified homework
     */
    public function update(Request $request, $id)
    {
        try {
            $homework = Homework::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:200',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'total_marks' => 'required|integer|min:1',
                'instructions' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $homework->update([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'total_marks' => $request->total_marks,
                'instructions' => $request->instructions,
            ]);

            Log::info('Homework updated: ' . $homework->id);
            return redirect()->route('admin.homework.index')
                ->with('success', 'Homework updated successfully.');

        } catch (\Exception $e) {
            Log::error('Homework update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating homework.')
                ->withInput();
        }
    }

    /**
     * Remove the specified homework
     */
    public function destroy($id)
    {
        try {
            $homework = Homework::findOrFail($id);
            
            if ($homework->attachment_file_path && Storage::disk('public')->exists($homework->attachment_file_path)) {
                Storage::disk('public')->delete($homework->attachment_file_path);
            }
            
            $homework->delete();

            Log::info('Homework deleted: ' . $id);
            return redirect()->route('admin.homework.index')
                ->with('success', 'Homework deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Homework destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting homework.');
        }
    }

    /**
     * View homework submissions
     */
    public function submissions($id)
    {
        try {
            $homework = Homework::with('course')->findOrFail($id);
            $submissions = HomeworkSubmission::where('homework_id', $id)
                ->with('student.user', 'evaluated_by.user')
                ->paginate(15);
            
            return view('admin.homework.submissions', compact('homework', 'submissions'));
        } catch (\Exception $e) {
            Log::error('Homework submissions error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading submissions.');
        }
    }

    /**
     * View a single submission
     */
    public function viewSubmission($submissionId)
    {
        try {
            $submission = HomeworkSubmission::with('homework.course', 'student.user', 'evaluated_by.user')
                ->findOrFail($submissionId);
            return view('admin.homework.view-submission', compact('submission'));
        } catch (\Exception $e) {
            Log::error('View submission error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Submission not found.');
        }
    }

    /**
     * Evaluate homework submission
     */
    public function evaluateSubmission(Request $request, $submissionId)
    {
        try {
            $submission = HomeworkSubmission::findOrFail($submissionId);

            $validator = Validator::make($request->all(), [
                'marks_obtained' => 'required|numeric|min:0|max:' . $submission->homework->total_marks,
                'feedback' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $submission->update([
                'marks_obtained' => $request->marks_obtained,
                'total_marks' => $submission->homework->total_marks,
                'feedback' => $request->feedback,
                'evaluated_by' => auth()->user()->id,
                'evaluation_date' => now()->toDateString(),
                'status' => 'evaluated',
            ]);

            Log::info('Homework submission evaluated: ' . $submissionId);
            return redirect()->back()
                ->with('success', 'Submission evaluated successfully.');

        } catch (\Exception $e) {
            Log::error('Evaluate submission error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error evaluating submission.')
                ->withInput();
        }
    }
}
