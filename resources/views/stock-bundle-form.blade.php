<x-app-layout>
    <div class="max-w-lg mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Bundle Finished Stock</h1>
        <form method="POST" action="{{ route('stock.bundle.store', $stock->id) }}" id="bundleForm">
            @csrf
            <div class="mb-4">
                <label for="bundle_date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="bundle_date" id="bundle_date" value="{{ old('bundle_date', date('Y-m-d')) }}" class="border rounded px-2 py-1 w-full" required />
            </div>
            <div class="mb-4">
                <label for="sheets_per_bundle" class="block text-sm font-medium text-gray-700">Sheets per Bundle</label>
                <input type="number" name="sheets_per_bundle" id="sheets_per_bundle" value="{{ old('sheets_per_bundle') }}" class="border rounded px-2 py-1 w-full" min="1" max="{{ $stock->bundle }}" required />
            </div>
            <div class="mb-4">
                <label for="bundle_count" class="block text-sm font-medium text-gray-700">Bundle</label>
                <select name="bundle_count" id="bundle_count" class="border rounded px-2 py-1 w-full" required>
                    <option value="">Select Bundle</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Submit</button>
        </form>
    </div>
    <script>
        const sheetsInput = document.getElementById('sheets_per_bundle');
        const bundleSelect = document.getElementById('bundle_count');
        const maxSheets = {{ $stock->bundle }};
        function updateBundleOptions() {
            const sheets = parseInt(sheetsInput.value) || 1;
            const maxBundles = Math.floor(maxSheets / sheets);
            bundleSelect.innerHTML = '<option value="">Select Bundle</option>';
            for (let i = 1; i <= maxBundles; i++) {
                bundleSelect.innerHTML += `<option value="${i}">${i}</option>`;
            }
        }
        sheetsInput.addEventListener('input', updateBundleOptions);
        document.addEventListener('DOMContentLoaded', updateBundleOptions);
    </script>
</x-app-layout>
