<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\FeePayment;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FeeController extends Controller
{
    /**
     * Display a listing of fees
     */
    public function index(Request $request)
    {
        try {
            $query = Fee::with('student.user', 'course');
            
            if ($request->search) {
                $query->whereHas('student.user', function($q) use ($request) {
                    $q->where('name', 'LIKE', "%{$request->search}%");
                });
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $fees = $query->paginate(15);
            return view('admin.fees.index', compact('fees'));
        } catch (\Exception $e) {
             echo $e->getMessage();die;
            Log::error('Fee index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading fees.');
        }
    }

    /**
     * Show the form for creating a new fee
     */
    public function create()
    {
        try {
            $students = Student::where('status', 'active')->with('user')->get();
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.fees.create', compact('students', 'courses'));
        } catch (\Exception $e) {
            Log::error('Fee create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading form.');
        }
    }

    /**
     * Store a newly created fee
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_id' => 'required|exists:students,id',
                'course_id' => 'required|exists:courses,id',
                'fee_amount' => 'required|numeric|min:0',
                'fee_type' => 'required|in:tuition,exam,library,lab,activity,other',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $fee = Fee::create([
                'student_id' => $request->student_id,
                'course_id' => $request->course_id,
                'fee_amount' => $request->fee_amount,
                'paid_amount' => $request->paid_amount,
                'due_amount' => $request->due_amount,
                'payment_date' => $request->payment_date,
                'payment_mode' => $request->payment_mode,
                'transaction_id'=>$request->transaction_id,
                'fee_type' => $request->fee_type,
                'status' => $request->status,
            ]);

            Log::info('Fee created for student: ' . $request->student_id);
            return redirect()->route('admin.fees.index')
                ->with('success', 'Fee created successfully.');

        } catch (\Exception $e) {
            echo 'here'; die;
            Log::error('Fee store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating fee.')
                ->withInput();
        }
    }

    /**
     * Display the specified fee
     */
    public function show($id)
    {
        try {
            $fee = Fee::with('student.user', 'course', 'payments')->findOrFail($id);
            return view('admin.fees.show', compact('fee'));
        } catch (\Exception $e) {
            Log::error('Fee show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Fee not found.');
        }
    }

    /**
     * Show the form for editing fee
     */
    public function edit($id)
    {
        try {
            $fee = Fee::findOrFail($id);
            $students = Student::where('status', 'active')->with('user')->get();
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.fees.edit', compact('fee', 'students', 'courses'));
        } catch (\Exception $e) {
            Log::error('Fee edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Fee not found.');
        }
    }

    /**
     * Update the specified fee
     */
    public function update(Request $request, $id)
    {
        try {
            $fee = Fee::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'fee_amount' => 'required|numeric|min:0',
                'fee_type' => 'required|in:tuition,exam,library,lab,activity,other',
                'status' => 'required|in:pending,partial,paid,overdue,waived',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $fee->update([
                'student_id' => $request->student_id,
                'course_id' => $request->course_id,
                'fee_amount' => $request->fee_amount,
                'paid_amount' => $request->paid_amount,
                'due_amount' => $request->due_amount,
                'payment_date' => $request->payment_date,
                'payment_mode' => $request->payment_mode,
                'transaction_id'=>$request->transaction_id,
                'fee_type' => $request->fee_type,
                'status' => $request->status,
            ]);

            Log::info('Fee updated: ' . $fee->id);
            return redirect()->route('admin.fees.index')
                ->with('success', 'Fee updated successfully.');

        } catch (\Exception $e) {
            Log::error('Fee update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating fee.')
                ->withInput();
        }
    }

    /**
     * Remove the specified fee
     */
    public function destroy($id)
    {
        try {
            $fee = Fee::findOrFail($id);
            $fee->delete();

            Log::info('Fee deleted: ' . $id);
            return redirect()->route('admin.fees.index')
                ->with('success', 'Fee deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Fee destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting fee.');
        }
    }

    /**
     * Record payment
     */
    public function recordPayment(Request $request, $id)
    {
        try {
            $fee = Fee::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'amount_paid' => 'required|numeric|min:0|max:' . $fee->fee_amount,
                'payment_date' => 'required|date',
                'payment_method' => 'required|in:cash,cheque,online,bank_transfer',
                'transaction_id' => 'nullable|string|max:100|unique:fee_payments,transaction_id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $payment = FeePayment::create([
                'fee_id' => $fee->id,
                'student_id' => $fee->student_id,
                'amount_paid' => $request->amount_paid,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'transaction_id' => $request->transaction_id,
                'receipt_number' => 'RCP-' . time(),
            ]);

            // Update fee status
            $totalPaid = $fee->payments()->sum('amount_paid') + $request->amount_paid;
            if ($totalPaid >= $fee->fee_amount) {
                $fee->update(['status' => 'paid']);
            } else {
                $fee->update(['status' => 'partial']);
            }

            Log::info('Payment recorded for fee: ' . $fee->id);
            return redirect()->back()
                ->with('success', 'Payment recorded successfully. Receipt: ' . $payment->receipt_number);

        } catch (\Exception $e) {
            Log::error('Record payment error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error recording payment.')
                ->withInput();
        }
    }

    /**
     * Student fees
     */
    public function studentFees($studentId)
    {
        try {
            $student = Student::with('user')->findOrFail($studentId);
            $fees = Fee::where('student_id', $studentId)->with('payments', 'course')->get();
            
            $totalFee = $fees->sum('fee_amount');
            $totalPaid = $fees->sum(function($fee) {
                return $fee->payments->sum('amount_paid');
            });
            $pending = $totalFee - $totalPaid;
            
            return view('admin.fees.student', compact(
                'student', 'fees', 'totalFee', 'totalPaid', 'pending'
            ));
        } catch (\Exception $e) {
            Log::error('Student fees error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Student not found.');
        }
    }

    /**
     * Collection report
     */
    public function collectionReport()
    {
        try {
            $totalFee = Fee::sum('fee_amount');
            $totalCollected = FeePayment::sum('amount_paid');
            $pendingFee = $totalFee - $totalCollected;
            $percentage = $totalFee > 0 ? round(($totalCollected / $totalFee) * 100, 2) : 0;
            
            $feesByStatus = Fee::selectRaw('status, COUNT(*) as count, SUM(fee_amount) as total')
                ->groupBy('status')
                ->get();
            
            return view('admin.fees.report', compact(
                'totalFee', 'totalCollected', 'pendingFee', 'percentage', 'feesByStatus'
            ));
        } catch (\Exception $e) {
            Log::error('Collection report error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading report.');
        }
    }
}
