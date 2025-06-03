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
            'packed_by' => 'required|string|max:255',
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
            'packed_by' => $validated['packed_by'],
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
    public function bundleForm($id)
    {
        $stock = DB::table('finished_stocks')->where('id', $id)->first();
        return view('stock-bundle-form', compact('stock'));
    }

    public function bundleStore(Request $request, $id)
    {
        $validated = $request->validate([
            'bundle_date' => 'required|date',
            'sheets_per_bundle' => 'required|integer|min:1',
            'bundle_count' => 'required|integer|min:1',
        ]);
        $stock = DB::table('finished_stocks')->where('id', $id)->first();
        if (!$stock) {
            return redirect()->route('stock')->with('error', 'Stock not found!');
        }
        $totalSheets = $validated['sheets_per_bundle'] * $validated['bundle_count'];
        if ($totalSheets > $stock->bundle) {
            return back()->withErrors(['bundle_count' => 'Not enough finished quantity.']);
        }
        // Subtract from finished stock
        DB::table('finished_stocks')->where('id', $id)->update([
            'bundle' => $stock->bundle - $totalSheets
        ]);
        // Insert into bundle_history so it appears in the chart
        DB::table('bundle_history')->insert([
            'stock_id' => $id,
            'date' => $validated['bundle_date'],
            'sheets_per_bundle' => $validated['sheets_per_bundle'],
            'bundle_count' => $validated['bundle_count'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        // Store bundle info (could be a new table, for now just pass to view)
        $bundleInfo = [
            'date' => $validated['bundle_date'],
            'sheets_per_bundle' => $validated['sheets_per_bundle'],
            'bundle_count' => $validated['bundle_count'],
            'stock' => $stock
        ];
        return view('stock-bundle-info', $bundleInfo);
        $stock = DB::table('finished_stocks')->where('id', $id)->first();
        if ($stock->bundle <= 0) {
            $stock->delete();
        }
         else {
            $stock->save();
         }
    }
    public function bundleChart()
    {
        // Fetch all bundle records and join with finished_stocks and orders
        $bundles = DB::table('bundle_history')
            ->leftJoin('finished_stocks', 'bundle_history.stock_id', '=', 'finished_stocks.id')
            ->leftJoin('orders', 'finished_stocks.lot', '=', 'orders.lot')
            ->select(
                'bundle_history.*',
                'finished_stocks.party_name as stock_party_name',
                'finished_stocks.lot as stock_lot',
                'orders.cutsheet as stock_cutsheet',
                'finished_stocks.khana as stock_peice',
                'finished_stocks.b_width as stock_widht',
                'finished_stocks.b_length as stock_jalilenght',
                'finished_stocks.packed_by as packed_by',
            )
            ->orderBy('bundle_history.date')
            ->get();
        return view('stock-bundle-chart', compact('bundles'));
    }
    public function bundleDelete($id)
    {
        \DB::table('bundle_history')->where('id', $id)->delete();
        return redirect()->route('stock.bundle.chart')->with('success', 'Bundle deleted successfully!');
    }
    public function bundleBilla($id, $type)
    {
        $bundle = \DB::table('bundle_history')->where('id', $id)->first();
        $stock = \DB::table('finished_stocks')->where('id', $bundle->stock_id)->first();
        $order = \DB::table('orders')->where('lot', $stock->lot)->first();
        // Pass all data and bundle id to the view, but do not display unless needed in the view
        $data = [
            'bundle' => $bundle,
            'stock' => $stock,
            'order' => $order,
            'bundle_id' => $id
        ];
        if ($type === 'A') {
            return view('bundle-billa-a', $data);
        } elseif ($type === 'B') {
            return view('bundle-billa-b', $data);
        } else {
            return view('bundle-billa-c', $data);
        }
    }
}
