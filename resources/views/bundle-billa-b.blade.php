<x-app-layout>
    <div class="max-w-lg mx-auto p-8 bg-white rounded shadow mt-10 print:p-0 print:shadow-none">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold mb-2">Billa B</h1>
            <div class="text-xl font-bold">{{ $stock->khana ?? '-' }}/{{ $order->olenght ?? '-' }}-{{ $order->ogauge ?? '-' }}-{{ $order->bundlewidht ?? '-' }}-{{ $order->lot ?? '-' }}F</div>
        </div>
        <div class="mb-4 text-lg font-bold">Cut Size: <span class="font-normal">{{ $order->cutsheet ?? '-' }}</span></div>
        <div class="mb-4 text-lg font-bold">Code: <span class="font-normal">{{ $order->lot ?? '-' }}</span></div>
        <div class="mb-6 border-2 border-black rounded p-4 flex flex-col items-center">
            <div class="text-lg font-bold">Total Sheets = Final Weight</div>
            <div class="flex gap-8 mt-2">
                <div class="text-2xl font-bold">{{ $bundle->sheets_per_bundle * $bundle->bundle_count }}</div>
                <div class="text-2xl font-bold">F</div>
            </div>
            <div class="flex gap-8 mt-2">
                <div class="text-lg font-bold">Sht</div>
                <div class="text-lg font-bold">F</div>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-lg font-bold">
            <div>Date:</div><div>{{ $bundle->date }}</div>
            <div>Initials:</div><div>__________</div>
            <div>Machine No:</div><div>{{ $stock->machine_id ?? '-' }}</div>
            <div>Picked By:</div><div>__________</div>
        </div>
        <div class="mt-8 text-center print:hidden">
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded font-bold">Print</button>
        </div>
    </div>
</x-app-layout>
