<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\Homework;
use App\Models\StudyMaterial;
use App\Models\ExamResult;


use App\Models\CourseEnrollment;

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

            $user = auth()->user();

            if ($user->role == 'student') {
                $studentStats = $this->getStudentStatistics($user);
                

                $attendance = $this->getStudentAttendance($user);

                $fees = $this->getStudentFees($user);

                $homeworks = $this->getStudentHomework($user);

                $studyMaterials = $this->getStudentStudyMaterials($user);

                $upcomingExams = $this->getStudentUpcomingExams($user);


                $results = $this->getStudentResults($user);

                return view('admin.students.dashboard.index', compact(
                            'studentStats',
                            'attendance',
                            'fees',
                            'homeworks',
                            'studyMaterials',
                            'upcomingExams',
                            
                            'results'));
            }

            if ($user->role == 'faculty') {

                return view('admin.faculty.dashboard');
            }
            // Get dashboard statistics
            if($user->role == 'admin'){
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
            }
            

            

        } catch (\Exception $e) {
           echo $e->getMessage();die;
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

    private function getStudentResults($user)
        {
            $studentId = $user->student->id;

            $courseIds = CourseEnrollment::where(
                'student_id',
                $studentId
            )->pluck('course_id');

            return ExamResult::with('exam')
                ->where(
                    'student_id',
                    $studentId
                )
                ->whereHas('exam', function ($query) use ($courseIds) {

                    $query->whereIn(
                        'course_id',
                        $courseIds
                    );

                })
                ->latest('published_date')
                ->take(5)
                ->get();
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

   
    private function getStudentStatistics($user)
        {
            if (!$user->student) {
                return [
                    'total_subjects' => 0,
                    'attendance_percentage' => 0,
                    'pending_homeworks' => 0,
                    'upcoming_exams' => 0,
                ];
            }

            $studentId = $user->student->id;

            $courseIds = CourseEnrollment::where(
                'student_id',
                $studentId
            )->pluck('course_id');

            $totalAttendance = Attendance::where(
                'student_id',
                $studentId
            )->count();

            $presentAttendance = Attendance::where(
                'student_id',
                $studentId
            )->where(
                'status',
                'Present'
            )->count();

            $attendancePercentage = $totalAttendance > 0
                ? round(($presentAttendance / $totalAttendance) * 100, 2)
                : 0;

            return [

                'total_subjects' => $courseIds->count(),

                'attendance_percentage' => $attendancePercentage,

                'pending_homeworks' => Homework::whereIn(
                    'course_id',
                    $courseIds
                )->where(
                    'status',
                    'pending'
                )->count(),

                'upcoming_exams' => Exam::whereIn(
                    'course_id',
                    $courseIds
                )->whereDate(
                    'exam_date',
                    '>=',
                    now()
                )->count(),
            ];
        }
    private function getStudentAttendance($user)
     {
            return Attendance::where(
                    'student_id',
                    $user->student->id
                )
                ->latest()
                ->take(10)
                ->get();
     }
    private function getStudentFees($user)
    {
        return Fee::where(
                'student_id',
                $user->student->id
            )
            ->latest()
            ->get();
    }

   private function getStudentHomework($user)
        {
            $studentId = $user->student->id;

            $courseIds = CourseEnrollment::where(
                'student_id',
                $studentId
            )->pluck('course_id');

            return Homework::whereIn(
                    'course_id',
                    $courseIds
                )
                ->latest()
                ->take(5)
                ->get();
        }
    private function getStudentStudyMaterials($user)
        {
            return StudyMaterial::latest()
                    ->take(5)
                    ->get();
        }
    private function getStudentUpcomingExams($user)
        {
            $studentId = $user->student->id;

            $courseIds = CourseEnrollment::where(
                'student_id',
                $studentId
            )->pluck('course_id');

            return Exam::with('course')
                ->whereIn(
                    'course_id',
                    $courseIds
                )
                ->whereDate(
                    'exam_date',
                    '>=',
                    now()
                )
                ->orderBy(
                    'exam_date',
                    'asc'
                )
                ->take(5)
                ->get();
        }
    }
