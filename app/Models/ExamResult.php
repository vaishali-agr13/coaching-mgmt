<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ExamResult extends Model
{
    use HasFactory;

    protected $table = 'exam_results';

    protected $fillable = [
        'exam_id',
        'student_id',
        'marks_obtained',
        'total_marks',
        'percentage',
        'grade',
        'status',
        'remarks',
        'evaluated_by',
        'evaluation_date',
        'published_date',
    ];

    protected $casts = [
        'marks_obtained' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'percentage' => 'decimal:2',
        'evaluation_date' => 'date',
        'published_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function evaluated_by()
    {
        return $this->belongsTo(Faculty::class, 'evaluated_by');
    }
}
