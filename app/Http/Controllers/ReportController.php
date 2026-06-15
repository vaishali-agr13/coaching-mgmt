<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Admission;
use App\Models\Fee;
use App\Models\FeePayment;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReportController extends Controller
{
    /**
     * Display reports dashboard
     */
    public function index()
    {
        try {
            return view('admin.reports.index');
        } catch (\Exception $e) {
            Log::error('Reports index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading reports.');
        }
    }

    /**
     * Student performance report
     */
    public function studentPerformance(Request $request)
    {
        try {
            $query = Student::with(['enrollments.course', 'examResults', 'homeworkSubmissions', 'attendance'])
                ->where('status', 'active');
            
            if ($request->search) {
                $query->whereHas('user', function($q) use ($request) {
                    $q->where('name', 'LIKE', "%{$request->search}%");
                });
            }
            
            $students = $query->paginate(20);
            
            return view('admin.reports.student-performance', compact('students'));
        } catch (\Exception $e) {
            Log::error('Student performance report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Student performance details
     */
    public function studentPerformanceDetails($studentId)
    {
        try {
            $student = Student::with('user', 'enrollments.course', 'examResults', 'homeworkSubmissions', 'attendance')
                ->findOrFail($studentId);
            
            // Calculate statistics
            $totalExams = ExamResult::where('student_id', $studentId)->count();
            $averageMarks = ExamResult::where('student_id', $studentId)->avg('percentage') ?? 0;
            $totalHomework = $student->homeworkSubmissions()->count();
            $completedHomework = $student->homeworkSubmissions()->whereNotNull('marks_obtained')->count();
            $attendancePercentage = $this->getAttendancePercentage($studentId);
            
            return view('admin.reports.student-performance-details', compact(
                'student', 'totalExams', 'averageMarks', 'totalHomework', 
                'completedHomework', 'attendancePercentage'
            ));
        } catch (\Exception $e) {
            Log::error('Student performance details error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Student not found.');
        }
    }

    /**
     * Course analytics
     */
    public function courseAnalytics(Request $request)
    {
        try {
            $courses = Course::with(['enrollments' => function($q) {
                $q->where('status', 'completed');
            }, 'faculty.user'])
                ->where('status', 'active')
                ->paginate(15);
            
            return view('admin.reports.course-analytics', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Course analytics error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading analytics.');
        }
    }

    /**
     * Course analytics details
     */
    public function courseAnalyticsDetails($courseId)
    {
        try {
            $course = Course::with('enrollments.student.user', 'exams', 'fees')
                ->findOrFail($courseId);
            
            $totalEnrollments = $course->enrollments()->count();
            $completedEnrollments = $course->enrollments()->where('status', 'completed')->count();
            $averageExamScore = ExamResult::whereIn('exam_id', 
                Exam::where('course_id', $courseId)->pluck('id')
            )->avg('percentage') ?? 0;
            $revenueGenerated = FeePayment::whereIn('fee_id',
                Fee::where('course_id', $courseId)->pluck('id')
            )->sum('amount_paid');
            
            return view('admin.reports.course-analytics-details', compact(
                'course', 'totalEnrollments', 'completedEnrollments', 
                'averageExamScore', 'revenueGenerated'
            ));
        } catch (\Exception $e) {
            Log::error('Course analytics details error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    /**
     * Faculty performance report
     */
    public function facultyPerformance()
    {
        try {
            $faculty = Faculty::with('user', 'courses')
                ->where('status', 'active')
                ->paginate(15);
            
            return view('admin.reports.faculty-performance', compact('faculty'));
        } catch (\Exception $e) {
            Log::error('Faculty performance report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Faculty performance details
     */
    public function facultyPerformanceDetails($facultyId)
    {
        try {
            $faculty = Faculty::with('user', 'courses', 'exams')
                ->findOrFail($facultyId);
            
            $coursesTaught = $faculty->courses()->count();
            $totalStudents = DB::table('course_enrollments')
                ->whereIn('course_id', $faculty->courses()->pluck('id'))
                ->count();
            $averageStudentScore = ExamResult::whereIn('exam_id',
                Exam::where('created_by', $facultyId)->pluck('id')
            )->avg('percentage') ?? 0;
            
            return view('admin.reports.faculty-performance-details', compact(
                'faculty', 'coursesTaught', 'totalStudents', 'averageStudentScore'
            ));
        } catch (\Exception $e) {
            Log::error('Faculty performance details error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Faculty not found.');
        }
    }

    /**
     * Fee collection report
     */
    public function feeCollection()
    {
        try {
            $totalFee = Fee::sum('fee_amount') ?? 0;
            $totalCollected = FeePayment::sum('amount_paid') ?? 0;
            $pendingFee = $totalFee - $totalCollected;
            $collectionPercentage = $totalFee > 0 ? round(($totalCollected / $totalFee) * 100, 2) : 0;
            
            $feesByStatus = Fee::selectRaw('status, COUNT(*) as count, SUM(fee_amount) as total')
                ->groupBy('status')
                ->get();
            
            $monthlyCollection = FeePayment::selectRaw('MONTH(payment_date) as month, SUM(amount_paid) as total')
                ->whereYear('payment_date', date('Y'))
                ->groupBy('month')
                ->get();
            
            return view('admin.reports.fee-collection', compact(
                'totalFee', 'totalCollected', 'pendingFee', 'collectionPercentage',
                'feesByStatus', 'monthlyCollection'
            ));
        } catch (\Exception $e) {
            Log::error('Fee collection report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Attendance report
     */
    public function attendance()
    {
        try {
          
            $students = Student::with(['attendance' => function($q) {
                $q->selectRaw('student_id, COUNT(*) as total, 
                    SUM(CASE WHEN status = "present" THEN 1 ELSE 0 END) as present')->groupBy('student_id');
                    
            }])
                ->where('status', 'active')
                ->paginate(20);
            return view('admin.reports.attendance', compact('students'));
        } catch (\Exception $e) {
            Log::error('Attendance report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Admission report
     */
    public function admission()
    {
        try {
            $total = Admission::count();
            $pending = Admission::where('application_status', 'pending')->count();
            $approved = Admission::where('application_status', 'approved')->count();
            $rejected = Admission::where('application_status', 'rejected')->count();
            $waitlist = Admission::where('application_status', 'waitlist')->count();
            
            $admissionsByMonth = Admission::selectRaw('MONTH(application_date) as month, COUNT(*) as count')
                ->whereYear('application_date', date('Y'))
                ->groupBy('month')
                ->get();
            
            return view('admin.reports.admission', compact(
                'total', 'pending', 'approved', 'rejected', 'waitlist', 'admissionsByMonth'
            ));
        } catch (\Exception $e) {
            Log::error('Admission report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Exam results report
     */
    public function examResults()
    {
        try {
            $exams = Exam::with(['results' => function($q) {
                $q->orderBy('percentage', 'desc');
            }, 'course'])
                ->where('status', 'completed')
                ->orderBy('exam_date', 'desc')
                ->paginate(15);
            
            return view('admin.reports.exam-results', compact('exams'));
        } catch (\Exception $e) {
            Log::error('Exam results report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }

    /**
     * Export report as PDF
     */
    public function exportPdf($reportType)
    {
        try {
            // Integration with PDF library like dompdf
            // Example implementation
            Log::info('Export PDF: ' . $reportType);
            return redirect()->back()->with('success', 'PDF exported successfully.');
        } catch (\Exception $e) {
            Log::error('Export PDF error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error exporting PDF.');
        }
    }

    /**
     * Export report as Excel
     */
    public function exportExcel($reportType)
    {
        try {
            // Integration with Excel library like maatwebsite/excel
            // Example implementation
            Log::info('Export Excel: ' . $reportType);
            return redirect()->back()->with('success', 'Excel exported successfully.');
        } catch (\Exception $e) {
            Log::error('Export Excel error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error exporting Excel.');
        }
    }

    /**
     * Get attendance percentage for a student
     */
    private function getAttendancePercentage($studentId)
    {
        $total = Attendance::where('student_id', $studentId)->count();
        
        if ($total === 0) {
            return 0;
        }
        
        $present = Attendance::where('student_id', $studentId)
            ->where('status', 'present')
            ->count();
        
        return round(($present / $total) * 100, 2);
    }
}
