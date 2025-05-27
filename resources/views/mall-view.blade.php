<header>
    <link rel="stylesheet" href="{{ asset('build/assets/view-mall.css') }}">
</header>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight p-4">
            {{ __('Stocks') }}
        </h2>
    </x-slot>
<form action="{{ route('addmall.submit') }}" method="POST" class="fw mx-auto p-6 bg-white shadow-lg rounded-md animate-fade-in space-y-6 hidden">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="party" class="block text-sm font-medium text-gray-700">Select Party:</label>
            <select name="party" id="party" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">--Select Party--</option>
                <option value="Amjad">Amjad</option>
                <option value="Usman">Usman</option>
                <option value="add_new">+ Add New Party</option>
            </select>
        </div>
        <div id="add-party-div" class="mt-4 hidden md:col-span-2">
            <input type="text" id="new-party-name" placeholder="Enter new party" class="w-full sm:w-40 h-8 p-2 border border-gray-300 rounded-md">
            <button type="button" onclick="addParty()" class="mt-2 w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">Add</button>
        </div>
        <div>
            <label for="input1" class="block text-sm font-medium text-gray-700">Gauge of sheet:</label>
            <input type="number" step="0.01" name="input1" id="input1" value="" min="0" required placeholder="1.123" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="input2" class="block text-sm font-medium text-gray-700">Length of sheet:</label>
            <input type="number" step="0.01" name="input2" id="input2" value="" min="0" required placeholder="1.123" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="input3" class="block text-sm font-medium text-gray-700">Width of sheet:</label>
            <input type="number" step="0.01" name="input3" id="input3" value="" min="0" required placeholder="1.123" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="input4" class="block text-sm font-medium text-gray-700">Material of sheet:</label>
            <input type="text" name="input4" id="input4" value="{{ old('input4') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="input5" class="block text-sm font-medium text-gray-700">Date:</label>
            <input type="date" name="input5" id="input5" value="{{ old('input5') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div>
            <label for="lot" class="block text-sm font-medium text-gray-700 mb-1">Lot:</label>
            <input type="text" name="lot" id="lot" readonly class="w-full mt-2 px-4 py-2 border border-blue-400 rounded-lg bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm text-blue-900 font-semibold tracking-wide">
        </div>
        <div>
            <label for="input7" class="block text-sm font-medium text-gray-700">Quantity:</label>
            <input type="text" name="input7" id="input7" value="{{ old('input7') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="md:col-span-2">
            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Add New Stock</button>
        </div>
    </div>
</form>
<script>
    window.storePartyUrl = '{{ route("store.party") }}';
    window.csrfToken = '{{ csrf_token() }}';
</script>
    <div class="w-full p-4">
        <form action="{{ route('mall-view') }}" method="GET" class="p-4 bg-white shadow rounded-md mb-4 flex flex-wrap gap-4 items-center">
            <input type="text" name="party" placeholder="Party" value="{{ request('party') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="input1" placeholder="Gauge" value="{{ request('input1') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="input2" placeholder="Length" value="{{ request('input2') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="input3" placeholder="Width" value="{{ request('input3') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="input4" placeholder="Material" value="{{ request('input4') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="input5" placeholder="Date" value="{{ request('input5') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="number" name="input7" placeholder="Quantity" value="{{ request('input7') }}" class="w-full sm:w-40 h-10 p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <input type="text" name="lot" placeholder="Lot" value="{{ request('lot') }}" class="w-full sm:w-40 h-10 p-2 border border-blue-400 rounded-lg bg-gray-50 text-blue-900 font-semibold tracking-wide">
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-bold shadow">Search</button>      
        </form>
        <div class="flex center">  <button id="showaddmall" class="w-full sm:w-auto px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition font-bold shadow">Add New Stock+</button></div>
      
        
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border border-gray-300 shadow-md rounded-lg animate-fade-in">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left chart">Date</th>
                        <th class="px-4 py-2 text-left chart">Party</th>
                        <th class="px-4 py-2 text-left chart">Widht</th>
                        <th class="px-4 py-2 text-left chart">Lenght</th>
                        <th class="px-4 py-2 text-left chart">Gauge</th>
                        <th class="px-4 py-2 text-left chart">Lot</th>
                        <th class="px-4 py-2 text-left chart">Material</th>
                        <th class="px-4 py-2 text-left chart">Quantity</th>
                        <th class="px-4 py-2 text-left chart textr">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($malls as $mall)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 chart">{{ $mall->input5 }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->party }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->input3 }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->input2 }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->input1 }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->lot }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->input4 }}</td>
                            <td class="px-4 py-2 chart">{{ $mall->availableqty }}</td>
                            <td class="px-4 py-2 chart">
                                <div class="flex flex-col sm:flex-row justify-center items-center gap-2">
                                    <form action="{{ route('mall.delete', $mall->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">Delete</button>
                                    </form>
                                    <a href="{{ route('mall.edit', $mall->id) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md transition textr">Edit</a>
                                    <a href="{{ route('order.create', $mall->id) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md transition textr">C Order</a>
<form action="{{ route('order.make', $mall->id) }}" method="POST">
    @csrf
    <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md transition textr">M Order</button>
</form>


                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('build/assets/script.js') }}"></script>
<script>
function updateLot() {
    const length = document.getElementById('input2').value;
    const date = document.getElementById('input5').value;
    const gauge = document.getElementById('input1').value;
    const qty = document.getElementById('input7').value;
    document.getElementById('lot').value = `${length}-${date}-${gauge}-${qty}`;
}
['input2','input1','input5','input7'].forEach(id => {
    document.getElementById(id).addEventListener('input', updateLot);
});
</script>
