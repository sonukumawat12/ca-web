<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Traits\BlogCategoryTrait;

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
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->category = $request->category;
        $blog->user_id = $request->user_id;
        $blog->is_published = $request->is_published;
        $blog->scheduled_at = $request->scheduled_at ? date('Y-m-d H:i:s', strtotime($request->scheduled_at)) : null;
        $blog->slug = Str::slug($request->title);
        // Create excerpt from content (first 150 characters)
        $blog->excerpt = Str::limit(strip_tags($request->content), 150);

        $blog->save();

        return redirect()->back();
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string',
            'is_published' => 'required|boolean',
            'scheduled_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $imagePath = $request->file('image')->store('blog-images', 'public');
            $validated['image'] = $imagePath;
        }

        $blog->update($validated);

        return redirect()->back()->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->back()->with('success', 'Blog deleted successfully');
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
