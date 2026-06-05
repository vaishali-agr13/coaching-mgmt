<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Course;
use App\Models\MaterialAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of study materials
     */
    public function index(Request $request)
    {
        try {
            $query = StudyMaterial::with('course', 'uploaded_by.user');
            
            if ($request->search) {
                $query->where('title', 'LIKE', "%{$request->search}%")
                      ->orWhere('material_code', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->course_id) {
                $query->where('course_id', $request->course_id);
            }
            
            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            $materials = $query->paginate(15);
            $courses = Course::where('status', 'active')->get();
            
            return view('admin.study-materials.index', compact('materials', 'courses'));
        } catch (\Exception $e) {
            Log::error('Study material index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading materials.');
        }
    }

    /**
     * Show the form for creating a new material
     */
    public function create()
    {
        try {
            $courses = Course::where('status', 'active')->get();
            return view('admin.study-materials.create', compact('courses'));
        } catch (\Exception $e) {
            Log::error('Study material create error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading form.');
        }
    }

    /**
     * Store a newly created material
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'material_code' => 'required|string|unique:study_materials,material_code',
                'title' => 'required|string|max:200',
                'description' => 'nullable|string',
                'course_id' => 'required|exists:courses,id',
                'material_type' => 'required|in:pdf,video,document,presentation,image,audio,other',
                'file' => 'required|file|max:102400',
                'chapter_number' => 'nullable|integer',
                'order_sequence' => 'nullable|integer',
                'visibility' => 'required|in:public,private,restricted',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $file = $request->file('file');
            $path = Storage::disk('public')->put('study-materials', $file);
            $fileSize = $file->getSize();

            StudyMaterial::create([
                'material_code' => $request->material_code,
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'material_type' => $request->material_type,
                'file_path' => $path,
                'file_size' => $fileSize,
                'chapter_number' => $request->chapter_number,
                'order_sequence' => $request->order_sequence,
                'uploaded_by' => auth()->user()->id,
                'visibility' => $request->visibility,
                'status' => 'active',
            ]);

            Log::info('Study material created: ' . $request->material_code);
            return redirect()->route('admin.study-materials.index')
                ->with('success', 'Study material uploaded successfully.');

        } catch (\Exception $e) {
            Log::error('Study material store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error uploading material.')
                ->withInput();
        }
    }

    /**
     * Display the specified material
     */
    public function show($id)
    {
        try {
            $material = StudyMaterial::with('course', 'uploaded_by.user')->findOrFail($id);
            return view('admin.study-materials.show', compact('material'));
        } catch (\Exception $e) {
            Log::error('Study material show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Material not found.');
        }
    }

    /**
     * Show the form for editing material
     */
    public function edit($id)
    {
        try {
            $material = StudyMaterial::findOrFail($id);
            $courses = Course::where('status', 'active')->get();
            return view('admin.study-materials.edit', compact('material', 'courses'));
        } catch (\Exception $e) {
            Log::error('Study material edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Material not found.');
        }
    }

    /**
     * Update the specified material
     */
    public function update(Request $request, $id)
    {
        try {
            $material = StudyMaterial::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:200',
                'description' => 'nullable|string',
                'course_id' => 'required|exists:courses,id',
                'material_type' => 'required|in:pdf,video,document,presentation,image,audio,other',
                'chapter_number' => 'nullable|integer',
                'order_sequence' => 'nullable|integer',
                'visibility' => 'required|in:public,private,restricted',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $material->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'material_type' => $request->material_type,
                'chapter_number' => $request->chapter_number,
                'order_sequence' => $request->order_sequence,
                'visibility' => $request->visibility,
            ]);

            Log::info('Study material updated: ' . $material->id);
            return redirect()->route('admin.study-materials.index')
                ->with('success', 'Study material updated successfully.');

        } catch (\Exception $e) {
            Log::error('Study material update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating material.')
                ->withInput();
        }
    }

    /**
     * Remove the specified material
     */
    public function destroy($id)
    {
        try {
            $material = StudyMaterial::findOrFail($id);
            
            if (Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }
            
            $material->delete();

            Log::info('Study material deleted: ' . $id);
            return redirect()->route('admin.study-materials.index')
                ->with('success', 'Study material deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Study material destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting material.');
        }
    }

    /**
     * Download material
     */
    public function download($id)
    {
        try {
            $material = StudyMaterial::findOrFail($id);

            if (!Storage::disk('public')->exists($material->file_path)) {
                return redirect()->back()->with('error', 'File not found.');
            }

            $material->increment('downloads_count');

            return Storage::disk('public')->download($material->file_path);

        } catch (\Exception $e) {
            Log::error('Study material download error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error downloading material.');
        }
    }

    /**
     * Update material status
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:active,archived,draft',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $material = StudyMaterial::findOrFail($id);
            $material->update(['status' => $request->status]);

            Log::info('Study material status updated: ' . $id . ' to ' . $request->status);
            return redirect()->back()
                ->with('success', 'Material status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Study material status update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating status.');
        }
    }
}
