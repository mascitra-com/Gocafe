<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\Menu;
use App\Package;
use App\Rating;
use App\Transaction;
use App\TransactionDetail;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Support\Facades\Auth;

/**
 * Class DashboardController untuk Halaman Dashboard
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
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
        $verified = Cafe::findOrFail(Cafe::getCafeIdByUserIdNowLoggedIn())->owner->user->email_verified_at;
        return view('dashboard.dashboard', compact('favProducts', 'customers30day', 'menus30day', 'revenue', 'verified'));
    }
}
