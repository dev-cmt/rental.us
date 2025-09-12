<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::latest()->paginate(10);
        return view('backEnd.admin.team.index', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/team');
        }

        Team::create($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:teams,id',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ]);

        $team = Team::findOrFail($request->id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($team->image) {
                ImageHelper::deleteImage($team->image);
            }
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/team');
        }

        $team->update($data);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        // Delete image if exists
        if ($team->image) {
            ImageHelper::deleteImage($team->image);
        }

        $team->delete();

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member deleted successfully.');
    }
}
