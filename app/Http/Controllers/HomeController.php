<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\CourseEnrollment;
use App\Models\Faculty;
use App\Models\ExamResult;
use App\Models\Admission;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index(){
            $activeCoursesCount = Course::where('status', 'active')->count();
            $facultyCount = Faculty::count();
            $activeEnrolledStudents = CourseEnrollment::distinct('student_id')->count('student_id');
            $courses = Course::all();
            $faculties = Faculty::with('user:id,name')->latest()->get();
            $latestUpdates =  $this->fetchLatestUpdate();

        return view('front-end.welcome', compact( 'latestUpdates','activeCoursesCount','faculties','facultyCount','activeEnrolledStudents','courses'));
    }

    public function fetchLatestUpdate(){
            $courses = Course::latest()->take(3)->get();

            $results = ExamResult::with('exam')->latest()->take(3)->get();
            
           // $announcements = Announcement::latest()->take(3)->get();

            $latestUpdates = collect();

            foreach ($courses as $course) {

                $latestUpdates->push([

                    'type' => 'Course',

                    'title' => $course->course_name,

                    'description' => 'New course added',

                    'date' => $course->created_at,
                ]);
            }

            foreach ($results as $result) {

                $latestUpdates->push([

                    'type' => 'Result',

                    'title' => $result->exam->exam_name,

                    'description' => 'Result published',

                    'date' => $result->created_at,
                ]);
            }

            // foreach ($announcements as $announcement) {

            //     $latestUpdates->push([

            //         'type' => 'Announcement',

            //         'title' => $announcement->title,

            //         'description' => $announcement->content,

            //         'date' => $announcement->created_at,
            //     ]);
            // }

            return $latestUpdates = $latestUpdates->sortByDesc('date')->take(10);

            
        }
        public function getCourseList(){
           $courses = Course::all();


           return view('front-end.course-list',compact('courses'));

        }

        public function getFacultyList(){
            $faculties = Faculty::with('user')->latest()->get();            
            return view('front-end.faculty-list',compact('faculties'));
        }

        public function createAdmissionForm(){
                $admissionData = session('admission_data', []);

                $courses = Course::all();

             return view('front-end.admission',compact('courses','admissionData'));
     
        }

        public function store(Request $request)
         {

         try{
                    $request->validate([

                        'first_name' => 'required',

                        'last_name' => 'required',

                        'email' => 'required|email',

                        'phone' => 'required',

                        'date_of_birth' => 'required',

                        'education_background' => 'required',

                        'application_date' => 'required',
                    

                    ]);


                    Admission::create([
                        'application_number'=>'ADM-' . now()->format('YmdHis'),

                        'first_name' => $request->first_name,

                        'last_name' => $request->last_name,

                        'email' => $request->email,

                        'phone' => $request->phone,

                        'date_of_birth' => $request->date_of_birth,

                        'education_background' => $request->education_background,

                        'applied_course_id' => $request->applied_course_id,

                        'application_date' => $request->application_date,

                        'application_status' => 'pending',
                        'notes' => $request->notes,
                        'gender' => $request->gender,

                        'reviewed_by' => null,

                        'review_date' => null

                    ]);
                    session()->forget('admission_data');



                    return redirect()->route('admission')->with( 'success',
                            'Application submitted successfully.'
                        );
            } 
         catch (\Exception $e) {
            echo $e->getMessage();die;
                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', $e->getMessage());
          }
        }

    public function redirectToAdmission(Request $request)
        {
            $fullName = trim($request->name);

            $nameParts = explode(' ', $fullName, 2);

            $firstName = $nameParts[0] ?? '';

            $lastName = $nameParts[1] ?? '';

            $data = [
                'first_name' => $firstName,
                'last_name'  => $lastName,
                'email'      => $request->email,
                'applied_course_id'=> $request->applied_course_id,

            ];

            session(['admission_data' => $data]);

             return redirect('/admission');       
         }

    }




    


