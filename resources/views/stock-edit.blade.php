<x-app-layout>
    <div class="max-w-xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Edit Finished Stock</h1>
        <form method="POST" action="{{ route('stock.update', $stock->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" value="{{ old('date', $stock->date) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="party_name" class="block text-sm font-medium text-gray-700">Party Name</label>
                <input type="text" name="party_name" id="party_name" value="{{ old('party_name', $stock->party_name) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="khana" class="block text-sm font-medium text-gray-700">Piece</label>
                <input type="text" name="khana" id="khana" value="{{ old('khana', $stock->khana) }}" class="border rounded px-2 py-1 w-full" />
            </div>
            <div class="mb-4">
                <label for="b_width" class="block text-sm font-medium text-gray-700">B Width</label>
                <input type="text" name="b_width" id="b_width" value="{{ old('b_width', $stock->b_width) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="b_length" class="block text-sm font-medium text-gray-700">B Length</label>
                <input type="text" name="b_length" id="b_length" value="{{ old('b_length', $stock->b_length) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="sheets_per_bundle" class="block text-sm font-medium text-gray-700">Sheets/Bundle</label>
                <input type="text" name="sheets_per_bundle" id="sheets_per_bundle" value="{{ old('sheets_per_bundle', $stock->sheets_per_bundle) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="sheet_size" class="block text-sm font-medium text-gray-700">Sheet Size</label>
                <input type="text" name="sheet_size" id="sheet_size" value="{{ old('sheet_size', $stock->sheet_size) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="lot" class="block text-sm font-medium text-gray-700">Lot</label>
                <input type="text" name="lot" id="lot" value="{{ old('lot', $stock->lot) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="bundle" class="block text-sm font-medium text-gray-700">Bundle</label>
                <select name="bundle" id="bundle" class="border rounded px-2 py-1 w-full" required>
                    <option value="">Select Bundle</option>
                    @for ($i = 1; $i <= $stock->bundle; $i++)
                        <option value="{{ $i }}" {{ old('bundle', $stock->bundle) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <div class="text-xs text-gray-500 mt-1">Available: {{ $stock->bundle }}</div>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update</button>
            <a href="{{ route('stock') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
        </form>
    </div>
</x-app-layout>
