<x-app-layout>
    <div class="max-w-lg mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6">Bundle Info</h1>
        <div class="mb-4 p-4 bg-gray-100 rounded">
            <h2 class="font-semibold mb-2">Bundle Details</h2>
            <p><strong>Date:</strong> {{ $date }}</p>
            <p><strong>Sheets per Bundle:</strong> {{ $sheets_per_bundle }}</p>
            <p><strong>Bundles:</strong> {{ $bundle_count }}</p>
        </div>
        <div class="mb-4 p-4 bg-gray-50 rounded">
            <h2 class="font-semibold mb-2">Original Finished Product Info</h2>
            <p><strong>Party Name:</strong> {{ $stock->party_name }}</p>
            <p><strong>Piece:</strong> {{ $stock->khana }}</p>
            <p><strong>Bundle Width:</strong> {{ $stock->b_width }}</p>
            <p><strong>Bundle Length:</strong> {{ $stock->b_length }}</p>
            <p><strong>Sheets/Bundle (Original):</strong> {{ $stock->sheets_per_bundle }}</p>
            <p><strong>Sheet Size:</strong> {{ $stock->sheet_size }}</p>
            <p><strong>Lot:</strong> {{ $stock->lot }}</p>
            <p><strong>Finished Quantity (Before):</strong> {{ $stock->bundle }}</p>
        </div>
        <a href="{{ route('stock') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Back to Finished Stock</a>
    </div>
</x-app-layout>
