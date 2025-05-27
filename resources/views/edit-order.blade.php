<x-app-layout>
  
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-xl shadow mt-10">
        <form action="{{ route('order.update', $order->id) }}" method="POST">
            <div class="flex justify-center">
                <H1 class="text-xl">Edit Order</H1>
            </div>
            
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Gauge</label>
                <input type="text" name="ogauge" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="ogauge" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Piece</label>
                <input type="text" name="peice" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="peice" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Lenght:</label>
                <input type="number" name="olenght" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="olenght" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Quantity</label>
                <input type="number" name="orderedqty" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="orderedqty" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Date:</label>
                <input type="date" name="dateno" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="dateno" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Widht:</label>
                <input type="number" name="bundlewidht" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="bundlewidht" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Sheets Per Bundle:</label>
                <input type="number" name="sheetperbundle" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="sheetperbundle" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Jali Lenght:</label>
                <input type="number" name="jalilenght" class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-400" id="jalilenght" required>
            </div>

            <input type="hidden" name="mall_id" value="{{ $order->id }}">



            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
