<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mall;
use App\Models\Dropdown;
use App\Models\Party; 
use App\Models\Order;

class AddmallController extends Controller
{
    public function showAddMallForm()
    {
        $party = Party::all(); 
        return view('Add-mall', compact('party'));
    }
    


public function addmallform(Request $request)
{
    $validated = $request->validate([
        'party' => 'required|string',
        'input1' => 'required|numeric|min:0',
        'input2' => 'required|numeric|min:0',
        'input3' => 'required|numeric|min:0',
        'input4' => 'required|string',
        'input5' => 'required|string',  
        'input7' => 'required|string',  
    ]);

    $lot = $request->input5 . $request->input1 . $request->input2;

    Mall::create([
        'party' => $request->party,
        'input1' => $request->input1,
        'input2' => $request->input2,
        'input3' => $request->input3,
        'input4' => $request->input4,
        'input5' => $request->input5,
        'input7' => $request->input7,
        'availableqty' => $request->input7, 
        'lot'    => $lot,

    ]);

    return redirect()->route('mall-view');
}


    public function deleteMall($id)
    {
        $mall = Mall::findOrFail($id);
        $mall->delete();
        return redirect()->back()->with('message', 'Mall deleted successfully.');
    }

    public function editMall($id)
    {
        $mall = Mall::findOrFail($id);
        return view('edit-mall', compact('mall'));
    }

    public function updateMall(Request $request, $id)
    {
        $validated = $request->validate([
            'party' => 'required|string',
            'input1' => 'required|numeric|min:0',
            'input2' => 'required|numeric|min:0',
            'input3' => 'required|numeric|min:0',
            'input4' => 'required|string',
            'input5' => 'required|string',
            'input7' => 'required|string',

        ]);
        
        $mall = Mall::findOrFail($id);
        $mall->update($validated);
$mall->availableqty = $request->input7;
$mall->save();

        return redirect()->route('mall-view');
    }

    public function showAddMallForm1()
    {
        $party = DB::table('parties')->get(); 
        return view('Add-mall', compact('party'));
    }
    

    public function storeparty(Request $request)
    {
        $request->validate(['party_name' => 'required|unique:dropdowns,name']);
        $party = Dropdown::create(['name' => $request->party_name]);
        return response()->json(['id' => $party->id, 'name' => $party->name]);
    }
   
 public function newordersv($id)
    {
        $mall = Mall::findOrFail($id);
        return view('new-order', compact('mall'));
    }

public function store(Request $request)
{
    $mall_id = $request->mall_id;

    $mall = Mall::find($request->mall_id);

 if (!$mall) {
   return redirect()->back()->with('error', 'Mall not found!');
}

$widht = $mall->input3 ?? 0;
$lenght = $mall->input2 ?? 0;


     $order = Order::create([
       'orderedqty' => $request->orderedqty,
        'olenght' => $request->olenght,
        'ogauge' => $request->ogauge,
        'peice' => $request->peice,
        'lenght' => $lenght,
        'widht' => $widht,
        'gauge' => $mall->input1,
        'mall_id' => $request->mall_id,
        'dateno' => $request->dateno,
        'lot' => $mall->lot,
        'rem' => $mall->availableqty,
    ]);
     if ($mall->availableqty < $request->orderedqty) {
   return redirect()->back()->with('Not Enough Stock Available');
}

$mall->availableqty -= $request->orderedqty;
    $mall->save();
    return redirect()->back();
}
 public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('message', 'Mall deleted successfully.');
    }

public function newOrder()
{
    return view('new-order');
}

public function showOrders()
{
    $orders = Order::with('mall')->latest()->get(); 
    return view('order-view', compact('orders'));
}

}
