<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\CourseEnrollment;

use App\Models\User;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of students
     */
    public function index(Request $request)
    {
        try {
            $query = Student::with('user');
            
            // Search
            if ($request->search) {
                $search = $request->search;
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                })->orWhere('roll_number', 'LIKE', "%{$search}%");
            }
            
            // Filter by status
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $students = $query->paginate(15);
            
            return view('admin.students.index', compact('students'));
        } catch (\Exception $e) {
            Log::error('Student index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading students.');
        }
    }

    /**
     * Show the form for creating a new student
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created student
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:15',
                'password' => 'required|min:8|confirmed',
                'roll_number' => 'required|string|unique:students,roll_number',
                'registration_number' => 'required|string|unique:students,registration_number',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'father_name' => 'nullable|string|max:100',
                'mother_name' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:50',
                'state' => 'nullable|string|max:50',
                'postal_code' => 'nullable|string|max:10',
                'parent_phone' => 'nullable|string|max:15',
                'admission_date' => 'required|date',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'student',
                'status' => 'active',
            ]);

            // Create student
            Student::create([
                'user_id' => $user->id,
                'roll_number' => $request->roll_number,
                'registration_number' => $request->registration_number,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'parent_phone' => $request->parent_phone,
                'admission_date' => $request->admission_date,
                'status' => 'active',
            ]);

            Log::info('Student created: ' . $request->email);
            return redirect()->route('admin.students.index')
                ->with('success', 'Student created successfully.');

        } catch (\Exception $e) {
            Log::error('Student store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating student.')
                ->withInput();
        }
    }

    /**
     * Display the specified student
     */
    public function show($id)
    {
        
        try {
            $courses = Course::where('status', 'active')->get();

            $student = Student::with('user', 'enrollments', 'fees', 'examResults', 'attendance')->findOrFail($id);
            $assignedCourses = $student->enrollments->pluck('course_id')->toArray();
           
            return view('admin.students.show', compact('student','courses','assignedCourses'));
        } catch (\Exception $e) {
                Log::error('Student show error', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);            
                return redirect()->back()->with('error', 'Student not found.');
        }
    }

    /**
     * Show the form for editing student
     */
    public function edit($id)
    {
        try {

            $student = Student::with('user')->where('id', $id)->firstOrFail();
        
            return view('admin.students.edit', compact('student'));
        } catch (\Exception $e) {
            Log::error('Student edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Student not found.');
        }
    }

    /**
     * Update the specified student
     */
    public function update(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $student->user_id,
                'phone' => 'nullable|string|max:15',
                'date_of_birth' => 'nullable|date',
                'gender' => 'nullable|in:male,female,other',
                'father_name' => 'nullable|string|max:100',
                'mother_name' => 'nullable|string|max:100',
                'address' => 'nullable|string|max:255',
                'city' => 'nullable|string|max:50',
                'state' => 'nullable|string|max:50',
                'postal_code' => 'nullable|string|max:10',
                'parent_phone' => 'nullable|string|max:15',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Update user
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            // Update student
            $student->update([
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'parent_phone' => $request->parent_phone,
            ]);

            Log::info('Student updated: ' . $student->id);
            return redirect()->route('admin.students.index')
                ->with('success', 'Student updated successfully.');

        } catch (\Exception $e) {
            Log::error('Student update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating student.')
                ->withInput();
        }
    }

    /**
     * Remove the specified student
     */
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
            $userId = $student->user_id;
            
            $student->delete();
            User::destroy($userId);

            Log::info('Student deleted: ' . $id);
            return redirect()->route('admin.students.index')
                ->with('success', 'Student deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Student destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting student.');
        }
    }

    /**
     * Show student profile
     */
    public function profile($id)
    {
        try {
            $student = Student::with('user', 'enrollments.course', 'fees', 'examResults', 'attendance')
                ->findOrFail($id);
            return view('admin.students.profile', compact('student'));
        } catch (\Exception $e) {
            Log::error('Student profile error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Student not found.');
        }
    }


    public function results($id)
    {
        $student = Student::with('user','examResults.exam')
            ->findOrFail($id);

        return view('admin.students.results', compact('student'));
    }

    public function courses($id)
        {
            $student = Student::with('enrollments.course')
                ->findOrFail($id);

            $courses = Course::where('status','active')->get();

            return view('admin.students.courses',
                compact('student','courses'));
        }


    public function assignCourse(Request $request,$id)
        {
            CourseEnrollment::create([
                'student_id' => $id,
                'course_id' => $request->course_id,
                'enrollment_date' => now(),
                'status' => 'enrolled'
            ]);

            return back()->with('success','Course assigned successfully.');
        }

    /**
     * Update student status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive,graduated,dropped',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $student = Student::findOrFail($id);
            $student->update(['status' => $request->status]);

            Log::info('Student status updated: ' . $id . ' to ' . $request->status);
            return redirect()->back()
                ->with('success', 'Student status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Student status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating status.');
        }
    }
}
