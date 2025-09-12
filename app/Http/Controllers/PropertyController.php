<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Category;
use App\Models\Feature;
use App\Models\PropertyImage;
use App\Models\PropertyAttachment;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('category', 'images')->latest()->paginate(10);
        return view('backEnd.admin.properties.index', compact('properties'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $features = Feature::where('status', 'active')->get();
        return view('backEnd.admin.properties.create', compact('categories', 'features'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_county' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:5120'
        ]);

        $propertyData = $request->all();
        $propertyData['is_featured'] = $request->has('is_featured');

        // Convert Google Maps link to embed
        // if ($request->filled('location')) {
        //     $propertyData['location'] = $this->convertToEmbedLink($request->location);
        // }

        $property = Property::create($propertyData);

        if ($request->has('features')) {
            $property->features()->sync($request->features);
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $hasDefault = PropertyImage::where('property_id', $property->id)->where('is_default', true)->exists();

            foreach ($request->file('images') as $key => $img) {
                if ($path = ImageHelper::uploadImage($img, 'uploads/properties')) {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $path,
                        'is_default' => !$hasDefault && $key === 0,
                    ]);
                }
            }
        }

        // Handle new attachments upload
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $key => $attachment) {
                // Upload the file using your helper
                $filePath = ImageHelper::uploadImage($attachment, 'uploads/properties/attachments');

                if ($filePath) {
                    PropertyAttachment::create([
                        'property_id' => $property->id,
                        'name' => $request->input('attachment_name')[$key] ?? $attachment->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.properties.index')->with('success', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        $property->load('category', 'features', 'images', 'attachments');
        return view('backEnd.admin.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        $categories = Category::where('status', 'active')->get();
        $features = Feature::where('status', 'active')->get();
        $property->load('features');
        return view('backEnd.admin.properties.edit', compact('property', 'categories', 'features'));
    }

    public function update(Request $request, Property $property)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state_county' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'attachments.*' => 'file|mimes:pdf,doc,docx|max:5120'
        ]);

        $propertyData = $request->except(['images', 'attachments', 'features', 'is_default']);
        $propertyData['is_featured'] = $request->has('is_featured');

        // Convert Google Maps link to embed
        // if ($request->filled('location')) {
        //     $propertyData['location'] = $this->convertToEmbedLink($request->location);
        // }

        $property->update($propertyData);
        $property->features()->sync($request->features ?? []);

        // Handle default image
        if ($request->has('is_default')) {
            PropertyImage::where('property_id', $property->id)->update(['is_default' => false]); // Set all value => 0
            PropertyImage::where('id', $request->is_default)->update(['is_default' => true]); // Select only value => 1
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $hasDefault = PropertyImage::where('property_id', $property->id)->where('is_default', true)->exists();

            foreach ($request->file('images') as $key => $img) {
                if ($path = ImageHelper::uploadImage($img, 'uploads/properties')) {
                    PropertyImage::create([
                        'property_id' => $property->id,
                        'image_path' => $path,
                        'is_default' => !$hasDefault && $key === 0,
                    ]);
                }
            }
        }

        // Handle attachments deletion
        if ($request->has('delete_attachments')) {
            $attachmentsToDelete = PropertyAttachment::whereIn('id', $request->delete_attachments)->get();
            foreach ($attachmentsToDelete as $attachment) {
                if (File::exists(public_path($attachment->file_path))) {
                    File::delete(public_path($attachment->file_path));
                }
                $attachment->delete();
            }
        }

        // Handle new attachments upload
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $key => $attachment) {
                // Upload the file using your helper
                $filePath = ImageHelper::uploadImage($attachment, 'uploads/properties/attachments');

                if ($filePath) {
                    PropertyAttachment::create([
                        'property_id' => $property->id,
                        'name' => $request->input('attachment_name')[$key] ?? $attachment->getClientOriginalName(),
                        'file_path' => $filePath,
                    ]);
                }
            }
        }


        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        foreach ($property->images as $image) {
            $this->deleteFile($image->image_path);
            $image->delete();
        }

        foreach ($property->attachments as $attachment) {
            $this->deleteFile($attachment->file_path);
            $attachment->delete();
        }

        $property->features()->detach();
        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }

    public function deleteImage(PropertyImage $image)
    {
        if ($this->deleteFile($image->image_path)) {
            $image->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to delete image']);
    }

    public function deleteAttachment(PropertyAttachment $attachment)
    {
        if ($this->deleteFile($attachment->file_path)) {
            $attachment->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to delete attachment']);
    }

    private function deleteFile($filePath)
    {
        $fullPath = public_path($filePath);
        if (file_exists($fullPath) && is_file($fullPath)) {
            unlink($fullPath);
            return true;
        }
        return false;
    }

    protected function convertToEmbedLink($link)
    {
        // If already an embed link, return as-is
        if (str_contains($link, '/embed/') || str_contains($link, 'output=embed')) {
            return $link;
        }

        // Handle standard Google Maps URLs
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+),(\d+z)/', $link, $matches)) {
            // Coordinates format: https://www.google.com/maps/@latitude,longitude,zoomz
            return "https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d{zoom}!2d{$matches[2]}!3d{$matches[1]}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1234567890!5m2!1sen!2sus";
        }

        // Handle place URLs: https://www.google.com/maps/place/Place+Name
        if (preg_match('/maps\/place\/([^\/]+)/', $link, $matches)) {
            $place = urlencode(urldecode($matches[1])); // Decode then encode to handle special characters
            return "https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q={$place}";
        }

        // Handle search queries: https://www.google.com/maps/search/Query
        if (preg_match('/maps\/search\/([^\/]+)/', $link, $matches)) {
            $query = urlencode(urldecode($matches[1]));
            return "https://www.google.com/maps/embed/v1/search?key=YOUR_API_KEY&q={$query}";
        }

        // Handle directions URLs
        if (preg_match('/maps\/dir\/([^\/]+)\/([^\/]+)/', $link, $matches)) {
            $origin = urlencode(urldecode($matches[1]));
            $destination = urlencode(urldecode($matches[2]));
            return "https://www.google.com/maps/embed/v1/directions?key=YOUR_API_KEY&origin={$origin}&destination={$destination}";
        }

        // Fallback: use the search-based embed (your original approach)
        return "https://www.google.com/maps?q=" . urlencode($link) . "&output=embed";
    }
}
