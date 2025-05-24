<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Orders</h1>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lot</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rem</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peice</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lenght</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Widht</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gauge</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Gauge</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Lenght</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->lot }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->orderedqty }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->peice }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->rem }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->lenght }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->widht }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->gauge }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->ogauge }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->olenght }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $order->dateno }}</td>
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
