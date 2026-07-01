<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Student;


use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CoursePurchaseController extends Controller
{
    public function checkout(Course $course)
        {
            return view('front-end.courses.checkout', compact('course'));
        }
   
   public function createOrder(Request $request)
{
    $course = Course::findOrFail($request->course_id);

    $student = Auth::user()->student;

    if (!$student) {
        return redirect()
            ->back()
            ->with('error', 'Student profile not found.');
    }

    $alreadyPurchased = CourseEnrollment::where('student_id', $student->id)
        ->where('course_id', $course->id)
        ->exists();

    if ($alreadyPurchased) {

        return redirect()
            ->route('my.courses')
            ->with('error', 'Course already purchased.');
    }
    // Order create karo

    $order = Order::create([

        'user_id' => Auth::id(),

        'course_id' => $course->id,

        'amount' => $course->fee,

        'payment_status' => 'pending',

        'status' => 'pending',

        'payment_id' => null,

    ]);

    return redirect()
        ->route('course.payment', $order->id);
}
public function payment($id)
{
    $order = Order::findOrFail($id);
    return view(
        'front-end.payment.index',
        compact('order')
    );
}

public function paymentSuccess(Order $order)
{

$student = Student::where('user_id', $order->user_id)->first();

    $order->update([

        'payment_status' => 'paid',

        'status' => 'completed'

    ]);

    CourseEnrollment::create([

        'student_id' => $student->id,

        'course_id' => $order->course_id,

        'enrollment_date' => now()

    ]);


    return redirect()

    ->route('my.courses')

    ->with(
        'success',
        'Course Purchased Successfully'
    );
}

public function myCourses()
{

   $student = Student::where('user_id', Auth::id())->first();

    $courses = CourseEnrollment::with('course')

        ->where(
            'student_id',
            $student->id
        )

        ->latest()

        ->get();


    return view(
        'front-end.courses.my-courses',
        compact('courses')
    );
}
}
