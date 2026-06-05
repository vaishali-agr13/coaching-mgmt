<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryAlbum extends Model
{
    use HasFactory;

    protected $table = 'gallery_albums';

    protected $fillable = [
        'album_code',
        'album_name',
        'description',
        'cover_image',
        'created_by',
        'album_date',
        'visibility',
        'status',
    ];

    protected $casts = [
        'album_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(GalleryImage::class, 'album_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
