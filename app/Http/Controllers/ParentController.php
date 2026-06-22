<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fee;
use App\Models\ExamResult;
use App\Models\ParentModel;
use App\Models\Attendance;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParentController extends Controller
{
    public function index()
        {
        $parents=ParentModel::with('user')
                    ->latest()
                    ->get();

        return view(
            'admin.parents.index',
            compact('parents')
        );
        }

    public function create()
        {
        return view('admin.parents.create');
        }

        public function store(Request $request)
            {
            $request->validate([

                'email'=>'required|email|unique:users',

                'password'=>'required|min:6',

                'father_name'=>'required',

                'phone'=>'required',

                'address'=>'required',

            ]);

            $user=User::create([

                'name'=>$request->father_name,

                'phone'=>$request->phone,

                'email'=>$request->email,

                'password'=>Hash::make($request->password),

                'role'=>'parent'

            ]);

            ParentModel::create([

                'user_id'=>$user->id,

                'father_name'=>$request->father_name,

                'mother_name'=>$request->mother_name,

                'phone'=>$request->phone,

                'alternate_phone'=>$request->alternate_phone,

                'occupation'=>$request->occupation,

                'email'=>$request->email,

                'address'=>$request->address

            ]);

            return redirect()
                    ->route('admin.parents.index')
                    ->with('success','Parent Added Successfully');
            }

    public function edit($id)
        {
        $parent=ParentModel::with('user')
                ->findOrFail($id);

        return view(
            'admin.parents.edit',
            compact('parent')
        );
        }

    public function update(Request $request,$id)
        {
        $parent=ParentModel::findOrFail($id);

        $parent->user->update([

            'name'=>$request->name,

            'email'=>$request->email,

        ]);

        $parent->update([

            'father_name'=>$request->father_name,

            'mother_name'=>$request->mother_name,

            'phone'=>$request->phone,

            'alternate_phone'=>$request->alternate_phone,

            'occupation'=>$request->occupation,

            'email'=>$request->email,

            'address'=>$request->address

        ]);

        return redirect()
                ->route('admin.parents.index')
                ->with('success','Updated Successfully');
        }

    public function destroy($id)
        {
        $parent=ParentModel::findOrFail($id);

        $parent->user()->delete();

        $parent->delete();

        return redirect()
                ->route('admin.parents.index')
                ->with('success','Deleted Successfully');
        }

    public function attendance()
    {
        $user = Auth::user();

        $parent = ParentModel::where('user_id', $user->id)->first();

        if (!$parent) {
            return back()->with('error', 'Parent not found.');
        }

        // Parent ke saare students
        $studentIds = $parent->students()->pluck('id');

        // Attendance + student name
       // print_r($studentIds);die;
        $attendance = Attendance::with('student.user')
                ->whereIn('student_id', $studentIds)
                ->orderBy('attendance_date', 'desc')
                ->latest()
                ->get();

        return view('admin.parents.attendance', compact('attendance'));
    }



  public function fees()
    {
        $user = Auth::user();

        $parent = ParentModel::where('user_id', $user->id)->first();

        if (!$parent) {
            return back()->with('error', 'Parent not found.');
        }

        // Parent ke saare students ki ids
        $studentIds = $parent->students()->pluck('id');

        // Fees + student + user
        $fees = Fee::with(['student.user','course'])
                    ->whereIn('student_id', $studentIds)
                    ->orderBy('payment_date', 'desc')
                    ->get();

        return view('admin.parents.fee', compact('fees'));
    }


    public function progress()
    {
        $user = Auth::user();

        $parent = ParentModel::where('user_id', $user->id)->first();

        if (!$parent) {
            return back()->with('error', 'Parent not found.');
        }

        $student = $parent->students()->first();

        if (!$student) {
            return back()->with('error', 'No student assigned.');
        }

        $attendance = Attendance::where(
            'student_id',
            $student->id
        )->latest()->get();

        $results = ExamResult::with('exam.course')
                    ->where('student_id', $student->id)
                    ->latest()
                    ->get();


        $totalClasses = $attendance->count();

        $present = $attendance
                    ->where('status', 'present')
                    ->count();

        $absent = $attendance
                    ->where('status', 'absent')
                    ->count();

        $attendancePercentage = $totalClasses
            ? round(($present / $totalClasses) * 100)
            : 0;


        return view(
            'admin.parents.progress',
            compact(
                'student',
                'attendance',
                'results',
                'totalClasses',
                'present',
                'absent',
                'attendancePercentage'
            )
        );
    }



    public function results()
    {
        $parent=Auth::guard('parent')->user();

        $student=$parent->students()->first();

        $results=ExamResult::where(
            'student_id',
            $student->id
        )->get();

        return view(
            'parent.results',
            compact('results')
        );
    }



   
}
