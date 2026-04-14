<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of all properties.
     */
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', ['properties' => $properties]);
    }

    /**
     * Get properties as JSON for API.
     */
    public function getPropertiesJson()
    {
        return response()->json(Property::all());
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:255',
            'price_per_visit' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|max:5120', // optional image, max 5MB
        ]);

        // If the user uploaded an image, store it on the public disk
        // The stored path (e.g. "properties/abcd.jpg") will be saved to the DB.
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('properties', 'public');
            $validated['image'] = $path;
        }

        // Create and persist the property
        $property = Property::create($validated);

        // Redirect back to the listings with a friendly success message
        return redirect()->route('properties.index')->with('success', 'Property created successfully!');
    }

    /**
     * Display the specified property with its visits.
     */
    /**
     * Display the specified property.
     *
     * Returns JSON when requested (API), otherwise renders the `properties.show` view.
     */
    public function show(Request $request, Property $property)
    {
        // Load visits and the visiting user for display
        $property->load('visits.user');

        if ($request->wantsJson()) {
            return response()->json($property);
        }
    
        return view('properties.show', ['property' => $property]);
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'sometimes|required|string|max:255',
            'price_per_visit' => 'sometimes|required|numeric|min:0.01',
        ]);

        $property->update($validated);

        return response()->json($property);
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json(['message' => 'Property deleted successfully']);
    }
}
