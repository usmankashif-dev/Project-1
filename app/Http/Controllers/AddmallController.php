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
        'input6' => 'required|string',
        'input7' => 'required|string',  
    ]);

 
    Mall::create([
        'party' => $request->party,
        'input1' => $request->input1,
        'input2' => $request->input2,
        'input3' => $request->input3,
        'input4' => $request->input4,
        'input5' => $request->input5,
        'input6' => $request->input6,
        'input7' => $request->input7,
    ]);

    return redirect()->route('mall-view')->with('message', 'Form submitted successfully!');
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
            'input6' => 'required|string',
            'input7' => 'required|string',

        ]);
        
        $mall = Mall::findOrFail($id);
        $mall->update($validated);

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
        'quantity' => $request->quantity,
        'rem' => $request->rem,
        'machine' => $request->machine,
        'peice' => $request->peice,
        'lenght' => $lenght,
        'widht' => $widht,
        'gauge' => $mall->input1,
        'mall_id' => $request->mall_id,
        'dateno' => $request->dateno,
    ]);

    return redirect()->back();
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
