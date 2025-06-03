<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Verified Bundles</h1>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 border-b">#</th>
                        <th class="px-4 py-2 border-b">Party</th>
                        <th class="px-4 py-2 border-b">Lot</th>
                        <th class="px-4 py-2 border-b">Cuted Sheet</th>
                        <th class="px-4 py-2 border-b">Peice</th>
                        <th class="px-4 py-2 border-b">Widht</th>
                        <th class="px-4 py-2 border-b">Jali Lenght</th>
                        <th class="px-4 py-2 border-b">Bundle Date</th>
                        <th class="px-4 py-2 border-b">Sheets/Bundle</th>
                        <th class="px-4 py-2 border-b">Bundle Count</th>
                        <th class="px-4 py-2 border-b">Packed By</th>
                        <th class="px-4 py-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bundles as $bundle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border-b">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->party_name ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->lot ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->cutsheet ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->peice ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->widht ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->jalilenght ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->date }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->sheets_per_bundle }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->bundle_count }}</td>
                            <td class="px-4 py-2 border-b">{{ $bundle->packed_by ?? '-' }}</td>
                            <td class="px-4 py-2 border-b">
                                <form action="{{ route('verified.bundle.delete', $bundle->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this verified bundle?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-6 text-gray-500">No verified bundles found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
