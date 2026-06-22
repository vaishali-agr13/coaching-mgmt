<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [

        'user_id',

        'father_name',

        'mother_name',

        'phone',

        'email',

        'occupation',

        'address',
    ];

   public function students()
    {
        return $this->hasMany(Student::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
