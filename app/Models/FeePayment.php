<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeePayment extends Model
{
    use HasFactory;

    protected $table = 'fee_payments';

    protected $fillable = [
        'fee_id',
        'student_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'transaction_id',
        'receipt_number',
    ];

    protected $casts = [
        'amount_paid' => 'decimal:2',
        'payment_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function fee()
    {
        return $this->belongsTo(Fee::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
