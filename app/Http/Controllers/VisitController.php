<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitController extends Controller
{
    /**
     * Display the calendar view with visits.
     */
    public function calendar()
    {
        $properties = Property::all();
        return view('calendar', ['properties' => $properties]);
    }

    /**
     * Get all visits for the authenticated user.
     */
    public function getUserVisits()
    {
        $visits = Visit::where('user_id', Auth::id())
            ->with('property')
            ->orderBy('start_time')
            ->get();

        return response()->json($visits);
    }

    /**
     * Get all visits for a property (for calendar display).
     */
    public function getPropertyVisits(Property $property)
    {
        $visits = $property->visits()
            ->where('status', '!=', 'cancelled')
            ->with('user:id,name')
            ->get();

        return response()->json($visits);
    }

    /**
     * Create a new visit reservation.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $visit = Visit::create($validated);

        return response()->json($visit, 201);
    }

    /**
     * Update a visit (only allowed for pending visits).
     */
    public function update(Request $request, Visit $visit)
    {
        // Check ownership
        if ($visit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent updating confirmed visits
        if ($visit->isConfirmed()) {
            return response()->json(['error' => 'Cannot update confirmed visits'], 403);
        }

        $validated = $request->validate([
            'start_time' => 'sometimes|required|date|after:now',
            'end_time' => 'sometimes|required|date|after:start_time',
        ]);

        $visit->update($validated);

        return response()->json($visit);
    }

    /**
     * Delete a visit (only pending visits).
     */
    public function destroy(Visit $visit)
    {
        // Check ownership
        if ($visit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent deleting confirmed visits
        if ($visit->isConfirmed()) {
            return response()->json(['error' => 'Cannot delete confirmed visits'], 403);
        }

        $visit->delete();

        return response()->json(['message' => 'Visit cancelled successfully']);
    }

    /**
     * Get a single visit details.
     */
    public function show(Visit $visit)
    {
        if ($visit->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return response()->json($visit->load('property'));
    }

    /**
     * Get all events for the calendar in FullCalendar format.
     */
    public function getEvents()
    {
        $visits = Visit::where('user_id', Auth::id())
            ->with('property')
            ->orderBy('start_time')
            ->get();

        $events = $visits->map(function ($visit) {
            return [
                'id' => $visit->id,
                'title' => $visit->property->title ?? 'Visit',
                'start' => $visit->start_time,
                'end' => $visit->end_time,
                'extendedProps' => [
                    'owner' => $visit->user_id,
                    'property' => $visit->property,
                    'status' => $visit->status,
                ],
            ];
        });

        return response()->json(['events' => $events]);
    }
}
