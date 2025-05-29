<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Machine;
use App\Models\Order;

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
}
