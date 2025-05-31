<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    public function create($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('machine-form', compact('order'));
    }

    public function store(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $validated = $request->validate([
            'machinedate' => 'required|date',
            'machinenumber' => 'required|integer',
            'machineqty' => 'required|integer',
        ]);
        $machine = new Machine();
        $machine->machinedate = $validated['machinedate'];
        $machine->machinenumber = $validated['machinenumber'];
        $machine->machineqty = $validated['machineqty'];
        $machine->olenght = $order->olenght;
        $machine->peice = $order->peice;
        $machine->ogauge = $order->ogauge;
        $machine->cutsheet = $order->cutsheet;
        $machine->lot = $order->lot;
        $machine->bundlewidht = $order->bundlewidht;
        $machine->sheetperbundle = $order->sheetperbundle;
        $machine->partyorder = $order->partyorder;
        $machine->jalilenght = $order->jalilenght;
        $machine->orderedpeices = $order->orderedpeices;
        $machine->save();

        // Decrease rem in order by machineqty
        $order->rem = max(0, $order->rem - $machine->machineqty);
        $order->save();

        // Delete order if rem hits 0
        if ($order->rem == 0) {
            $order->delete();
        }

        return redirect()->route('machine-view')->with('success', 'Sent to machine successfully!');
    }

    public function index()
    {
        $machines = Machine::all();
        return view('machine-view', compact('machines'));
    }
    public function destroy($id)
    {
        $machine = Machine::findOrFail($id);
         $machine->delete();
        return redirect()->back()->with('message', 'Order deleted successfully.');
    }
    public function edit($id)
    {
        $machine = Machine::findOrFail($id);
        $order = Order::where('partyorder', $machine->partyorder)->first();
        return view('machine-edit', compact('machine', 'order'));
    }

    public function update(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);
        $order = Order::where('partyorder', $machine->partyorder)->first();
        $validated = $request->validate([
            'machinedate' => 'required|date',
            'machinenumber' => 'required|integer',
            'machineqty' => 'required|integer',
        ]);
        $oldQty = $machine->machineqty;
        $newQty = $validated['machineqty'];
        $diff = $newQty - $oldQty;
        $machine->machinedate = $validated['machinedate'];
        $machine->machinenumber = $validated['machinenumber'];
        $machine->machineqty = $newQty;
        $machine->save();
        if ($order) {
            $order->rem = max(0, $order->rem - $diff);
            $order->save();
            if ($order->rem == 0) {
                $order->delete();
            }
        }
        return redirect()->route('machine-view')->with('success', 'Machine updated successfully!');
    }

    public function finishForm($id)
    {
        $machine = Machine::findOrFail($id);
        return view('machine-finish', compact('machine'));
    }

    public function finish(Request $request, $id)
    {
        $machine = Machine::findOrFail($id);
        $validated = $request->validate([
            'finish_date' => 'required|date',
            'finish_qty' => 'required|integer|min:1',
        ]);
        $finishQty = $validated['finish_qty'];
        if ($finishQty > $machine->machineqty) {
            return back()->withErrors(['finish_qty' => 'Finish quantity cannot exceed machine quantity.']);
        }
        // Save finished stock info
        DB::table('finished_stocks')->insert([
            'machine_id' => $machine->id,
            'date' => $validated['finish_date'],
            'party_name' => $machine->partyorder,
            'khana' => $machine->peice,
            'b_width' => $machine->bundlewidht,
            'b_length' => $machine->olenght,
            'sheets_per_bundle' => $machine->sheetperbundle,
            'sheet_size' => $machine->cutsheet,
            'lot' => $machine->lot,
            'bundle' => $finishQty,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Subtract from machine
        $machine->machineqty -= $finishQty;
        if ($machine->machineqty <= 0) {
            $machine->delete();
        } else {
            $machine->save();
        }
        return redirect()->route('stock')->with('success', 'Stock finished and saved!');
    }

    public function stock(Request $request)
    {
        $query = \DB::table('finished_stocks');
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }
        if ($request->filled('party_name')) {
            $query->where('party_name', 'like', '%' . $request->party_name . '%');
        }
        if ($request->filled('piece')) {
            $query->where('piece', 'like', '%' . $request->piece . '%');
        }
        if ($request->filled('b_width')) {
            $query->where('b_width', 'like', '%' . $request->b_width . '%');
        }
        if ($request->filled('b_length')) {
            $query->where('b_length', 'like', '%' . $request->b_length . '%');
        }
        if ($request->filled('lot')) {
            $query->where('lot', 'like', '%' . $request->lot . '%');
        }
        $stocks = $query->orderByDesc('date')->get();
        return view('stock', compact('stocks'));
    }
    public function stockDelete($id)
    {
        \DB::table('finished_stocks')->where('id', $id)->delete();
        return redirect()->route('stock')->with('success', 'Stock entry deleted successfully!');
    }

    public function stockEdit($id)
    {
        $stock = \DB::table('finished_stocks')->where('id', $id)->first();
        return view('stock-edit', compact('stock'));
    }

    public function stockUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'party_name' => 'required|string',
            'piece' => 'nullable|string',
            'b_width' => 'required',
            'b_length' => 'required',
            'sheets_per_bundle' => 'required',
            'sheet_size' => 'required',
            'lot' => 'required',
            'bundle' => 'required',
        ]);
        \DB::table('finished_stocks')->where('id', $id)->update($validated);
        return redirect()->route('stock')->with('success', 'Stock entry updated successfully!');
    }
}
