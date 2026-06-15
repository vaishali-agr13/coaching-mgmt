<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts
     */
    public function index(Request $request)
    {
        try {
            $query = BlogPost::with('author');
            
            if ($request->search) {
                $query->where(function ($q) use ($request) {
                    $q->where('title', 'LIKE', "%{$request->search}%")
                    ->orWhere('content', 'LIKE', "%{$request->search}%");
                });
            }

            if ($request->status) {
                $query->where('status', $request->status);
            }
            
            if ($request->category) {
                $query->where('category', $request->category);
            }
            
            $posts = $query->orderBy('published_at', 'desc')->paginate(15);
            return view('admin.blog.index', compact('posts'));
        } catch (\Exception $e) {
            Log::error('Blog index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading posts.');
        }
    }

    /**
     * Show the form for creating a new post
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created post
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'excerpt' => 'nullable|string|max:500',
                'featured_image' => 'nullable|image|max:5120',
                'category' => 'nullable|string|max:100',
                'status' => 'required|in:draft,published,archived',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = Str::slug($request->title);
            $imagePath = null;

            if ($request->hasFile('featured_image')) {
                $imagePath = Storage::disk('public')->put('blog-images', $request->file('featured_image'));
            }

            BlogPost::create([
                'slug' => $slug,
                'title' => $request->title,
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'featured_image' => $imagePath,
                'author_id' => auth()->user()->id,
                'category' => $request->category,
                'status' => $request->status,
                'published_at' => $request->status === 'published' ? now() : null,
            ]);

            Log::info('Blog post created: ' . $slug);
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post created successfully.');

        } catch (\Exception $e) {
            Log::error('Blog store error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error creating post.')
                ->withInput();
        }
    }

    /**
     * Display the specified post
     */
    public function show($id)
    {
        try {
            $post = BlogPost::with('author', 'comments')->findOrFail($id);
            return view('admin.blog.show', compact('post'));
        } catch (\Exception $e) {
            Log::error('Blog show error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Post not found.');
        }
    }

    /**
     * Show the form for editing post
     */
    public function edit($id)
    {
        try {
            $post = BlogPost::findOrFail($id);
            return view('admin.blog.edit', compact('post'));
        } catch (\Exception $e) {
            Log::error('Blog edit error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Post not found.');
        }
    }

    /**
     * Update the specified post
     */
    public function update(Request $request, $id)
    {
        try {
            $post = BlogPost::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'excerpt' => 'nullable|string|max:500',
                'featured_image' => 'nullable|image|max:5120',
                'category' => 'nullable|string|max:100',
                'status' => 'required|in:draft,published,archived',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = Str::slug($request->title);
            $imagePath = $post->featured_image;

            if ($request->hasFile('featured_image')) {
                if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                    Storage::disk('public')->delete($post->featured_image);
                }
                $imagePath = Storage::disk('public')->put('blog-images', $request->file('featured_image'));
            }

            $post->update([
                'slug' => $slug,
                'title' => $request->title,
                'content' => $request->content,
                'excerpt' => $request->excerpt,
                'featured_image' => $imagePath,
                'category' => $request->category,
                'status' => $request->status,
                'published_at' => $request->status === 'published' ? ($post->published_at ?? now()) : null,
            ]);

            Log::info('Blog post updated: ' . $post->id);
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post updated successfully.');

        } catch (\Exception $e) {
            Log::error('Blog update error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error updating post.')
                ->withInput();
        }
    }

    /**
     * Remove the specified post
     */
    public function destroy($id)
    {
        try {
            $post = BlogPost::findOrFail($id);
            
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $post->delete();

            Log::info('Blog post deleted: ' . $id);
            return redirect()->route('admin.blog.index')
                ->with('success', 'Blog post deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Blog destroy error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting post.');
        }
    }

    /**
     * Publish post
     */
    public function publish(Request $request, $id)
    {
        try {
            $post = BlogPost::findOrFail($id);
            $post->update([
                'status' => 'published',
                'published_at' => now(),
            ]);

            Log::info('Blog post published: ' . $id);
            return redirect()->back()->with('success', 'Post published successfully.');

        } catch (\Exception $e) {
            Log::error('Blog publish error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error publishing post.');
        }
    }

    /**
     * Unpublish post
     */
    public function unpublish(Request $request, $id)
    {
        try {
            $post = BlogPost::findOrFail($id);
            $post->update([
                'status' => 'draft',
                'published_at' => null,
            ]);

            Log::info('Blog post unpublished: ' . $id);
            return redirect()->back()->with('success', 'Post unpublished successfully.');

        } catch (\Exception $e) {
            Log::error('Blog unpublish error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error unpublishing post.');
        }
    }

    /**
     * View comments
     */
    public function comments($id)
    {
        try {
            $post = BlogPost::findOrFail($id);
            $comments = BlogComment::where('post_id', $id)
                ->with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
            
            return view('admin.blog.comments', compact('post', 'comments'));
        } catch (\Exception $e) {
            Log::error('Blog comments error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error loading comments.');
        }
    }

    /**
     * Approve comment
     */
    public function approveComment($commentId)
    {
        try {
            $comment = BlogComment::findOrFail($commentId);
            $comment->update(['status' => 'approved']);

            Log::info('Blog comment approved: ' . $commentId);
            return redirect()->back()->with('success', 'Comment approved successfully.');

        } catch (\Exception $e) {
            Log::error('Approve comment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error approving comment.');
        }
    }

    /**
     * Delete comment
     */
    public function deleteComment($commentId)
    {
        try {
            $comment = BlogComment::findOrFail($commentId);
            $comment->delete();

            Log::info('Blog comment deleted: ' . $commentId);
            return redirect()->back()->with('success', 'Comment deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Delete comment error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error deleting comment.');
        }
    }
}
