<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';

    protected $fillable = [
        'album_id',
        'image_file_path',
        'image_title',
        'image_description',
        'uploaded_by',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'album_id');
    }

    public function uploaded_by()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
