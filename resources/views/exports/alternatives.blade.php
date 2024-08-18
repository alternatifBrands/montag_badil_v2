<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Url</th>
        <th>Image</th>
        <th>Category</th>
        <th>Brands</th>
        <th>Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($raws as $raw)
        @php
            $brands = '';
            foreach($raw->brands as $brand){
                $brands .= $brand->name.', ';
            }
        @endphp
        <tr>
            <td>{{ $raw->id }}</td>
            <td>{{ $raw->name }}</td>
            <td>{{ $raw->url }}</td>
            <td>{{ 'brand_alternative_image/' . $raw->image }}</td>
            <td>{{ $raw->category->name ?? '' }}</td>
            <td>{{ $brands  }}</td>
            <td>{{ $raw->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>