<?php

namespace App\Http\Controllers;

use App\Models\Apparel;
use App\Models\ApparelCategory;
use App\Models\ApparelStyle;
use App\Models\ApparelType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApparelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $userData = User::find($userId);
        $apparels = Apparel::where('user_id', $userId)->get();

        return view('apparels.index', compact('apparels')); //the var query from db
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apparelTypes = ApparelType::all();
        $apparelStyles = ApparelStyle::all();
        $apparelCategories = ApparelCategory::all();
        return view('apparels.create', compact('apparelTypes', 'apparelStyles','apparelCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Get the user ID of the currently logged-in user
    $userId = Auth::id();

    // Create a new apparel item using the request data and user ID
    $created_apparel = Apparel::create([
        'title' => $request->input('title'),
        'color' => $request->input('color'),
        'quantity' => $request->input('quantity'),
        'price' => $request->input('price'),
        'date' => $request->input('date'),
        'remarks' => $request->input('remarks'),
        'attachment' => $request->input('attachment'),
        'apparel_category_id' => $request->input('apparel_category_id'),
        'apparel_type_id' => $request->input('apparel_type_id'),
        'apparel_style_id' => $request->input('apparel_style_id'),
        'user_id' => $userId, // Include the logged-in user's ID
    ]);

    // Store the transaction
    // If attachment is present, store it in the public folder
    if ($request->hasFile('attachment')) {
        $attachment = $request->file('attachment');
        $attachmentName = time() . '.' . $attachment->getClientOriginalExtension();
        $attachment->move(public_path('storage'), $attachmentName);
        $validatedData['attachment'] = $attachmentName;
    }

    // Redirect to the apparels list with a success message
    return redirect()->route('apparels.index')->with('success', 'Save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Apparel $apparel)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Apparel $apparel)
    {
        $apparelTypes = ApparelType::all();
        $apparelStyles = ApparelStyle::all();
        $apparelCategories = ApparelCategory::all();
        return view('apparels.edit', compact('apparel', 'apparelTypes', 'apparelStyles','apparelCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Apparel $apparel)
    {
        $apparel->update($request->all());

        return redirect()->route('apparels.index')->with('success', 'Apparel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Apparel $apparel)
    {
        $apparel->delete();

        return redirect()->route('apparels.index')->with('success', 'Apparel deleted.');
    }
}
