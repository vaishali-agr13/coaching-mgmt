<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;
    protected $table = 'faculty'; 

    protected $fillable = [
        'user_id',
        'employee_id',
        'department',
        'specialization',
        'qualification',
        'experience_years',
        'joining_date',
        'salary',
        'status',
        'office_hours',
        'bio',
        'faculty_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function attendanceMarked()
    {
        return $this->hasMany(Attendance::class, 'marked_by');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'created_by');
    }

    public function homeworkAssigned()
    {
        return $this->hasMany(Homework::class, 'assigned_by');
    }

    public function homeworkEvaluated()
    {
        return $this->hasMany(HomeworkSubmission::class, 'evaluated_by');
    }

    public function examResultsEvaluated()
    {
        return $this->hasMany(ExamResult::class, 'evaluated_by');
    }

    public function studyMaterials()
    {
        return $this->hasMany(StudyMaterial::class, 'uploaded_by');
    }
}
