<head>
    
</head>

<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Machine Orders</h1>
        
        <form method="GET" action="{{ route('machine-view') }}" class="space-y-4 mb-6 hidden" id="machineSearchForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="machinedate" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="machinedate" id="machinedate" value="{{ request('machinedate') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="machinenumber" class="block text-sm font-medium text-gray-700">Machine No</label>
                    <input type="text" name="machinenumber" id="machinenumber" value="{{ request('machinenumber') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="machineqty" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="machineqty" id="machineqty" value="{{ request('machineqty') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="olenght" class="block text-sm font-medium text-gray-700">Length</label>
                    <input type="text" name="olenght" id="olenght" value="{{ request('olenght') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="peice" class="block text-sm font-medium text-gray-700">Piece</label>
                    <input type="text" name="peice" id="peice" value="{{ request('peice') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="ogauge" class="block text-sm font-medium text-gray-700">Gauge</label>
                    <input type="text" name="ogauge" id="ogauge" value="{{ request('ogauge') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="cutsheet" class="block text-sm font-medium text-gray-700">Cut Sheet</label>
                    <input type="text" name="cutsheet" id="cutsheet" value="{{ request('cutsheet') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="lot" class="block text-sm font-medium text-gray-700">Lot</label>
                    <input type="text" name="lot" id="lot" value="{{ request('lot') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="bundlewidht" class="block text-sm font-medium text-gray-700">Bundle Width</label>
                    <input type="text" name="bundlewidht" id="bundlewidht" value="{{ request('bundlewidht') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="sheetperbundle" class="block text-sm font-medium text-gray-700">Sheets/Bundle</label>
                    <input type="text" name="sheetperbundle" id="sheetperbundle" value="{{ request('sheetperbundle') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="partyorder" class="block text-sm font-medium text-gray-700">Party Order</label>
                    <input type="text" name="partyorder" id="partyorder" value="{{ request('partyorder') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="jalilenght" class="block text-sm font-medium text-gray-700">Jali Length</label>
                    <input type="text" name="jalilenght" id="jalilenght" value="{{ request('jalilenght') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="orderedpeices" class="block text-sm font-medium text-gray-700">Ordered Pieces</label>
                    <input type="text" name="orderedpeices" id="orderedpeices" value="{{ request('orderedpeices') }}" class="border rounded px-2 py-1 w-full" />
                </div>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            </div>
        </form>
        <button id="machineSearchToggleBtn" class="search-toggle-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Search</button>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Date</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Party</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Lot</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Cuted Sheet</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Piece</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Gauge</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Bundle Widht</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Lenght</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Jali Lenght</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black border-2 border-black">Sheet/Bundle</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Machine No</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Quantity</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-gray-500 uppercase tracking-wider border-2 border-black">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($machines as $machine)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->machinedate }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->partyorder }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->lot}}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->cutsheet }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->peice }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->ogauge }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->bundlewidht }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->olenght}}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->jalilenght }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->sheetperbundle}}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->machinenumber }}</td>
                            <td class="px-4 py-2 text-md text-gray-700 border-2 border-black">{{ $machine->machineqty}}</td>
                            <td class="px-4 py-2 text-sm text-gray-700 border-2 border-black">
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
    <script src="{{ asset('build/assets/machine.js') }}"></script>
</x-app-layout>
