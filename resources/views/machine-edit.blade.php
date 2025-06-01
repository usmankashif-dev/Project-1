<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Machine Entry</h1>
        <form method="POST" action="{{ route('machine.update', $machine->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="machinedate" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="machinedate" id="machinedate" value="{{ old('machinedate', $machine->machinedate) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="machinenumber" class="block text-sm font-medium text-gray-700">Machine No</label>
                <input type="number" name="machinenumber" id="machinenumber" value="{{ old('machinenumber', $machine->machinenumber) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="machineqty" class="block text-sm font-medium text-gray-700">Quantity</label>
                <select name="machineqty" id="machineqty" class="border rounded px-2 py-1 w-full" required>
                    <option value="">Select Quantity</option>
                    @php $maxQty = $order ? $order->rem + $machine->machineqty : $machine->machineqty; @endphp
                    @for ($i = 1; $i <= $maxQty; $i++)
                        <option value="{{ $i }}" {{ old('machineqty', $machine->machineqty) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <div class="text-xs text-gray-500 mt-1">Available to send: {{ $order ? $order->rem + $machine->machineqty : $machine->machineqty }}</div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            <a href="{{ route('machine-view') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </form>
        @if($order)
            <div class="mt-6 text-sm text-gray-700">
                <strong>Order Rem:</strong> {{ $order->rem }}<br>
                <strong>Order Party:</strong> {{ $order->partyorder }}
            </div>
        @endif
    </div>
</x-app-layout>
