<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display attendance records
     */
    public function index(Request $request)
    {
        try {
            $query = Attendance::with('student.user', 'course', 'marked_by.user');
            
            if ($request->date) {
                $query->where('attendance_date', $request->date);
            }
            
            if ($request->course_id) {
                $query->where('course_id', $request->course_id);
            }
            
            $attendance = $query->orderBy('attendance_date', 'desc')->paginate(20);
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.attendance.index', compact('attendance', 'courses'));
        } catch (\Exception $e) {
            Log::error('Attendance index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading attendance.');
        }
    }

    /**
     * Display attendance by course
     */
    public function byCourse($courseId, Request $request)
    {
        try {
            $course = Course::findOrFail($courseId);
            $query = Attendance::where('course_id', $courseId)
                ->with('student.user', 'marked_by.user');
            
            if ($request->date) {
                $query->where('attendance_date', $request->date);
            }
            
            $attendance = $query->orderBy('attendance_date', 'desc')->paginate(20);
            
            return view('admin.attendance.by-course', compact('course', 'attendance'));
        } catch (\Exception $e) {
            Log::error('Attendance by course error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading attendance.');
        }
    }

    /**
     * Mark attendance
     */
    public function mark(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'attendance_date' => 'required|date',
                'attendance' => 'required|array',
                'attendance.*.student_id' => 'required|exists:students,id',
                'attendance.*.status' => 'required|in:present,absent,late,leave',
            ]);

            if ($validator->fails()) {

                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->attendance as $record) {
                Attendance::updateOrCreate(
                    [
                        'student_id' => $record['student_id'],
                        'course_id' => $request->course_id,
                        'attendance_date' => $request->attendance_date,
                    ],
                    [
                        'status' => $record['status'],
                        'marked_by' => auth()->user()->id,
                        'remarks' => $record['remarks'] ?? null,
                    ]
                );
            }

            Log::info('Attendance marked for course: ' . $request->course_id);
            return redirect()->back()
                ->with('success', 'Attendance marked successfully.');

        } catch (\Exception $e) {
            Log::error('Mark attendance error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error marking attendance.')
                ->withInput();
        }
    }


    public function create(Request $request)
        {
            $courses = Course::all();
            $students = collect();
             if ($request->filled('course_id')) {

                $students = CourseEnrollment::with('student.user')
                    ->where('course_id', $request->course_id)
                    ->get()
                    ->pluck('student');
              }

            return view('admin.attendance.create', compact('students','courses'));
        }
    /**
     * Student attendance
     */
    public function studentAttendance($studentId, Request $request)
    {
        try {
            
            $student = Student::with('user')->findOrFail($studentId);
            
            $query = Attendance::where('student_id', $studentId)
                ->with('course', 'marked_by.user');
            
            if ($request->course_id) {
                $query->where('course_id', $request->course_id);
            }
            
            $attendance = $query->orderBy('attendance_date', 'desc')->paginate(20);
            
            // Calculate statistics
            $total = Attendance::where('student_id', $studentId)->count();
            $present = Attendance::where('student_id', $studentId)
                ->where('status', 'present')->count();
            $absent = Attendance::where('student_id', $studentId)
                ->where('status', 'absent')->count();
            $percentage = $total > 0 ? round(($present / $total) * 100, 2) : 0;
            
            return view('admin.students.attendance', compact(
                'student', 'attendance', 'total', 'present', 'absent', 'percentage'
            ));
        } catch (\Exception $e) {
            Log::error('Student attendance error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Student not found.');
        }
    }

    /**
     * Attendance report
     */
    // public function report(Request $request)
    // {
    //     try {
    //         $query = Student::with(['attendance' => function($q) {
    //             $q->selectRaw('student_id, COUNT(*) as total, 
    //                 SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present');
    //         }])->where('status', 'active');
            
    //         $students = $query->get();
            
    //         return view('admin.attendance.report', compact('students'));
    //     } catch (\Exception $e) {
    //         Log::error('Attendance report error: ' . $e->getMessage());
    //         return redirect()->back()->with('error', 'Error loading report.');
    //     }
    // }

    public function dailyReport(Request $request)
        {
            $date = $request->date ?? date('Y-m-d');

            $attendance = Attendance::with([
                    'student.user',
                    'course'
                ])
                ->whereDate('attendance_date', $date)
                ->get();

            return view(
                'admin.attendance.daily-report',
                compact('attendance', 'date')
            );
        }


        public function monthlyReport(Request $request)
        {
            $month = $request->month ?? date('m');
            $year  = $request->year ?? date('Y');

            $report = Attendance::selectRaw("
                    student_id,
                    COUNT(*) as total_days,
                    SUM(CASE WHEN status='present' THEN 1 ELSE 0 END) as present_days,
                    SUM(CASE WHEN status='absent' THEN 1 ELSE 0 END) as absent_days
                ")
                ->with('student.user')
                ->whereMonth('attendance_date', $month)
                ->whereYear('attendance_date', $year)
                ->groupBy('student_id')
                ->get();

            return view(
                'admin.attendance.monthly-report',
                compact('report','month','year')
            );
        }

    /**
     * Update attendance
     */
    public function updateAttendance(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:present,absent,late,leave',
                'remarks' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $attendance = Attendance::findOrFail($id);
            $attendance->update([
                'status' => $request->status,
                'remarks' => $request->remarks,
            ]);

            Log::info('Attendance updated: ' . $id);
            return redirect()->back()
                ->with('success', 'Attendance updated successfully.');

        } catch (\Exception $e) {
            Log::error('Update attendance error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating attendance.');
        }
    }
}
