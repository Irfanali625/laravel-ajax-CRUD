<table class="table table-responsive table-bordered" id="Table_ID">
    <thead>
        <tr>
            <th scope="col">S.no</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col" width="120px">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
            $count = 0;
        @endphp
        @foreach ($products as $key => $data)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $data->name }}</td>
                <td>{{ $data->price }}</td>
                <td>
                    <a href="" class="btn btn-success update_product_form" data-bs-toggle="modal"
                        data-bs-target="#updateModal" data-id="{{ $data->id }}" data-name="{{ $data->name }}"
                        data-price="{{ $data->price }}"><i class="las la-edit"></i></a>
                    <a href="" class="btn btn-danger delete_product" data-id="{{ $data->id }}">
                        <i class="las la-times"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center">

    {{ $products->links() }}
</div>
