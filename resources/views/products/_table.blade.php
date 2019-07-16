<!-- PARTIAL: products._table -->
<table class="table">
    <tr>
        <th>Product Name</th>
        <th>Qty in Stock</th>
        <th>Price per Item</th>
        <th>Date Entered</th>
        <th>Total Value</th>
    </tr>
    @foreach($products as $o) 
        <tr>
            <td>{{ $o->pname }} </td>
            <td>{{ $o->qty }} </td>
            <td>{{ $o->price }} </td>
            <td>{{ $o->timestamp }} </td>
            <td>{{ \App\Product::renderLineItemValue($o) }} </td>
        </tr>
    @endforeach
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ $total ?? 'N/A' }}</td>
        </tr>
</table>
