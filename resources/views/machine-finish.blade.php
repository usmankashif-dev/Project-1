<x-app-layout>
    <div class="max-w-xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Finish Machine Stock</h1>
        <form method="POST" action="{{ route('machine.finish', $machine->id) }}">
            @csrf
            <div class="mb-4">
                <label for="finish_date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="finish_date" id="finish_date" value="{{ old('finish_date') }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="finish_qty" class="block text-sm font-medium text-gray-700">Quantity to Finish</label>
                <input type="number" name="finish_qty" id="finish_qty" value="{{ old('finish_qty') }}" class="border rounded px-2 py-1 w-full" min="1" max="{{ $machine->machineqty }}" required />
                <div class="text-xs text-gray-500 mt-1">Available: {{ $machine->machineqty }}</div>
            </div>
            <div class="mb-4">
                <label for="packed_by" class="block text-sm font-medium text-gray-700">Packed By</label>
                <input type="text" name="packed_by" id="packed_by" value="{{ old('packed_by') }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Finish</button>
            <a href="{{ route('machine-view') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </form>
    </div>
</x-app-layout>
