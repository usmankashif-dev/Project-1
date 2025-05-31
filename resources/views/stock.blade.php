<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-2xl font-bold mb-6 text-gray-800 ">Finished Stock</h1>
        <button id="stockSearchToggleBtn" class="search-toggle-btn bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4" data-target="stockSearchForm">Search</button>
        <form method="GET" action="{{ route('stock') }}" class="space-y-4 mb-6 hidden" id="stockSearchForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="party_name" class="block text-sm font-medium text-gray-700">Party Name</label>
                    <input type="text" name="party_name" id="party_name" value="{{ request('party_name') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="piece" class="block text-sm font-medium text-gray-700">Piece</label>
                    <input type="text" name="piece" id="piece" value="{{ request('piece') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="b_width" class="block text-sm font-medium text-gray-700">Bundle Width</label>
                    <input type="text" name="b_width" id="b_width" value="{{ request('b_width') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="b_length" class="block text-sm font-medium text-gray-700">Bundle Length</label>
                    <input type="text" name="b_length" id="b_length" value="{{ request('b_length') }}" class="border rounded px-2 py-1 w-full" />
                </div>
                <div>
                    <label for="lot" class="block text-sm font-medium text-gray-700">Lot</label>
                    <input type="text" name="lot" id="lot" value="{{ request('lot') }}" class="border rounded px-2 py-1 w-full" />
                </div>
            </div>
            <div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            </div>
        </form>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Date</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Party Name</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Piece</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Bundle Width</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Bundle Length</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Sheets/Bundle</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Sheet Size</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Lot</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Bundle</th>
                        <th class="px-4 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($stocks as $stock)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->date }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->party_name }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->khana}}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->b_width }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->b_length }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->sheets_per_bundle }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->sheet_size }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->lot }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $stock->bundle }}</td>
                            <td class="px-4 py-2 text-md black-gray-700 border-2 border-black">
                                <form action="{{ route('stock.delete', $stock->id) }}" method="POST" class="inline-block m-2" onsubmit="return confirm('Are you sure you want to delete this stock entry?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                                </form>
                                <a href="{{ route('stock.edit', $stock->id) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-3 py-1 rounded ml-2">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-4 text-center text-gray-500">No finished stock found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
<script src="{{ asset('build/assets/stock-search-toggle.js') }}"></script>
</x-app-layout>
