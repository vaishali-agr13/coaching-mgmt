<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homework';

    protected $fillable = [
        'homework_code',
        'title',
        'description',
        'course_id',
        'assigned_by',
        'assignment_date',
        'due_date',
        'total_marks',
        'instructions',
        'attachment_file_path',
        'status',
    ];

    protected $casts = [
        'assignment_date' => 'date',
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function assigned_by()
    {
        return $this->belongsTo(Faculty::class, 'assigned_by');
    }

    public function submissions()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }
}
