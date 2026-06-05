<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
        'student_id',
        'course_id',
        'attendance_date',
        'status',
        'marked_by',
        'remarks',
    ];

    protected $casts = [
        'attendance_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function marked_by()
    {
        return $this->belongsTo(Faculty::class, 'marked_by');
    }
}
