<?php
// app/Http/Controllers/Admin/ServiceController.php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('sort_order')->paginate(10);
        return view('backEnd.admin.services.index', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/services');
        }
        Service::create($data);
        return redirect()->back()->with('success', 'Service created successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:services,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sort_order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        $service = Service::findOrFail($request->id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/services', $service->image);
        } else {
            // Keep the existing image if no new image is uploaded
            $data['image'] = $service->image;
        }
        $service->update($data);

        return redirect()->back()->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        // Delete image if exists
        if ($service->image) {
            ImageHelper::deleteImage($service->image);
        }

        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
}
