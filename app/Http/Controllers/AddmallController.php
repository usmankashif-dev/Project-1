<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mall;
use App\Models\Dropdown;
use App\Models\Party; 
use App\Models\Order;
use Illuminate\Support\Facades\Log;

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
    // Add validation for all required fields
    $validated = $request->validate([
        'orderedqty' => 'required|numeric|min:1',
        'olenght' => 'required|numeric|min:1',
        'ogauge' => 'required',
        'peice' => 'required',
        'bundlewidht' => 'required',
        'sheetperbundle' => 'required|numeric|min:1',
        'jalilenght' => 'required',
        'mall_id' => 'required|exists:malls,id',
        'dateno' => 'required|date',
    ]);

    $mall_id = $request->mall_id;
    $mall = Mall::find($mall_id);

    if (!$mall) {
        return redirect()->back()->with('error', 'Mall not found!');
    }

    $widht = $mall->input3 ?? 0;
    $lenght = $mall->input2 ?? 0;

    // Check if enough stock is available
    if ($mall->availableqty < $request->orderedqty) {
        return redirect()->back()->with('Not Enough Stock Available');
    }

    // Place the order
    $cutsheetqty = 0;
    if ($lenght != 0) {
        $cutsheetqty = ($request->olenght / $lenght) * $request->orderedqty;
    }
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
        'orgsheet' => $mall->input2 . '-' . $mall->input3 . '-' . $mall->input1,
        'cutsheet' => $request->olenght . '-' . $mall->input3 . '-' . $mall->input1,
        'bundlewidht' => $request->bundlewidht,
        'sheetperbundle' => $request->sheetperbundle,
        'partyorder' => $mall->party,
        'cutsheetqty' => $cutsheetqty,
        'jalilenght' => $request->jalilenght,
    ]);
    Log::info('Order created', ['order_id' => $order->id]);

    // If ordered length is less than mall's length, create a new mall with the remaining length and ordered quantity
    if ($request->olenght < $mall->input2) {
        $remainingLength = $mall->input2 - $request->olenght;

        // Duplicate the mall with the remaining length and ordered quantity
        $newMall = $mall->replicate();
        $newMall->input2 = $remainingLength;
        $newMall->availableqty = $request->orderedqty;
        $newMall->save();

        // The original mall keeps its length, but availableqty is reduced by orderedqty
        $mall->availableqty -= $request->orderedqty;

        // Delete the new mall if its quantity is zero
        if ($newMall->availableqty == 0) {
            $newMall->delete();
        }
    } else {
        // If no split, just reduce availableqty as usual
        $mall->availableqty -= $request->orderedqty;
    }

    // Delete the original mall if its quantity is zero
    if ($mall->availableqty == 0) {
        $mall->delete();
    } else {
        $mall->save();
    }
    return redirect()->route('order-view')->with('success', 'Order placed successfully!');
}

 public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->back()->with('message', 'Order deleted successfully.');
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
