<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
         $transactions = Transaction::where('user_id', $userId)->orderBy('date', 'desc')->get();
     
         return view('transactions.index', compact('transactions'));
     }

    // public function ()
    // {
    //     $transactions = Transaction::all();
    //     return view('transactions.index', compact('transactions')); //the var query from db
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $transactionCategories = TransactionCategory::all();
        return view('transactions.create', compact('transactionCategories'));
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
        'transaction_category_id' => 'required|integer',
        'title' => 'required|string|max:255',
        'amount' => 'required|numeric',
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
    $created_transaction = Transaction::create($validatedData);

    return redirect()->route('transactions.index')->with('success', 'Transaction saved successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $transactionCategories = TransactionCategory::all();
        $value = 'Expense';
        return view('transactions.edit', compact('transaction', 'transactionCategories', 'value'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted.');
    }
}
