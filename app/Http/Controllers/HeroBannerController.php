<?php
// app/Http/Controllers/Admin/HeroBannerController.php

namespace App\Http\Controllers;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class HeroBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroBanner = HeroBanner::first();
        return view('backEnd.admin.hero-banner.index', compact('heroBanner'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'badge_text'       => 'nullable|string|max:255',
            'badge_color'      => 'nullable|string|max:50',
            'title'            => 'required|string|max:255',
            'description'      => 'required|string',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'search_locations' => 'nullable|string',
            'popular_searches' => 'nullable|string',
        ]);

        try {
            // Get the latest hero banner or create a new instance
            $heroBanner = HeroBanner::latest()->first() ?? new HeroBanner();

            // Handle image upload
            if ($request->hasFile('image')) {
                $heroBanner->image = ImageHelper::uploadImage(
                    $request->file('image'),
                    'uploads/hero-banner',
                    $heroBanner->image // delete old image if exists
                );
            }

            // Assign other fields
            $heroBanner->badge_text       = $request->badge_text;
            $heroBanner->badge_color      = $request->badge_color;
            $heroBanner->title            = $request->title;
            $heroBanner->description      = $request->description;
            $heroBanner->search_locations = $request->search_locations ? array_map('trim', explode(',', $request->search_locations)) : [];
            $heroBanner->popular_searches = $request->popular_searches ? array_map('trim', explode(',', $request->popular_searches)) : [];
            $heroBanner->is_active        = $request->has('is_active');
            $heroBanner->save();

            return redirect()->back()->with('success', 'Hero banner saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error saving hero banner: ' . $e->getMessage());
        }
    }


}
