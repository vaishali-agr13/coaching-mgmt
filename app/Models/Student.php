<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parent_id',
        'roll_number',
        'registration_number',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state',
        'postal_code',
        'admission_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class);
    }


    public function enrollments()
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_enrollments');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }

    public function homeworkSubmissions()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }
}
