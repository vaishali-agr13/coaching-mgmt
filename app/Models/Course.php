<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'category',
        'level',
        'duration_hours',
        'max_students',
        'faculty_id',
        'start_date',
        'end_date',
        'fee',
        'status',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_enrollments');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function studyMaterials()
    {
        return $this->hasMany(StudyMaterial::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }
}
