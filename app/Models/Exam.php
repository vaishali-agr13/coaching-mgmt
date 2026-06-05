<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'exam_code',
        'exam_name',
        'course_id',
        'exam_type',
        'exam_date',
        'start_time',
        'end_time',
        'total_marks',
        'passing_marks',
        'location',
        'instructions',
        'created_by',
        'status',
    ];

    protected $casts = [
        'exam_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function created_by()
    {
        return $this->belongsTo(Faculty::class, 'created_by');
    }

    public function results()
    {
        return $this->hasMany(ExamResult::class);
    }
}
