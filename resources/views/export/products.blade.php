<table>
    <thead>
    <tr>
        <th>KOD</th>
        <th>category</th>
        <th>name</th>
        <th>brand</th>
        <th>cost_price</th>
        <th>price_wholesale</th>
        <th>price_max</th>
        <th>price_min</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>#{{ $product->product_id }}</td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->brand }}</td>
            <td>{{ $product->cost_price }}</td>
            <td>{{ $product->price_wholesale }}</td>
            <td>{{ $product->price_max }}</td>
            <td>{{ $product->price_min }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
