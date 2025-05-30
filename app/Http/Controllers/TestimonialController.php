<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        return Inertia::render('dashboard/TestimonialManagement', [
            'testimonials' => Testimonial::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'text' => 'required|string',
            'profile' => 'nullable|image|max:5120',
            'social_media' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('testimonial-profiles', 'public');
            $validated['profile'] = Storage::url($path);
        }

        Testimonial::create($validated);

        return redirect()->back()->with('success', 'Testimonial added successfully');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'text' => 'required|string',
            'profile' => 'nullable|image|max:5120',
            'social_media' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile')) {
            if ($testimonial->profile) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $testimonial->profile));
            }
            $path = $request->file('profile')->store('testimonial-profiles', 'public');
            $validated['profile'] = Storage::url($path);
        }

        $testimonial->update($validated);

        return redirect()->back()->with('success', 'Testimonial updated successfully');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->profile) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $testimonial->profile));
        }
        $testimonial->delete();
        return redirect()->back()->with('success', 'Testimonial deleted successfully');
    }
}
