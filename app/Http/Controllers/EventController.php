<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
     {
         // Access the logged-in user's ID
         $userId = Auth::id(); // This gives you the user's ID
         
         // Use the $userId in your function logic
         // Example: Retrieve user-related data
         $userData = User::find($userId);
         $events = Event::where('user_id', $userId)->orderBy('date', 'desc')->get();
     
         return view('events.index', compact('events'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Fetch the authenticated user's ID
    $userId = Auth::id();

    // Validate the request data
    $validatedData = $request->validate([
        'type' => 'required|string',
        'title' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'date' => 'required|date',
        'remarks' => 'nullable|string',
        'attachment' => 'nullable|file|mimes:jpg,jpeg,png',
    ]);

    // Store the transaction
    // If attachment is present, store it in the public folder
    if ($request->hasFile('attachment')) {
        $attachment = $request->file('attachment');
        $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
        $attachment->move(public_path('storage'), $attachmentName);
        $validatedData['attachment'] = $attachmentName;
    }

    // Add the user_id to the validated data
    $validatedData['user_id'] = $userId;
    // Create the transaction with the validated data, including user_id
    $created_event = Event::create($validatedData);

    return redirect()->route('events.index')->with('success', 'Event saved successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $value = 'Indoor';
        return view('events.edit', compact('event', 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }
}
