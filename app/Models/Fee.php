<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;

    protected $table = 'fees';

    protected $fillable = [
        'student_id',
        'course_id',
        'fee_amount',
        'due_date',
        'fee_type',
        'status',
    ];

    protected $casts = [
        'fee_amount' => 'decimal:2',
        'due_date' => 'date',
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

    public function payments()
    {
        return $this->hasMany(FeePayment::class);
    }
}
