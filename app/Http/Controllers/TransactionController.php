<?php

namespace App\Http\Controllers;

use App\Cafe;
use App\CafeBranch;
use App\CategoryMenu;
use App\Menu;
use App\Owner;
use App\Package;
use App\Review;
use App\Staff;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;

class TransactionController extends Controller
{

    /**
     * DashboardController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param $tableNumber
     *
     * @return \Illuminate\Http\Response
     */
    public function getMenusByTableNumber($tableNumber)
    {
        // TODO Get BRANCH ID from Cafe BY STAFF ID Now Logged In
        if ($transactionId = Transaction::where(array(
            'table_number' => $tableNumber,
            'status' => 0
        ))->orderBy('created_at', 'desc')->first()) {
            $items = TransactionDetail::where('transaction_id', $transactionId->id)->get();

            return response()->json(['transactionId' => $transactionId, 'items' => $items]);
        } else {
            return response()->json(['transactionId' => false]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $itemId
     *
     * @return \Illuminate\Http\Response
     */
    public function getReviewsByItemId($itemId)
    {
        $reviews = Review::where('item_id', $itemId)->orderBy('id', 'desc')->get();

        return response()->json(['reviews' => $reviews]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Staff $staff
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Staff $staff)
    {
        // Get Items and calculate the total price
        $total_price = 0;
        $total_discount = 0;
        $production_cost = 0;
        $total_payment = 0;
        $allId = $request->ids_menu;
        $allAmount = $request->amount;
        $transactionId = idWithPrefix(10);
        $details = array();
        foreach ($allId as $key => $value) {
            $code_item = substr($value, 0, 3);
            if ($code_item === "MCF") {
                $menu = Menu::find($value);
                $details[$key]['id'] = idWithPrefix(11);
                $details[$key]['item_id'] = $menu->id;
                $details[$key]['amount'] = $allAmount[$key];
                $details[$key]['price'] = $menu->price;
                $details[$key]['discount'] = $menu->discount;
                $details[$key]['name'] = $menu->name;
                // Calculate All Total to store in Transaction Table
                $production_cost += $menu->cost * $allAmount[$key];
                $total_price += $price = $menu->price * $allAmount[$key];
                $total_discount += $discount = $menu->discount * $menu->price * $allAmount[$key];
                $total_payment += ($price - $discount);
            }
            if ($code_item === "PKG") {
                $package = Package::where('id', $value)->get();
                $details[$key]['id'] = idWithPrefix(11);
                $details[$key]['item_id'] = $package[0]->id;
                $details[$key]['amount'] = $allAmount[$key];
                $details[$key]['price'] = $package[0]->price;
                $details[$key]['name'] = $package[0]->name;
                // Calculate All Total to store in Transaction Table
                $production_cost += $package[0]->cost * $allAmount[$key];
                $total_price += $price = $package[0]->price * $allAmount[$key];
                $total_discount += $discount = $package[0]->price * $allAmount[$key];
                $total_payment += $price;
            }
        }
        // Add Data to Store to Transaction Table
        $data['id'] = $transactionId;
        $data['created_by'] = 2;
        $data['total_price'] = $total_price;
        $data['total_discount'] = $total_discount;
        $data['production_cost'] = $production_cost;
        $data['total_payment'] = $total_payment;
        if ($request->type) {
            $data['status'] = $request->type;
        }
        $request->request->add($data);

        $transaction = new Transaction($request->except(array('ids_menu', 'amount', 'cash_received', 'refund', 'type')));
        $staff->saveTransaction($transaction, Staff::getStaffIdNowLoggedIn());
        foreach ($details as $detail) {
            $transactionDetail = new TransactionDetail($detail);
            $staff->saveTransactionDetail($transactionDetail, $transactionId);
        }
        return back()->with('status', 'Transaction Inserted!');
    }

    public function printReceipt()
    {
        $data = session('transactions');
        $cafe = DB::table('cafes')->where('owner_id', Owner::getOwnerIdNowLoggedIn())->first();
        $response = true;
        /* Fill in your own connector here */
        try {
            $ip = 'localhost'; // IP Komputer kita atau printer lain yang masih satu jaringan
            $printer = 'EPSON TM-U220 Receipt'; // Nama Printer yang di sharing
            $connector = new WindowsPrintConnector("smb://" . $ip . "/" . $printer);
            $printer = new Printer($connector);
            /* Information for the receipt */
            $items = array();
            $subtotal = 0;
            $discount = 0;
            foreach ($data as $list) {
                array_push($items,
                    new item($list['name'] . "  " . $list['amount'], $list['amount'] * $list['price'] . $list['discount'] > 0 ? " -(" . $list['amount'] * $list['price'] * $list['discount'] . ")" : "", true)
                );
                $subtotal += $list['amount'] * $list['price'];
                $discount += $list['amount'] * $list['price'] * $list['discount'];
            }
            $total = $subtotal - $discount;
            $subtotal = new item('Subtotal', $subtotal);
            $discount = new item('Diskon', $discount);
            $total = new item('Total', $total, true);
            /* Date is kept the same for testing */
            $date = date('l jS \of F Y h:i:s A');
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            /* Name of shop */
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($cafe->name . "\n");
            $printer->selectPrintMode();
            $printer->text("Tempat Kuliner: " . $cafe->name . "\n");
            $printer->feed();
            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("Struk Pembayaran\n");
            $printer->setEmphasis(false);
            /* Items */
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->setEmphasis(true);
            $printer->text(new item('', 'Rp.'));
            $printer->setEmphasis(false);
            foreach ($items as $item) {
                $printer->text($item);
            }
            $printer->setEmphasis(true);
            $printer->text($subtotal);
            $printer->setEmphasis(false);
            $printer->feed();
            /* Tax and total */
            $printer->text($discount);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($total);
            $printer->selectPrintMode();
            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Terima Kasih\n");
            $printer->text("Kulinerae.com\n");
            $printer->feed(2);
            $printer->text($date . "\n");
            /* Cut the receipt and open the cash drawer */
            $printer->cut();
            $printer->pulse();
            $printer->close();
        } catch (Exception $e) {
            $response = ['success' => 'false'];
        }
        return response()
            ->json($response);
    }
}

class item
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this->name = $name;
        $this->price = $price;
        $this->dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 10;
        if ($this->dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols);

        $sign = ($this->dollarSign ? 'Rp. ' : '');
        $right = str_pad($sign . $this->price, $rightCols, ' ', STR_PAD_LEFT);

        return "$left$right\n";
    }
}
