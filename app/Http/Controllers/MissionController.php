<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\Validator;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mission = Mission::first();


        // if no mission exists, create a blank one so view won't break
        if (!$mission) {
            $mission = Mission::create([
                'image_path' => null,
                'status' => 'active',
                'mission_items' => json_encode([])
            ]);
        }

        return view('backEnd.admin.mission.index', compact('mission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'mission_items' => 'required|array',
            'mission_items.*.icon_class' => 'required|string|max:255',
            'mission_items.*.title' => 'required|string|max:255',
            'mission_items.*.description' => 'required|string',
            'mission_items.*.order' => 'required|integer',
            'mission_items.*.status' => 'required|in:active,inactive',
            'status' => 'required|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $mission = Mission::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image_path')) {
            $data['image_path'] = ImageHelper::uploadImage($request->file('image_path'), 'uploads/mission', $mission->image_path);
        } else {
            $data['image_path'] = $mission->image_path;
        }

        // Ensure mission_items is properly formatted as array
        $missionItems = $request->mission_items;

        // Sort by order if needed
        usort($missionItems, function($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        $data['mission_items'] = $missionItems;

        $mission->update($data);

        return redirect()->route('admin.mission.index')
            ->with('success', 'Mission updated successfully.');
    }
}
