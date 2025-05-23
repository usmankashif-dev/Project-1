<x-app-layout>
   <div class="mb-6 p-4 bg-gray-100 border-l-4 border-blue-500 rounded shadow">
    <h2 class="text-xl font-semibold text-blue-800 mb-2">Mall Information</h2>
    <p><strong>Party:</strong> {{ $mall->party }}</p>
    <p><strong>Gauge:</strong> {{ $mall->input1 }}</p>
    <p><strong>Length:</strong> {{ $mall->input2 }}</p>
    <p><strong>Width:</strong> {{ $mall->input3 }}</p>
    <p><strong>Lot:</strong> {{ $mall->lot }}</p>
</div>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <form action="{{ route('Addmall.store') }}" method="POST">
            <div class="flex justify-center">
                <H1 class="text-xl">Create New Order</H1>
            </div>
            
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Machine Name</label>
                <input type="text" name="machine" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="machine" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Piece</label>
                <input type="number" name="peice" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="peice" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Rem:</label>
                <input type="number" name="rem" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="rem" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
                <input type="number" name="quantity" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="quantity" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Date:</label>
                <input type="date" name="dateno" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="dateno" required>
            </div>

            <input type="hidden" name="mall_id" value="{{ $mall->id }}">



            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
