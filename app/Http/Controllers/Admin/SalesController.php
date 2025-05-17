<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        //月別売上（集計用）
        $monthlySales = OrderITem::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(price * quantity) as total')
            ->groupBy('month')->orderBy('month','desc')->get();

        //商品別売上
        $productSales = OrderItem::select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(price * quantity) as total_price'))
            ->groupBy('product_id')->with('product')->orderBy('total_price','desc')->get();

        return view('admin.sales.index', compact('monthlySales','productSales'));
    }
}
