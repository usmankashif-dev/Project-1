<head>
    <link rel="stylesheet" href="{{ asset('build/assets/order.css') }}">
   
</head>
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
        
        <form method="GET" action="{{ route('orders.index') }}" class="space-y-4 hidden" id="orderSearchForm">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="from_date" class="block text-sm font-medium text-gray-700">From Date</label>
                    <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="to_date" class="block text-sm font-medium text-gray-700">To Date</label>
                    <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="partyorder" class="block text-sm font-medium text-gray-700">Party</label>
                    <input type="text" name="partyorder" id="partyorder" value="{{ request('partyorder') }}" placeholder="Party" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="lot" class="block text-sm font-medium text-gray-700">Lot</label>
                    <input type="text" name="lot" id="lot" value="{{ request('lot') }}" placeholder="Lot" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="orgsheet" class="block text-sm font-medium text-gray-700">Original Sheet</label>
                    <input type="text" name="orgsheet" id="orgsheet" value="{{ request('orgsheet') }}" placeholder="Original Sheet" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="cutsheet" class="block text-sm font-medium text-gray-700">Cut Sheet</label>
                    <input type="text" name="cutsheet" id="cutsheet" value="{{ request('cutsheet') }}" placeholder="Cut Sheet" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="peice" class="block text-sm font-medium text-gray-700">Piece</label>
                    <input type="text" name="peice" id="peice" value="{{ request('peice') }}" placeholder="Piece" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="ogauge" class="block text-sm font-medium text-gray-700">Orders Gauge</label>
                    <input type="text" name="ogauge" id="ogauge" value="{{ request('ogauge') }}" placeholder="Orders Gauge" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="widht" class="block text-sm font-medium text-gray-700">Width</label>
                    <input type="text" name="widht" id="widht" value="{{ request('widht') }}" placeholder="Width" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="jalilenght" class="block text-sm font-medium text-gray-700">Jali Length</label>
                    <input type="text" name="jalilenght" id="jalilenght" value="{{ request('jalilenght') }}" placeholder="Jali Length" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="sheetperbundle" class="block text-sm font-medium text-gray-700">Sheets Per Bundle</label>
                    <input type="text" name="sheetperbundle" id="sheetperbundle" value="{{ request('sheetperbundle') }}" placeholder="Sheets Per Bundle" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="orderedqty" class="block text-sm font-medium text-gray-700">Ordered Quantity</label>
                    <input type="text" name="orderedqty" id="orderedqty" value="{{ request('orderedqty') }}" placeholder="Ordered Quantity" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="cutsheetqty" class="block text-sm font-medium text-gray-700">Cut Sheet Quantity</label>
                    <input type="text" name="cutsheetqty" id="cutsheetqty" value="{{ request('cutsheetqty') }}" placeholder="Cut Sheet Quantity" class="border rounded px-2 py-1 w-full" />
                </div>

                <div>
                    <label for="rem" class="block text-sm font-medium text-gray-700">Rem</label>
                    <input type="text" name="rem" id="rem" value="{{ request('rem') }}" placeholder="Rem" class="border rounded px-2 py-1 w-full" />
                </div>
            </div>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Filter</button>
            </div>
        </form>
<button id="orderSearchToggleBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Search</button>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Date</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-nlack-500 uppercase tracking-wider border-2 border-black">Party</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Lot</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Orignal Sheet</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Cuted Sheet</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Peice</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Orders Gauge</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Widht</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Jali Lenght</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Sheets Per Bundle</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Sheets</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Cuted Sheets Quantity</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Rem</th>
                        <th class="p-2 py-2 text-left text-md font-medium text-black-500 uppercase tracking-wider border-2 border-black">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->dateno }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->partyorder }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->lot }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->orgsheet }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->cutsheet }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->peice }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->ogauge }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->widht }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->jalilenght }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->sheetperbundle }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->orderedqty }}</td>
                            <td class="px-4 py-2 text-md-end text-black-700 border-2 border-black">{{ $order->cutsheetqty }}</td>
                            <td class="px-4 py-2 text-md text-black-700 border-2 border-black">{{ $order->rem
                                 }}</td>
                            <td class="px-4 py-2 text-sm text-black-700 border-2 border-black"><form action="{{ route('order.delete', $order->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition">Delete</button>
                                    </form>
                                    <div class="h-12">
                                        <a href="{{ route('order.toMachine', $order->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition">To M</a>
                                    </div>
                            <div>
                                <a href="{{ route('order.edit', $order->id) }}" class="bg-cyan-500 hover:bg-cyan-600 text-white px-4 py-2 rounded-md transition">Edit</a> 
                            </div>
                           
                            </td>
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
    <script src="{{ asset('build/assets/order.js') }}">
    </script>  
</x-app-layout>
