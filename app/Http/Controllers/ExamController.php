<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    /**
     * Display a listing of exams
     */
    public function index(Request $request)
    {
        try {
            $query = Exam::with('course', 'created_by.user');
            
            if ($request->search) {
                $query->where('exam_name', 'LIKE', "%{$request->search}%")
                      ->orWhere('exam_code', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            if ($request->course_id) {
                $query->where('course_id', $request->course_id);
            }
            
            $exams = $query->orderBy('exam_date', 'desc')->paginate(15);
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.exams.index', compact('exams', 'courses'));
        } catch (\Exception $e) {
            Log::error('Exam index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading exams.');
        }
    }

    /**
     * Show the form for creating a new exam
     */
    public function create()
    {
        try {
            $courses = Course::where('status', 'active')->get();
            return view('admin.exams.create', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Exam create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading form.');
        }
    }

    /**
     * Store a newly created exam
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exam_code' => 'required|string|unique:exams,exam_code',
                'exam_name' => 'required|string|max:150',
                'course_id' => 'required|exists:courses,id',
                'exam_type' => 'required|in:unit_test,midterm,final,mock,practice',
                'exam_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'total_marks' => 'required|integer|min:1',
                'passing_marks' => 'required|integer|min:0',
                'location' => 'nullable|string|max:255',
                'instructions' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            Exam::create([
                'exam_code' => $request->exam_code,
                'exam_name' => $request->exam_name,
                'course_id' => $request->course_id,
                'exam_type' => $request->exam_type,
                'exam_date' => $request->exam_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'total_marks' => $request->total_marks,
                'passing_marks' => $request->passing_marks,
                'location' => $request->location,
                'instructions' => $request->instructions,
                'status' => 'scheduled',
                'created_by' => auth()->user()->id,
            ]);

            Log::info('Exam created: ' . $request->exam_code);
            return redirect()->route('admin.exams.index')
                ->with('success', 'Exam created successfully.');

        } catch (\Exception $e) {
            Log::error('Exam store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating exam.')
                ->withInput();
        }
    }

    /**
     * Display the specified exam
     */
    public function show($id)
    {
        try {
            $exam = Exam::with('course', 'results')->findOrFail($id);
            return view('admin.exams.show', compact('exam'));
        } catch (\Exception $e) {
            Log::error('Exam show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Exam not found.');
        }
    }

    /**
     * Show the form for editing exam
     */
    public function edit($id)
    {
        try {
            $exam = Exam::findOrFail($id);
            $courses = Course::where('status', 'active')->get();
            return view('admin.exams.edit', compact('exam', 'courses'));
        } catch (\Exception $e) {
            Log::error('Exam edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Exam not found.');
        }
    }

    /**
     * Update the specified exam
     */
    public function update(Request $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'exam_name' => 'required|string|max:150',
                'exam_type' => 'required|in:unit_test,midterm,final,mock,practice',
                'exam_date' => 'required|date',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'total_marks' => 'required|integer|min:1',
                'passing_marks' => 'required|integer|min:0',
                'location' => 'nullable|string|max:255',
                'instructions' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $exam->update([
                'exam_name' => $request->exam_name,
                'exam_type' => $request->exam_type,
                'exam_date' => $request->exam_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'total_marks' => $request->total_marks,
                'passing_marks' => $request->passing_marks,
                'location' => $request->location,
                'instructions' => $request->instructions,
            ]);

            Log::info('Exam updated: ' . $exam->id);
            return redirect()->route('admin.exams.index')
                ->with('success', 'Exam updated successfully.');

        } catch (\Exception $e) {
            Log::error('Exam update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating exam.')
                ->withInput();
        }
    }

    /**
     * Remove the specified exam
     */
    public function destroy($id)
    {
        try {
            $exam = Exam::findOrFail($id);
            $exam->delete();

            Log::info('Exam deleted: ' . $id);
            return redirect()->route('admin.exams.index')
                ->with('success', 'Exam deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Exam destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting exam.');
        }
    }

    /**
     * View exam results
     */
    public function results($id)
    {
        try {
            $exam = Exam::with(['results.student.user'])->findOrFail($id);
            return view('admin.exams.results', compact('exam'));
        } catch (\Exception $e) {
            Log::error('Exam results error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Exam not found.');
        }
    }

    /**
     * Store exam result
     */
    public function storeResult(Request $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'student_id' => 'required|exists:students,id',
                'marks_obtained' => 'required|numeric|min:0|max:' . $exam->total_marks,
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $percentage = ($request->marks_obtained / $exam->total_marks) * 100;
            $grade = $this->calculateGrade($percentage);

            ExamResult::updateOrCreate(
                [
                    'exam_id' => $exam->id,
                    'student_id' => $request->student_id,
                ],
                [
                    'marks_obtained' => $request->marks_obtained,
                    'total_marks' => $exam->total_marks,
                    'percentage' => round($percentage, 2),
                    'grade' => $grade,
                    'status' => 'submitted',
                ]
            );

            Log::info('Exam result stored for student: ' . $request->student_id);
            return redirect()->back()
                ->with('success', 'Exam result recorded successfully.');

        } catch (\Exception $e) {
            Log::error('Store result error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error storing result.')
                ->withInput();
        }
    }

    /**
     * Edit exam result
     */
    public function editResult($resultId)
    {
        try {
            $result = ExamResult::with('exam', 'student.user')->findOrFail($resultId);
            return view('admin.exams.edit-result', compact('result'));
        } catch (\Exception $e) {
            Log::error('Edit result error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Result not found.');
        }
    }

    /**
     * Update exam result
     */
    public function updateResult(Request $request, $resultId)
    {
        try {
            $result = ExamResult::findOrFail($resultId);

            $validator = Validator::make($request->all(), [
                'marks_obtained' => 'required|numeric|min:0|max:' . $result->total_marks,
                'remarks' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $percentage = ($request->marks_obtained / $result->total_marks) * 100;
            $grade = $this->calculateGrade($percentage);

            $result->update([
                'marks_obtained' => $request->marks_obtained,
                'percentage' => round($percentage, 2),
                'grade' => $grade,
                'remarks' => $request->remarks,
                'status' => 'evaluated',
                'evaluated_by' => auth()->user()->id,
                'evaluation_date' => now(),
            ]);

            Log::info('Exam result updated: ' . $resultId);
            return redirect()->back()
                ->with('success', 'Exam result updated successfully.');

        } catch (\Exception $e) {
            Log::error('Update result error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating result.')
                ->withInput();
        }
    }

    /**
     * Publish results
     */
    public function publishResults(Request $request, $id)
    {
        try {
            $exam = Exam::findOrFail($id);
            
            ExamResult::where('exam_id', $id)
                ->update(['status' => 'published', 'published_date' => now()]);

            $exam->update(['status' => 'completed']);

            Log::info('Exam results published: ' . $id);
            return redirect()->back()
                ->with('success', 'Results published successfully.');

        } catch (\Exception $e) {
            Log::error('Publish results error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error publishing results.');
        }
    }

    /**
     * Calculate grade based on percentage
     */
    private function calculateGrade($percentage)
    {
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B';
        if ($percentage >= 60) return 'C';
        if ($percentage >= 50) return 'D';
        return 'F';
    }
}
