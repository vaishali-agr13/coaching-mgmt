<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaterialAccessLog extends Model
{
    use HasFactory;

    protected $table = 'material_access_logs';

    protected $fillable = [
        'study_material_id',
        'student_id',
        'accessed_at',
        'ip_address',
    ];

    protected $casts = [
        'accessed_at' => 'datetime',
    ];

    public function material()
    {
        return $this->belongsTo(StudyMaterial::class, 'study_material_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
