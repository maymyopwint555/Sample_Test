@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
       <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5>Stock Lists</h5>
                </div>
                <div class="col-md-8"></div>
            </div>
        </div>        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>{{ trans('cruds.product.fields.no') }}</th>
                    <th>{{ trans('cruds.product.fields.name') }}</th>
                    <th>{{ trans('cruds.product.fields.code') }}</th>
                    <th>{{ trans('cruds.product.fields.qty') }}</th>
                    <th>{{ trans('cruds.product.fields.price') }}</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$firstItem++}}</td>
                            <td>{{$product->name ?? ''}}</td>
                            <td>{{$product->code ?? ''}}</td>
                            <td>{{$product->qty ?? ''}}</td>
                            <td class="text-end">{{$product->price ?? ''}}</td>
                            <td class="text-end">{{ number_format($product->qty * $product->price, 2) }}</td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary btn-plus" data-bs-toggle="modal" data-bs-target="#qtyModal" type="button"
                                data-id="{{ $product->id }}" data-qty="{{ $product->qty }}">
                                    <i class='bx bx-plus'></i> Qty
                                </button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
                <div class="modal fade" id="qtyModal" tabindex="-1" aria-labelledby="qtyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('products.qty.update')}}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="qtyModalLabel">Add Quantity</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="product_id" id="product_id">
                                    <input type="hidden" name="" id="current_qty">
                                    <div class="form-group">
                                        <label for="qty" class="col-form-label">Quantity</label>
                                        <input name="qty" type="number" class="form-control" id="qty" value="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-sm btn-outline-primary" name="savebtn" value="add">Add</button>
                                    <button type="submit" class="btn btn-sm btn-outline-warning btn-subtract" name="savebtn" value="subtract">Subtract</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </table>
            <div class="mt-4">
                {{ $products->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).on('click', '.btn-plus', function() {
        let id = $(this).data('id');
        let qty = $(this).data('qty');
        console.log(qty);
        $('#product_id').val(id);
        $('#current_qty').val(qty);
    });

    $(document).on('click', '.btn-subtract', function(e) {
        let qty = $('#qty').val();
        let currentQty = $('#current_qty').val();

        console.log('qty',qty);
        console.log('currentQty',currentQty);

        if (parseInt(qty) > parseInt(currentQty)) {
            e.preventDefault(); 
            alert("Quantity to subtract cannot be greater than current stock!");
            $("#qty").val('');
        }
    });
</script>
@endsection