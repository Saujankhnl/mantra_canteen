<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $dateFilter = $request->input('date_filter', 'all');
        $yearFilter = $request->input('year_filter', 'all');
        $monthFilter = $request->input('month_filter', 'all');

        $query = Transaction::query();

        if ($dateFilter !== 'all') {
            $query->where('date', $dateFilter);
        }
        if ($yearFilter !== 'all') {
            $query->whereYear('date', $yearFilter);
        }
        if ($monthFilter !== 'all') {
            $query->whereMonth('date', $monthFilter);
        }

        $transactions = $query->get();
        $total = $transactions->sum('amount');

        $years = Transaction::selectRaw('YEAR(date) as year')
        ->distinct()
        ->pluck('year')
        ->sort()
        ->toArray();

        $months = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];
        $years = [2020, 2021, 2022, 2023, 2024]; // Example years array
        // Or get years from your database:
        // $years = Transaction::selectRaw('YEAR(date) as year')->distinct()->pluck('year');

        return view('nepali', compact('years'));
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ];

        // If you need localized month names (for Nepali), consider using Carbon
        // or a localization package instead of hardcoding

        return view('nepali', compact('months'));
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::create()->month($i)->monthName;
        }

        return view('nepali', compact('months'));
        $transactions = Transaction::query()
        ->when(request('year_filter'), function($query, $year) {
            $query->whereYear('date', $year);
        })
        ->when(request('month_filter'), function($query, $month) {
            $query->whereMonth('date', $month);
        })
        ->orderBy('date', 'desc')
        ->get();

        return view('nepali', compact('transactions'));
        $transactions = Transaction::query()
        ->when(request('year_filter'), fn($q, $year) => $q->whereYear('date', $year))
        ->when(request('month_filter'), fn($q, $month) => $q->whereMonth('date', $month))
        ->orderBy('date', 'desc')
        ->get();

        // Calculate the total amount
        $total = $transactions->sum('amount'); // Assuming you have an 'amount' column
        return view('transactions.index', compact('transactions', 'total', 'years', 'months'));
  
    }


    public function scan(Request $request)
    {
        $currentDate = Carbon::now()->toDateString(); // 2025-05-31
        $currentDay = Carbon::now()->format('l'); // Saturday
        $amount = 50.00; // Hardcoded for simulation

        Transaction::create([
            'date' => $currentDate,
            'day' => $currentDay,
            'amount' => $amount,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction recorded!');
    }
}
