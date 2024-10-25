<?php

namespace App\Http\Controllers;

use App\Models\Apparel;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();
        
        // Fetch user-specific data (e.g., transactions)
        $transactions = Transaction::where('user_id', $userId)->get();
        $apparels = Apparel::where('user_id', $userId)->get();
        // $events = Event::where('user_id', $userId)->get();
        // Get the latest 4 transactions ordered by date in descending order
        $recentTransactions = Transaction::orderBy('date', 'desc')
        ->take(7)
        ->get();

        $periodTransactions = Transaction::select(
                DB::raw('SUM(amount) as total_amount'),
                DB::raw('DATE_FORMAT(date, "%Y-%m") as month'),
                'type' // Assuming you have a category to differentiate between spending and saving
            )
            ->groupBy('month', 'type')
            ->where('date', '>=', now()->subYear()) // You can adjust this to 1 year, 6 months, or 3 months
            ->get();
    
            $spending = $periodTransactions->where('type', 'Expense')->values();
            $saving = $periodTransactions->where('type', 'Income')->values();            

        // Define the date range (today ± 2 days)
        $today = \Carbon\Carbon::today();
        $startDate = $today->copy()->subDays(2);
        $endDate = $today->copy()->addDays(2);

        // Fetch events within this date range
        $events = Event::whereBetween('date', [$startDate, $endDate])->orderBy('date')->get();

        
        // Pass the transactions to the dashboard view
        return view('dashboard', compact('transactions', 'apparels', 'recentTransactions', 'periodTransactions', 'spending', 'saving', 'events', 'today'));
    }
    
    
}
