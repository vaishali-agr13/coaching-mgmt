<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\GalleryAlbum;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    /**
     * Display a listing of albums
     */
    public function index(Request $request)
    {
        try {
            $query = GalleryAlbum::with('created_by')->withCount('images');
            
            if ($request->search) {
                $query->where('album_name', 'LIKE', "%{$request->search}%");
            }
            
            if ($request->visibility) {
                $query->where('visibility', $request->visibility);
            }
            
            $albums = $query->paginate(15);
            return view('admin.gallery.index', compact('albums'));
        } catch (\Exception $e) {
            Log::error('Gallery index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading albums.');
        }
    }

    /**
     * Show the form for creating a new album
     */
    public function createAlbum()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created album
     */
    public function storeAlbum(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'album_name' => 'required|string|max:200',
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|max:5120',
                'album_date' => 'nullable|date',
                'visibility' => 'required|in:public,private,members_only',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $coverImagePath = null;
            if ($request->hasFile('cover_image')) {
                $coverImagePath = Storage::disk('public')->put('gallery-covers', $request->file('cover_image'));
            }

            GalleryAlbum::create([
                'album_code' => 'ALB-' . time(),
                'album_name' => $request->album_name,
                'description' => $request->description,
                'cover_image' => $coverImagePath,
                'created_by' => auth()->user()->id,
                'album_date' => $request->album_date,
                'visibility' => $request->visibility,
                'status' => 'active',
            ]);

            Log::info('Gallery album created');
            return redirect()->route('admin.gallery.index')
                ->with('success', 'Album created successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery album store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating album.')
                ->withInput();
        }
    }

    /**
     * Display the specified album
     */
    public function showAlbum($albumId)
    {
        try {
            $album = GalleryAlbum::with('images', 'created_by')->findOrFail($albumId);
            return view('admin.gallery.show', compact('album'));
        } catch (\Exception $e) {
            Log::error('Gallery show album error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Album not found.');
        }
    }

    /**
     * Show the form for editing album
     */
    public function editAlbum($albumId)
    {
        try {
            $album = GalleryAlbum::findOrFail($albumId);
            return view('admin.gallery.edit', compact('album'));
        } catch (\Exception $e) {
            Log::error('Gallery edit album error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Album not found.');
        }
    }

    /**
     * Update the specified album
     */
    public function updateAlbum(Request $request, $albumId)
    {
        try {
            $album = GalleryAlbum::findOrFail($albumId);

            $validator = Validator::make($request->all(), [
                'album_name' => 'required|string|max:200',
                'description' => 'nullable|string',
                'cover_image' => 'nullable|image|max:5120',
                'album_date' => 'nullable|date',
                'visibility' => 'required|in:public,private,members_only',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $coverImagePath = $album->cover_image;
            if ($request->hasFile('cover_image')) {
                if ($album->cover_image && Storage::disk('public')->exists($album->cover_image)) {
                    Storage::disk('public')->delete($album->cover_image);
                }
                $coverImagePath = Storage::disk('public')->put('gallery-covers', $request->file('cover_image'));
            }

            $album->update([
                'album_name' => $request->album_name,
                'description' => $request->description,
                'cover_image' => $coverImagePath,
                'album_date' => $request->album_date,
                'visibility' => $request->visibility,
            ]);

            Log::info('Gallery album updated: ' . $albumId);
            return redirect()->route('admin.gallery.index')
                ->with('success', 'Album updated successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery album update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating album.')
                ->withInput();
        }
    }

    /**
     * Remove the specified album
     */
    public function destroyAlbum($albumId)
    {
        try {
            $album = GalleryAlbum::findOrFail($albumId);
            
            // Delete all images
            foreach ($album->images as $image) {
                if (Storage::disk('public')->exists($image->image_file_path)) {
                    Storage::disk('public')->delete($image->image_file_path);
                }
            }
            
            if ($album->cover_image && Storage::disk('public')->exists($album->cover_image)) {
                Storage::disk('public')->delete($album->cover_image);
            }
            
            $album->delete();

            Log::info('Gallery album deleted: ' . $albumId);
            return redirect()->route('admin.gallery.index')
                ->with('success', 'Album deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery album destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting album.');
        }
    }

    /**
     * Store image to album
     */
    public function storeImage(Request $request, $albumId)
    {
        try {
            $album = GalleryAlbum::findOrFail($albumId);

            $validator = Validator::make($request->all(), [
                'image' => 'required|image|max:5120',
                'image_title' => 'nullable|string|max:200',
                'image_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $imagePath = Storage::disk('public')->put('gallery-images', $request->file('image'));

            GalleryImage::create([
                'album_id' => $albumId,
                'image_file_path' => $imagePath,
                'image_title' => $request->image_title,
                'image_description' => $request->image_description,
                'uploaded_by' => auth()->user()->id,
                'status' => 'active',
            ]);

            Log::info('Gallery image uploaded to album: ' . $albumId);
            return redirect()->back()
                ->with('success', 'Image uploaded successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery image store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error uploading image.')
                ->withInput();
        }
    }

    /**
     * Edit image
     */
    public function editImage($imageId)
    {
        try {
            $image = GalleryImage::findOrFail($imageId);
            return view('admin.gallery.edit-image', compact('image'));
        } catch (\Exception $e) {
            Log::error('Gallery edit image error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Image not found.');
        }
    }

    /**
     * Update image
     */
    public function updateImage(Request $request, $imageId)
    {
        try {
            $image = GalleryImage::findOrFail($imageId);

            $validator = Validator::make($request->all(), [
                'image_title' => 'nullable|string|max:200',
                'image_description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $image->update([
                'image_title' => $request->image_title,
                'image_description' => $request->image_description,
            ]);

            Log::info('Gallery image updated: ' . $imageId);
            return redirect()->back()
                ->with('success', 'Image updated successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery image update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating image.')
                ->withInput();
        }
    }

    /**
     * Delete image
     */
    public function destroyImage($imageId)
    {
        try {
            $image = GalleryImage::findOrFail($imageId);
            $albumId = $image->album_id;
            
            if (Storage::disk('public')->exists($image->image_file_path)) {
                Storage::disk('public')->delete($image->image_file_path);
            }
            
            $image->delete();

            Log::info('Gallery image deleted: ' . $imageId);
            return redirect()->back()
                ->with('success', 'Image deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Gallery image destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting image.');
        }
    }
}
