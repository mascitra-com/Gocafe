<?php

namespace App\Http\Controllers;

use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    /**
     * Transaction Report for Manager
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::with('branch')
            ->where('status', '!=', 0)
            ->latest()
            ->whereMonth('created_at', DB::raw('MONTH(NOW())'))
            ->get();
        return view('transaction.report', compact('transactions'));
    }

    public function report_filter($startDate, $endDate, $paymentType)
    {
        if($paymentType === '-') {
            $paymentType = FALSE;
        }
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);
        $transactions = Transaction::whereBetween('created_at', [$startDate->format('Y-m-d')." 00:00:00", $endDate->format('Y-m-d')." 23:59:59"])
            ->when($paymentType, function ($query) use ($paymentType) {
                return $query->where('status', $paymentType);
            })
            ->where('status', '!=', 0)
            ->get();
        return response()->json(['transactions' => $transactions]);
    }

    /**
     * Revenue Report for Manager
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function revenue()
    {
        $transactions = Transaction::all();
        return view('transaction.revenue', compact('transactions'));
    }
}
