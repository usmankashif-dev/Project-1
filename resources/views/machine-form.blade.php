<x-app-layout>
    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <h2 class="text-xl font-bold mb-4">Send Order To Machine</h2>
        <form action="{{ route('order.sendToMachine', $order->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Date</label>
                <input type="date" name="machinedate" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Machine No</label>
                <select name="machinenumber" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required>
                    <option value="">Select Machine No</option>
                    @for ($i = 1; $i <= 20; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
                <select name="machineqty" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required>
                    <option value="">Select Quantity</option>
                    @for ($i = 1; $i <= $order->rem; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <div class="text-xs text-gray-500 mt-1">Available to send: {{ $order->rem }}</div>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Send To Machine</button>
        </form>
    </div>
</x-app-layout>
