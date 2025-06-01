<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 leading-tight p-4">
            {{ __('Edit Mall') }}
        </h2>
    </x-slot>

    <form action="{{ route('mall.update', $mall->id) }}" method="POST" class="max-w-2xl mx-auto p-4 bg-white shadow rounded-md animate-fade-in">
        @csrf

        <label for="party" class="block mt-2">Party:</label>
        <input type="text" name="party" id="party" value="{{ $mall->party }}" required class="w-full p-2 border rounded">

        <label for="input1" class="block mt-2">Gauge:</label>
        <input type="number" step="0.01" name="input1" id="input1" value="{{ $mall->input1 }}" required class="w-full p-2 border rounded">

        <label for="input2" class="block mt-2">Length:</label>
        <input type="number" step="0.01" name="input2" id="input2" value="{{ $mall->input2 }}" required class="w-full p-2 border rounded">

        <label for="input3" class="block mt-2">Width:</label>
        <input type="number" step="0.01" name="input3" id="input3" value="{{ $mall->input3 }}" required class="w-full p-2 border rounded">

        <label for="input4">Material of sheet:</label>
        <input type="text" name="input4" id="input4" value="{{ old('input4') }}" class="w-full p-2 border rounded">

        <label for="input5">Date:</label>
        <input type="date" name="input5" id="input5" value="{{ old('input5') }}" class="w-full p-2 border rounded">

        <div class="mb-4">
            <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
            <select name="availableqty" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" required>
                <option value="">Select Quantity</option>
                @php $maxQty = isset($mall) ? $mall->availableqty : 100; @endphp
                @for ($i = 1; $i <= $maxQty; $i++)
                    <option value="{{ $i }}" {{ (isset($mall) && $mall->availableqty == $i) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
            <div class="text-xs text-gray-500 mt-1">Available: {{ $maxQty }}</div>
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Update Mall
        </button>
    </form>
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

</x-app-layout>
