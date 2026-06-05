<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $table = 'study_materials';

    protected $fillable = [
        'material_code',
        'title',
        'description',
        'course_id',
        'material_type',
        'file_path',
        'file_size',
        'chapter_number',
        'order_sequence',
        'uploaded_by',
        'visibility',
        'status',
        'downloads_count',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'downloads_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function uploaded_by()
    {
        return $this->belongsTo(Faculty::class, 'uploaded_by');
    }

    public function access_logs()
    {
        return $this->hasMany(MaterialAccessLog::class);
    }
}
