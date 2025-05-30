<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        return Inertia::render('dashboard/TeamManagement', [
            'teamMembers' => Team::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile' => 'nullable|image|max:5120', // 5MB max
            'social_media' => 'nullable|array',
            'social_media.linkedin' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.github' => 'nullable|url',
        ]);

        if ($request->hasFile('profile')) {
            $path = $request->file('profile')->store('team-profiles', 'public');
            $validated['profile'] = Storage::url($path);
        }

        Team::create($validated);

        return redirect()->back()->with('success', 'Team member added successfully');
    }

    public function update(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'bio' => 'required|string',
            'profile' => 'nullable|image|max:5120',
            'social_media' => 'nullable|array',
            'social_media.linkedin' => 'nullable|url',
            'social_media.twitter' => 'nullable|url',
            'social_media.github' => 'nullable|url',
        ]);

        if ($request->hasFile('profile')) {
            // Delete old profile image if exists
            if ($team->profile) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $team->profile));
            }
            $path = $request->file('profile')->store('team-profiles', 'public');
            $validated['profile'] = Storage::url($path);
        }

        $team->update($validated);

        return redirect()->back()->with('success', 'Team member updated successfully');
    }

    public function destroy(Team $team)
    {
        if ($team->profile) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $team->profile));
        }

        $team->delete();

        return redirect()->back()->with('success', 'Team member deleted successfully');
    }
}
