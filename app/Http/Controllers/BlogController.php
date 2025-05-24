<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\BlogCategoryTrait;
use Carbon\Carbon;
class BlogController extends Controller
{
    use BlogCategoryTrait;

    public function index()
    {
        $blogs = Blog::latest()->get();
        $user = Auth::user();
        $categories = self::getCategories();
        return Inertia::render('dashboard/BlogManagement', [
            'blogs' => $blogs,
            'user' => $user,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'user_id' => 'required|exists:users,id',
            'is_published' => 'required|boolean',
            'scheduled_at' => 'nullable|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);

        try {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->category = $request->category;
            $blog->user_id = $request->user_id;
            $blog->is_published = $request->is_published;
            if ($blog->is_published) {
                $blog->published_at = Carbon::now();
            }
            $blog->scheduled_at = $request->scheduled_at ? date('Y-m-d H:i:s', strtotime($request->scheduled_at)) : null;
            $blog->slug = Str::slug($request->title);
            // Create excerpt from content (first 150 characters)
            $blog->excerpt = Str::limit(strip_tags($request->content), 20);

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                
                // Store new image
                $imagePath = $request->file('image')->store('blog-images', 'public');
                $fullPath = config('app.url') . '/storage/' . $imagePath;
                $blog->image = $fullPath;
            }

            $blog->save();

            return redirect()->back()->with('success', 'Blog post created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create blog post. Please try again.');
        }
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'is_published' => 'required|boolean',
            'scheduled_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);

        try {
            $blog->title = $request->title;
            $blog->content = $request->content;
            $blog->category = $request->category;
            $blog->is_published = $request->is_published;
            $blog->scheduled_at = $request->scheduled_at ? date('Y-m-d H:i:s', strtotime($request->scheduled_at)) : null;
            $blog->slug = Str::slug($request->title);
            $blog->excerpt = Str::limit(strip_tags($request->content), 150);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($blog->image) {
                    Storage::disk('public')->delete($blog->image);
                }
                
                // Store new image
                $imagePath = $request->file('image')->store('blog-images', 'public');
                $blog->image = $imagePath;
            }

            $blog->save();

            return redirect()->back()->with('success', 'Blog post updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update blog post. Please try again.');
        }
    }

    public function destroy(Blog $blog)
    {
        try {
            // Delete the image file
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            
            $blog->delete();
            
            return redirect()->back()->with('success', 'Blog post deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete blog post. Please try again.');
        }
    }

    public function schedule(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'scheduled_at' => 'required|date|after:now',
        ]);

        $blog->update($validated);

        return redirect()->back()->with('success', 'Blog scheduled successfully');
    }
}

