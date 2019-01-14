<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use App\Package;
use App\Staff;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role == 'owner') {
            exit('Halaman Tidak Tersedia');
        } else {
            $cafeId = Staff::getCafeIdByStaffIdNowLoggedIn();
            $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        }
        // Get List of Category and All Menus from first Category
        $categories = CategoryMenu::all()->where('cafe_id', $cafeId)->sortBy('name');
        $menus = Cafe::findOrFail($cafeId)->menus->where('category_id', $categories->first()->id);
        $thumbnail = Menu::getThumbnail($menus->first()->id);
        $thumbnail = str_replace('storage/product/', 'img/cache/medium-product/', $thumbnail[0]);
        $menus->first()->thumbnail = $thumbnail;
        $firstMenu = $menus->first();
        foreach ($menus as $key => $value) {
            $thumbnail = Menu::getThumbnail($value->id);
            $thumbnail = str_replace('storage/product/', 'img/cache/small-product/', $thumbnail[0]);
            $menus[$key]->thumbnail = $thumbnail;
        }
        $packages = Package::where('cafe_id', Cafe::getCafeIdByUserIdNowLoggedIn())->with('menus')->get();

        $numberOfTables = CafeBranch::getNumberOfTablesByStaffNowLoggedIn();
        $table = $this->makeTableLayout($numberOfTables);
        return view('transaction.order', compact('categories', 'menus', 'firstMenu', 'numberOfTables', 'reviews', 'packages', 'table'));
    }

    /**
     * Get Table that contains table
     *
     * @param $totalCell - Sum of Table
     *
     * @return string
     */
    private function makeTableLayout($totalCell)
    {
        $tableNotAvailable = Transaction::getTableNotAvailable(CafeBranch::getBranchIdsByUserNowLoggedIn())->toArray();
        $t = 0;
        $tableNotAvailable = array_column($tableNotAvailable, 'table_number');
        $res = '<table width="100" border="1" class="table table-bordered"><tr>';
        for ($i = 1; $i <= $totalCell; $i++) {
            if (isset($tableNotAvailable[$t]) && in_array($i, $tableNotAvailable)) {
                $td = '<td height="100" align="center" class="danger"><a href="#" onclick="alert(\'Meja telah terisi. Silahkan Pilih Meja Lain.\')" class="table-number"><h2>'.$i.'</h2></a>';
                $t++;
            } else {
                $td = '<td height="100" align="center" class="success"><a href="#" onclick="javascript:getMenusByTableNumber('.$i.')" class="table-number"><h2>'.$i.'</h2></a>';
            }
            if ($i % 8 == 0) {
                $res .= $td . '</td></tr><tr>';
            } else {
                $res .= $td . '</td>';
            }
        }
        return $res . '</table>';
    }
}
