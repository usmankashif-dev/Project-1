<?php

namespace App\Http\Controllers;
use App\Models\Order;


use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function newOrder()
    {
        return view('new-order'); 
    }
     public function vieworder()
    {
        return view('order-view'); 
    }
    public function index(Request $request)
{
    $query = Order::query();

    if ($request->filled('from_date') && $request->filled('to_date')) {
        $query->whereBetween('dateno', [$request->from_date, $request->to_date]);
    } elseif ($request->filled('from_date')) {
        $query->where('dateno', '>=', $request->from_date);
    } elseif ($request->filled('to_date')) {
        $query->where('dateno', '<=', $request->to_date);
    }

    foreach (['partyorder', 'lot', 'orgsheet', 'cutsheet', 'peice', 'ogauge', 'widht', 'jalilenght', 'sheetperbundle', 'orderedqty', 'cutsheetqty', 'rem'] as $field) {
        if ($request->filled($field)) {
            $query->where($field, 'like', '%' . $request->$field . '%');
        }
    }

    $orders = $query->orderBy('dateno', 'desc')->get();

    return view('order-view', compact('orders'));
}

}
