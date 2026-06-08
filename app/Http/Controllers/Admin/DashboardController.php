<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Admission;
use App\Models\Fee;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        try {
            // Get dashboard statistics
            $stats = $this->getDashboardStatistics();

            // Get recent activities
            $recentActivities = $this->getRecentActivities();

            // Get attendance overview
            $attendanceOverview = $this->getAttendanceOverview();

            // Get fee collection status
            $feeStatus = $this->getFeeCollectionStatus();

            // Get upcoming exams
            $upcomingExams = $this->getUpcomingExams();

            return view('admin.dashboard', [
                'stats' => $stats,
                'recentActivities' => $recentActivities,
                'attendanceOverview' => $attendanceOverview,
                'feeStatus' => $feeStatus,
                'upcomingExams' => $upcomingExams,
            ]);

        } catch (\Exception $e) {
            \Log::error('Dashboard error: ' . $e->getMessage());
            return view('admin.dashboard')->with('error', 'Error loading dashboard data.');
        }
    }

    /**
     * Get dashboard statistics
     */
    private function getDashboardStatistics(): array
    {
        return [
            'total_students' => Student::where('status', 'active')->count(),
            'total_faculty' => Faculty::where('status', 'active')->count(),
            'total_courses' => Course::where('status', 'active')->count(),
            'total_admins' => User::where('role', 'admin')->count(),
            'pending_admissions' => Admission::where('application_status', 'pending')->count(),
            'approved_admissions' => Admission::where('application_status', 'approved')->count(),
            'rejected_admissions' => Admission::where('application_status', 'rejected')->count(),
            'total_revenue' => $this->calculateTotalRevenue(),
            'pending_fees' => Fee::where('status', 'pending')->sum('fee_amount'),
            'collected_fees' => $this->calculateCollectedFees(),
        ];
    }

    /**
     * Get recent activities
     */
    private function getRecentActivities(): array
    {
        return [
            'recent_admissions' => Admission::orderBy('application_date', 'desc')
                ->take(5)
                ->get(['id', 'first_name', 'last_name', 'application_date', 'application_status']),
            
            'recent_enrollments' => DB::table('course_enrollments')
                ->join('students', 'course_enrollments.student_id', '=', 'students.id')
                ->join('courses', 'course_enrollments.course_id', '=', 'courses.id')
                ->join('users', 'students.user_id', '=', 'users.id')
                ->select('users.name as student_name', 'courses.course_name', 'course_enrollments.enrollment_date')
                ->orderBy('course_enrollments.enrollment_date', 'desc')
                ->take(5)
                ->get(),
        ];
    }

    /**
     * Get attendance overview
     */
    private function getAttendanceOverview(): array
    {
        $today = now()->toDateString();
        
        return [
            'total_marked_today' => DB::table('attendance')
                ->where('attendance_date', $today)
                ->count(),
            
            'present_today' => DB::table('attendance')
                ->where('attendance_date', $today)
                ->where('status', 'present')
                ->count(),
            
            'absent_today' => DB::table('attendance')
                ->where('attendance_date', $today)
                ->where('status', 'absent')
                ->count(),
            
            'late_today' => DB::table('attendance')
                ->where('attendance_date', $today)
                ->where('status', 'late')
                ->count(),
            
            'average_attendance' => $this->calculateAverageAttendance(),
        ];
    }

    /**
     * Get fee collection status
     */
    private function getFeeCollectionStatus(): array
    {
        $totalFee = Fee::sum('fee_amount');
        $collectedFee = $this->calculateCollectedFees();
        
        return [
            'total_fee_due' => $totalFee,
            'total_fee_collected' => $collectedFee,
            'collection_percentage' => $totalFee > 0 ? round(($collectedFee / $totalFee) * 100, 2) : 0,
            'pending_fees' => $totalFee - $collectedFee,
            'fee_by_status' => [
                'paid' => Fee::where('status', 'paid')->sum('fee_amount'),
                'pending' => Fee::where('status', 'pending')->sum('fee_amount'),
                'partial' => Fee::where('status', 'partial')->sum('fee_amount'),
                'overdue' => Fee::where('status', 'overdue')->sum('fee_amount'),
            ],
        ];
    }

    /**
     * Get upcoming exams
     */
    private function getUpcomingExams(): array
    {
        return Exam::where('exam_date', '>=', now())
            ->where('status', 'scheduled')
            ->orderBy('exam_date', 'asc')
            ->take(5)
            ->with('course')
            ->get()
            ->toArray();
    }

    /**
     * Calculate total revenue
     */
    private function calculateTotalRevenue(): float
    {
        return DB::table('fee_payments')->sum('amount_paid') ?? 0;
    }

    /**
     * Calculate collected fees
     */
    private function calculateCollectedFees(): float
    {
        return DB::table('fee_payments')
            ->sum('amount_paid') ?? 0;
    }

    /**
     * Calculate average attendance
     */
    private function calculateAverageAttendance(): float
    {
        $total = DB::table('attendance')->count();
        
        if ($total === 0) {
            return 0;
        }
        
        $present = DB::table('attendance')
            ->where('status', 'present')
            ->count();
        
        return round(($present / $total) * 100, 2);
    }
}
