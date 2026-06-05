<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class FacultyController extends Controller
{
    /**
     * Display a listing of faculty
     */
    public function index(Request $request)
    {
        try {
            $query = Faculty::with('user');
            
            if ($request->search) {
                $search = $request->search;
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                })->orWhere('employee_id', 'LIKE', "%{$search}%");
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $faculty = $query->paginate(15);
            return view('admin.faculty.index', compact('faculty'));
        } catch (\Exception $e) {
            Log::error('Faculty index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading faculty.');
        }
    }

    /**
     * Show the form for creating a new faculty
     */
    public function create()
    {
        return view('admin.faculty.create');
    }

    /**
     * Store a newly created faculty
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:15',
                'password' => 'required|min:8|confirmed',
                'employee_id' => 'required|string|unique:faculty,employee_id',
                'department' => 'nullable|string|max:100',
                'specialization' => 'nullable|string|max:100',
                'qualification' => 'nullable|string|max:255',
                'experience_years' => 'nullable|integer',
                'joining_date' => 'required|date',
                'salary' => 'nullable|numeric',
                'office_hours' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'faculty',
                'status' => 'active',
            ]);

            Faculty::create([
                'user_id' => $user->id,
                'employee_id' => $request->employee_id,
                'department' => $request->department,
                'specialization' => $request->specialization,
                'qualification' => $request->qualification,
                'experience_years' => $request->experience_years,
                'joining_date' => $request->joining_date,
                'salary' => $request->salary,
                'status' => 'active',
                'office_hours' => $request->office_hours,
                'bio' => $request->bio,
            ]);

            Log::info('Faculty created: ' . $request->email);
            return redirect()->route('admin.faculty.index')
                ->with('success', 'Faculty created successfully.');

        } catch (\Exception $e) {
            Log::error('Faculty store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating faculty.')
                ->withInput();
        }
    }

    /**
     * Display the specified faculty
     */
    public function show($id)
    {
        try {
            $faculty = Faculty::with('user', 'courses', 'exams')->findOrFail($id);
            return view('admin.faculty.show', compact('faculty'));
        } catch (\Exception $e) {
            Log::error('Faculty show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Faculty not found.');
        }
    }

    /**
     * Show the form for editing faculty
     */
    public function edit($id)
    {
        try {
            $faculty = Faculty::with('user')->findOrFail($id);
            return view('admin.faculty.edit', compact('faculty'));
        } catch (\Exception $e) {
            Log::error('Faculty edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Faculty not found.');
        }
    }

    /**
     * Update the specified faculty
     */
    public function update(Request $request, $id)
    {
        try {
            $faculty = Faculty::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,' . $faculty->user_id,
                'phone' => 'nullable|string|max:15',
                'department' => 'nullable|string|max:100',
                'specialization' => 'nullable|string|max:100',
                'qualification' => 'nullable|string|max:255',
                'experience_years' => 'nullable|integer',
                'salary' => 'nullable|numeric',
                'office_hours' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $faculty->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $faculty->update([
                'department' => $request->department,
                'specialization' => $request->specialization,
                'qualification' => $request->qualification,
                'experience_years' => $request->experience_years,
                'salary' => $request->salary,
                'office_hours' => $request->office_hours,
                'bio' => $request->bio,
            ]);

            Log::info('Faculty updated: ' . $faculty->id);
            return redirect()->route('admin.faculty.index')
                ->with('success', 'Faculty updated successfully.');

        } catch (\Exception $e) {
            Log::error('Faculty update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating faculty.')
                ->withInput();
        }
    }

    /**
     * Remove the specified faculty
     */
    public function destroy($id)
    {
        try {
            $faculty = Faculty::findOrFail($id);
            $userId = $faculty->user_id;
            
            $faculty->delete();
            User::destroy($userId);

            Log::info('Faculty deleted: ' . $id);
            return redirect()->route('admin.faculty.index')
                ->with('success', 'Faculty deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Faculty destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting faculty.');
        }
    }

    /**
     * Show faculty profile
     */
    public function profile($id)
    {
        try {
            $faculty = Faculty::with('user', 'courses', 'exams', 'studyMaterials')->findOrFail($id);
            return view('admin.faculty.profile', compact('faculty'));
        } catch (\Exception $e) {
            Log::error('Faculty profile error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Faculty not found.');
        }
    }

    /**
     * Update faculty status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:active,inactive,on_leave,retired',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $faculty = Faculty::findOrFail($id);
            $faculty->update(['status' => $request->status]);

            Log::info('Faculty status updated: ' . $id . ' to ' . $request->status);
            return redirect()->back()
                ->with('success', 'Faculty status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Faculty status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating status.');
        }
    }
}
