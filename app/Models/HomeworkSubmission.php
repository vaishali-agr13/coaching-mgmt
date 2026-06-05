<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeworkSubmission extends Model
{
    use HasFactory;

    protected $table = 'homework_submissions';

    protected $fillable = [
        'homework_id',
        'student_id',
        'submission_file_path',
        'submission_date',
        'marks_obtained',
        'total_marks',
        'feedback',
        'evaluated_by',
        'evaluation_date',
        'status',
    ];

    protected $casts = [
        'submission_date' => 'date',
        'evaluation_date' => 'date',
        'marks_obtained' => 'decimal:2',
        'total_marks' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function homework()
    {
        return $this->belongsTo(Homework::class);
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
