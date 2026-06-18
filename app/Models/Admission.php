<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admission extends Model
{
    use HasFactory;

    protected $table = 'admissions';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'notes',
        'education_background',
        'applied_course_id',
        'application_date',
        'application_status',
        'reviewed_by',
        'review_date',
    ];

    protected $casts = [
        'application_date' => 'datetime',
        'review_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function applied_course()
    {
        return $this->belongsTo(Course::class, 'applied_course_id');
    }

    public function reviewed_by()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
