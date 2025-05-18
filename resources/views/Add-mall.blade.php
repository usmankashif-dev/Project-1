<header>
    <link rel="stylesheet" href="{{ asset('build/assets/addmall.css') }}">
</header>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight p-4">
            {{ __('Add New Order') }}
        </h2>
    </x-slot>

    <form action="{{ route('addmall.submit') }}" method="POST" class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-md animate-fade-in space-y-6">
        @csrf

      
        <div>
            <label for="party" class="block text-sm font-medium text-gray-700">Select Party:</label>
            <select name="party" id="party" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <option value="">--Select Party--</option>
                <option value="Amjad">Amjad</option>
                <option value="Usman">Usman</option>
                @foreach ($party as $party)
                    <option value="{{ $party->name }}">{{ $party->name }}</option>
                @endforeach
                <option value="add_new">+ Add New Party</option>
            </select>
        </div>

   
        <div id="add-party-div" class="mt-4 hidden">
            <input type="text" id="new-party-name" placeholder="Enter new party" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
            <input type="text" name="input5" id="input5" value="{{ old('input5') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

         <div>
            <label for="input6" class="block text-sm font-medium text-gray-700">Lot:</label>
            <input type="text" name="input6" id="input6" value="{{ old('input6') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

 <div>
            <label for="input7" class="block text-sm font-medium text-gray-700">Quantity:</label>
            <input type="text" name="input7" id="input7" value="{{ old('input7') }}" class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Add New Order</button>
        </div>
    </form>
</x-app-layout>

<script>
    window.storePartyUrl = '{{ route("store.party") }}';
    window.csrfToken = '{{ csrf_token() }}';
</script>

<script src="{{ asset('build/assets/script.js') }}"></script>
