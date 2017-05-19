<?php

namespace App\Http\Controllers;

use App\CafeBranch;
use App\Menu;
use App\Package;
use App\Transaction;
use App\TransactionDetail;
use Carbon\Carbon;
use Charts;
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
            ->whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())
            ->where('status', '!=', 0)
            ->latest()
            ->whereMonth('created_at', DB::raw('MONTH(NOW())'))
            ->get();
        return view('report.report', compact('transactions'));
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
            ->whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())
            ->get();
        return response()->json(['transactions' => $transactions]);
    }

    public function reportDetail($transactionId)
    {
        $transaction = Transaction::find($transactionId)
            ->whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())->get();
        $details = TransactionDetail::where('transaction_id', $transactionId)->get();
        return view('report.reportDetail', compact('transaction', 'details'));
    }

    public function revenueDetail($transactionId)
    {
        $transaction = Transaction::find($transactionId)
            ->whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())->get();
        $details = TransactionDetail::where('transaction_id', $transactionId)->get();
        return view('report.revenueDetail', compact('transaction', 'details'));
    }

    /**
     * Revenue Report for Manager
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function revenue()
    {
        $transactions = Transaction::whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())->get();
        return view('report.revenue', compact('transactions'));
    }

    public function revenue_filter($startDate, $endDate, $paymentType)
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
            ->whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())
            ->get();
        return response()->json(['transactions' => $transactions]);
    }
    /**
     * Show Chart
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chart()
    {
        // Favorite Products
        $favProducts = TransactionDetail::getFavouriteProducts(1);
        foreach ($favProducts as $key => $value){
            $code_item = substr($value->item_id, 0,3);
            if($code_item === "MCF"){
                $menu = Menu::find($value->item_id);
                $favProducts[$key]->name = $menu->name;
                $favProducts[$key]->type = 'Menu';
            }
            if($code_item === "PKG"){
                $package = Package::find($value->item_id);
                $favProducts[$key]->name = $package->name;
                $favProducts[$key]->type = 'Paket';
            }
        }
        // Customers per 30 day
        $customers30day = Charts::database(Transaction::whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())->get(), 'area', 'chartjs')
            ->title("30 Hari")
            ->dimensions(275, 300)
            ->elementLabel('Jumlah Pengunjung')
            ->colors(['#F18803', '#F18803', '#8C4728'])
            ->template("material")
            ->dateColumn('created_at')
            ->groupByDay()
            ->lastByDay(30, false);
        // Menus per 30 Day
        $menus30day = Charts::database(TransactionDetail::getMenusOrderedPer30Days(), 'line', 'chartjs')
            ->title("30 Hari")
            ->dimensions(275, 300)
            ->elementLabel('Jumlah Menu di Pesan')
            ->colors(['#F18803', '#F18803', '#8C4728'])
            ->template("material")
            ->dateColumn('created_at')
            ->groupByDay()
            ->lastByDay(30, false);
        // Revenue per 3 Month
        $revenue = Charts::database(Transaction::whereIn('branch_id', CafeBranch::getBranchIdsByUserNowLoggedIn())->get(), 'area', 'chartjs')
            ->title("3 Bulan")
            ->dimensions(275, 300)
            ->elementLabel('Pendapatan')
            ->colors(['#F18803', '#F18803', '#8C4728'])
            ->template("material")
            ->aggregateColumn('total_payment', 'sum')
            ->lastByMonth(3, false);
        // TODO 5 Favorite Food
        // TODO 5 Favorite Drink
        return view('report.chart', compact('favProducts', 'customers30day', 'menus30day', 'revenue'));
    }
}
