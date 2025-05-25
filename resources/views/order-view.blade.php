<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif
        @if(session('message'))
            <div class="mb-4 text-green-600">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-4">
                <ul class="text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="mb-4 text-red-600">
                {{ session('error') }}
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-6 text-gray-800">Orders</h1>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Party</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lot</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orignal Sheet</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuted Sheet</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peice</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orders Gauge</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Widht</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jali Lenght</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sheets Per Bundle</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sheets</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cuted Sheets Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rem</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->dateno }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->partyorder }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->lot }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->orgsheet }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->cutsheet }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->peice }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->ogauge }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->widht }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->jalilenght }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->sheetperbundle }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->orderedqty }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->cutsheetqty }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->rem
                                 }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700"><form action="{{ route('order.delete', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-4 text-center text-gray-500">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
