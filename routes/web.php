<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
 use App\Http\Controllers\HomeController;

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudyMaterialController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [HomeController::class, 'index']);

Route::get('/courses', [HomeController::class, 'getCourseList']);

Route::get('/faculty', [HomeController::class, 'getFacultyList']);


Route::get('/result', function () {


    return view('front-end.result');
});


// ============================================
// AUTHENTICATION ROUTES (Guest only)
// ============================================
Route::middleware('guest')->group(function () {
    
    // Login Routes
    Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.store');
    
    // Register Routes
    Route::get('/admin/register', [AuthController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('/admin/register', [AuthController::class, 'register'])->name('admin.register.store');
    
    // Password Reset Routes
    Route::get('/admin/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post('/admin/forgot-password', [AuthController::class, 'forgotPassword'])->name('admin.forgot-password.store');
    Route::get('/admin/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('admin.reset-password');
    Route::post('/admin/reset-password', [AuthController::class, 'resetPassword'])->name('admin.reset-password.store');
});

// ============================================
// PROTECTED ADMIN ROUTES (Authenticated only)
// ============================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // ============================================
    // DASHBOARD
    // ============================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ============================================
    // LOGOUT
    // ============================================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // ============================================
    // STUDENT MANAGEMENT
    // ============================================
    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', [StudentController::class, 'index'])->name('index');                    // List all students
        Route::get('/create', [StudentController::class, 'create'])->name('create');            // Create form
        Route::post('/', [StudentController::class, 'store'])->name('store');                  // Store student
        Route::get('/{id}', [StudentController::class, 'show'])->name('show');                 // View student details
        Route::get('/{id}/edit', [StudentController::class, 'edit'])->name('edit');            // Edit form
        Route::put('/{id}', [StudentController::class, 'update'])->name('update');             // Update student
        Route::delete('/{id}', [StudentController::class, 'destroy'])->name('destroy');        // Delete student
        Route::get('/{id}/profile', [StudentController::class, 'profile'])->name('profile');   // Student profile
        Route::post('/{id}/status', [StudentController::class, 'updateStatus'])->name('updateStatus'); // Change status
        Route::get('/{id}/courses',[StudentController::class,'courses'])->name('courses');
        Route::get('/{id}/results', [StudentController::class, 'results'])->name('results');

        Route::post('/{id}/assign-course',[StudentController::class,'assignCourse'])->name('assignCourse'); 
    });

    
    // ============================================
    // FACULTY MANAGEMENT
    // ============================================
    Route::prefix('faculty')->name('faculty.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/', [FacultyController::class, 'index'])->name('index');                   // List all faculty
        Route::get('/create', [FacultyController::class, 'create'])->name('create');           // Create form
        Route::post('/', [FacultyController::class, 'store'])->name('store');                  // Store faculty
        Route::get('/{id}', [FacultyController::class, 'show'])->name('show');                 // View faculty details
        Route::get('/{id}/edit', [FacultyController::class, 'edit'])->name('edit');            // Edit form
        Route::put('/{id}', [FacultyController::class, 'update'])->name('update');             // Update faculty
        Route::delete('/{id}', [FacultyController::class, 'destroy'])->name('destroy');        // Delete faculty
        Route::get('/{id}/profile', [FacultyController::class, 'profile'])->name('profile');   // Faculty profile
        Route::post('/{id}/status', [FacultyController::class, 'updateStatus'])->name('updateStatus'); // Change status
    });
    
    Route::resource('users', UserController::class);
  

    // ============================================
    // COURSE MANAGEMENT
    // ============================================
    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');                    // List all courses
        Route::get('/create', [CourseController::class, 'create'])->name('create');            // Create form
        Route::post('/', [CourseController::class, 'store'])->name('store');                   // Store course
        Route::get('/{id}', [CourseController::class, 'show'])->name('show');                  // View course details
        Route::get('/{id}/edit', [CourseController::class, 'edit'])->name('edit');             // Edit form
        Route::put('/{id}', [CourseController::class, 'update'])->name('update');              // Update course
        Route::delete('/{id}', [CourseController::class, 'destroy'])->name('destroy');         // Delete course
        Route::get('/{id}/enrollments', [CourseController::class, 'enrollments'])->name('enrollments'); // View enrollments
        Route::post('/{id}/status', [CourseController::class, 'updateStatus'])->name('updateStatus');   // Change status
    });
    
    // ============================================
    // ADMISSION MANAGEMENT
    // ============================================
    Route::prefix('admissions')->name('admissions.')->group(function () {
        Route::get('/', [AdmissionController::class, 'index'])->name('index');                 // List all applications
        Route::get('/{id}', [AdmissionController::class, 'show'])->name('show');               // View application details
        Route::post('/{id}/approve', [AdmissionController::class, 'approve'])->name('approve'); // Approve admission
        Route::post('/{id}/reject', [AdmissionController::class, 'reject'])->name('reject');   // Reject admission
        Route::post('/{id}/waitlist', [AdmissionController::class, 'waitlist'])->name('waitlist'); // Waitlist admission
        Route::get('/{id}/edit', [AdmissionController::class, 'edit'])->name('edit');          // Edit form
        Route::put('/{id}', [AdmissionController::class, 'update'])->name('update');           // Update admission
        Route::delete('/{id}', [AdmissionController::class, 'destroy'])->name('destroy');      // Delete admission
        Route::get('/report/summary', [AdmissionController::class, 'report'])->name('report'); // Admission report
    });
    
    // ============================================
    // ATTENDANCE MANAGEMENT
    // ============================================
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::get('/', [AttendanceController::class, 'index'])->name('index');                // View attendance
        Route::get('/course/{courseId}', [AttendanceController::class, 'byCourse'])->name('byCourse'); // Attendance by course
        Route::post('/mark', [AttendanceController::class, 'mark'])->name('mark');             // Mark attendance
        Route::get('/student/{studentId}', [AttendanceController::class, 'studentAttendance'])->name('student'); // Student attendance
        // Route::get('/report', [AttendanceController::class, 'report'])->name('report');        // Attendance report
        Route::post('/{id}/edit', [AttendanceController::class, 'updateAttendance'])->name('update'); // Update attendance
        Route::get('/create', [AttendanceController::class, 'create'])->name('create');
        Route::get('/daily-report', [AttendanceController::class, 'dailyReport'])->name('dailyReport');
        Route::get('/monthly-report', [AttendanceController::class, 'monthlyReport'])->name('monthlyReport');
        });
    
    // ============================================
    // FEE MANAGEMENT
    // ============================================
    Route::prefix('fees')->name('fees.')->group(function () {
        Route::get('/', [FeeController::class, 'index'])->name('index');                       // List all fees
        Route::get('/create', [FeeController::class, 'create'])->name('create');               // Create fee entry
        Route::post('/', [FeeController::class, 'store'])->name('store');                      // Store fee
        Route::get('/{id}', [FeeController::class, 'show'])->name('show');                     // View fee details
        Route::get('/{id}/edit', [FeeController::class, 'edit'])->name('edit');                // Edit form
        Route::put('/{id}', [FeeController::class, 'update'])->name('update');                 // Update fee
        Route::delete('/{id}', [FeeController::class, 'destroy'])->name('destroy');            // Delete fee
        Route::post('/{id}/payment', [FeeController::class, 'recordPayment'])->name('payment'); // Record payment
        Route::get('/student/{studentId}', [FeeController::class, 'studentFees'])->name('student'); // Student fees
        Route::get('/report/collection', [FeeController::class, 'collectionReport'])->name('report'); // Collection report
    });
    
    // ============================================
    // EXAM MANAGEMENT
    // ============================================
    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('/', [ExamController::class, 'index'])->name('index');                      // List all exams
        Route::get('/create', [ExamController::class, 'create'])->name('create');              // Create exam
        Route::post('/', [ExamController::class, 'store'])->name('store');                     // Store exam
        Route::get('/{id}', [ExamController::class, 'show'])->name('show');                    // View exam details
        Route::get('/{id}/edit', [ExamController::class, 'edit'])->name('edit');               // Edit form
        Route::put('/{id}', [ExamController::class, 'update'])->name('update');                // Update exam
        Route::delete('/{id}', [ExamController::class, 'destroy'])->name('destroy');           // Delete exam
        Route::get('/{id}/results', [ExamController::class, 'results'])->name('results');      // View results
        Route::post('/{id}/result', [ExamController::class, 'storeResult'])->name('storeResult'); // Store result
        Route::get('/result/{resultId}/edit', [ExamController::class, 'editResult'])->name('editResult'); // Edit result
        Route::put('/result/{resultId}', [ExamController::class, 'updateResult'])->name('updateResult'); // Update result
        Route::post('/{id}/publish', [ExamController::class, 'publishResults'])->name('publish'); // Publish results
        Route::get('/{id}/published-results',[ExamController::class, 'publishedResults'])->name('publishedResults');   
        Route::get('/{id}/rank-list',[ExamController::class, 'rankList'])->name('rankList');
        Route::get('/{id}/performance-analysis',[ExamController::class, 'performanceAnalysis'])->name('analysis');     
     
   });
    
    // ============================================
    // STUDY MATERIAL MANAGEMENT
    // ============================================
    Route::prefix('study-materials')->name('study-materials.')->group(function () {
        Route::get('/', [StudyMaterialController::class, 'index'])->name('index');             // List all materials
        Route::get('/create', [StudyMaterialController::class, 'create'])->name('create');     // Create form
        Route::post('/', [StudyMaterialController::class, 'store'])->name('store');            // Store material
        Route::get('/{id}', [StudyMaterialController::class, 'show'])->name('show');           // View material details
        Route::get('/{id}/edit', [StudyMaterialController::class, 'edit'])->name('edit');      // Edit form
        Route::put('/{id}', [StudyMaterialController::class, 'update'])->name('update');       // Update material
        Route::delete('/{id}', [StudyMaterialController::class, 'destroy'])->name('destroy');  // Delete material
        Route::get('/{id}/download', [StudyMaterialController::class, 'download'])->name('download'); // Download material
        Route::post('/{id}/status', [StudyMaterialController::class, 'updateStatus'])->name('updateStatus'); // Change status
    });
    
    // ============================================
    // HOMEWORK MANAGEMENT
    // ============================================
    Route::prefix('homework')->name('homework.')->group(function () {
        Route::get('/', [HomeworkController::class, 'index'])->name('index');                  // List all homework
        Route::get('/create', [HomeworkController::class, 'create'])->name('create');          // Create form
        Route::post('/', [HomeworkController::class, 'store'])->name('store');                 // Store homework
        Route::get('/{id}', [HomeworkController::class, 'show'])->name('show');                // View homework details
        Route::get('/{id}/edit', [HomeworkController::class, 'edit'])->name('edit');           // Edit form
        Route::put('/{id}', [HomeworkController::class, 'update'])->name('update');            // Update homework
        Route::delete('/{id}', [HomeworkController::class, 'destroy'])->name('destroy');       // Delete homework
        Route::get('/{id}/submissions', [HomeworkController::class, 'submissions'])->name('submissions'); // View submissions
        Route::get('/submission/{submissionId}', [HomeworkController::class, 'viewSubmission'])->name('viewSubmission');
        Route::post('/submission/{submissionId}/evaluate', [HomeworkController::class, 'evaluateSubmission'])->name('evaluate'); // Evaluate submission
    });
    
    // ============================================
    // BLOG MANAGEMENT
    // ============================================
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');                      // List all posts
        Route::get('/create', [BlogController::class, 'create'])->name('create');              // Create form
        Route::post('/', [BlogController::class, 'store'])->name('store');                     // Store post
        Route::get('/{id}', [BlogController::class, 'show'])->name('show');                    // View post details
        Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('edit');               // Edit form
        Route::put('/{id}', [BlogController::class, 'update'])->name('update');                // Update post
        Route::delete('/{id}', [BlogController::class, 'destroy'])->name('destroy');           // Delete post
        Route::post('/{id}/publish', [BlogController::class, 'publish'])->name('publish');     // Publish post
        Route::post('/{id}/unpublish', [BlogController::class, 'unpublish'])->name('unpublish'); // Unpublish post
        Route::get('/{id}/comments', [BlogController::class, 'comments'])->name('comments');   // View comments
        Route::post('/comment/{commentId}/approve', [BlogController::class, 'approveComment'])->name('approveComment'); // Approve comment
        Route::delete('/comment/{commentId}', [BlogController::class, 'deleteComment'])->name('deleteComment'); // Delete comment
    });
    
    // ============================================
    // GALLERY MANAGEMENT
    // ============================================
    Route::prefix('gallery')->name('gallery.')->group(function () {
        // Album routes
        Route::get('/', [GalleryController::class, 'index'])->name('index');                   // List all albums
        Route::get('/create', [GalleryController::class, 'createAlbum'])->name('createAlbum'); // Create album form
        Route::post('/', [GalleryController::class, 'storeAlbum'])->name('storeAlbum');         // Store album
        Route::get('/{albumId}', [GalleryController::class, 'showAlbum'])->name('show');       // View album
        Route::get('/{albumId}/edit', [GalleryController::class, 'editAlbum'])->name('edit');  // Edit album form
        Route::put('/{albumId}', [GalleryController::class, 'updateAlbum'])->name('update');   // Update album
        Route::delete('/{albumId}', [GalleryController::class, 'destroyAlbum'])->name('destroy'); // Delete album
        
        // Image routes
        Route::post('/{albumId}/image', [GalleryController::class, 'storeImage'])->name('storeImage'); // Upload image
        Route::get('/image/{imageId}/edit', [GalleryController::class, 'editImage'])->name('editImage'); // Edit image
        Route::put('/image/{imageId}', [GalleryController::class, 'updateImage'])->name('updateImage'); // Update image
        Route::delete('/image/{imageId}', [GalleryController::class, 'destroyImage'])->name('destroyImage'); // Delete image
    });
    
    // ============================================
    // REPORTS & ANALYTICS
    // ============================================
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');                    // Reports dashboard
        
        // Student Performance Reports
        Route::get('/student-performance', [ReportController::class, 'studentPerformance'])->name('studentPerformance');
        Route::get('/student/{studentId}/performance', [ReportController::class, 'studentPerformanceDetails'])->name('studentPerformanceDetails');
        
        // Course Analytics
        Route::get('/course-analytics', [ReportController::class, 'courseAnalytics'])->name('courseAnalytics');
        Route::get('/course/{courseId}/analytics', [ReportController::class, 'courseAnalyticsDetails'])->name('courseAnalyticsDetails');
        
        // Faculty Performance Reports
        Route::get('/faculty-performance', [ReportController::class, 'facultyPerformance'])->name('facultyPerformance');
        Route::get('/faculty/{facultyId}/performance', [ReportController::class, 'facultyPerformanceDetails'])->name('facultyPerformanceDetails');
        
        // Fee Collection Reports
        Route::get('/fee-collection', [ReportController::class, 'feeCollection'])->name('feeCollection');
        
        // Attendance Reports
        Route::get('/attendance', [ReportController::class, 'attendance'])->name('attendance');
        
        // Admission Reports
        Route::get('/admission', [ReportController::class, 'admission'])->name('admission');
        
        // Exam Reports
        Route::get('/exam-results', [ReportController::class, 'examResults'])->name('examResults');
        
        // Export Reports
        Route::get('/export/pdf/{reportType}', [ReportController::class, 'exportPdf'])->name('exportPdf');
        Route::get('/export/excel/{reportType}', [ReportController::class, 'exportExcel'])->name('exportExcel');
    });
});
