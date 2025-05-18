<form method="POST" action="{{ route('orders.send') }}">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <input type="text" name="date" placeholder="Date">
    <input type="text" name="peice" placeholder="Peice">
    <input type="text" name="machine" placeholder="Machine">
    <button type="submit">Send</button>
</form>
<form method="GET" action="{{ route('orders.sent') }}">
    <input type="text" name="search" placeholder="Search by machine...">
    <button type="submit">Search</button>
</form>

<table>
@foreach($data as $item)
    <tr>
        <td>{{ $item->date }}</td>
        <td>{{ $item->material }}</td>
        <td>{{ $item->height }}</td>
        <td>{{ $item->peice }}</td>
        <td>{{ $item->machine }}</td>
        <td>{{ $item->length }}</td>
        <td>{{ $item->width }}</td>
    </tr>
@endforeach
</table>
