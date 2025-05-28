<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Machine Orders</h1>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Machine No</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Length</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piece</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gauge</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cut Sheet</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lot</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bundle Width</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sheets/Bundle</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Party Order</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jali Length</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ordered Pieces</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($machines as $machine)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->id }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->machinedate }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->machinenumber }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->machineqty }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->olenght }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->peice }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->ogauge }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->cutsheet }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->lot }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->bundlewidht }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->sheetperbundle }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->partyorder }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->jalilenght }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $machine->orderedpeices }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <form action="{{ route('machine.delete', $machine->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this machine entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="15" class="px-4 py-4 text-center text-gray-500">No machine orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
