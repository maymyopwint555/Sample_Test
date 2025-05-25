@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
       <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5>Product Lists</h5>
                </div>
                <div class="col-md-8 d-flex justify-content-end align-items-center">
                    <form action="{{ route('products.index') }}" class="d-flex me-2">
                        <select id="filterCategory" class="form-control me-2">
                            <option value="all">All Category</option>
                            @foreach ($categories as $category)
                                <option {{ request('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}" id="{{ $category->id }}">{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <select id="filterBrand" class="form-control me-2">
                            <option value="all">All Brand</option>
                            @foreach ($brands as $brand)
                                <option {{ request('brand_id') == $brand->id ? 'selected' : '' }}
                                    value="{{ $brand->id }}" id="{{ $brand->id }}">{{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        <input 
                            class="form-control me-2" 
                            name="search" 
                            type="search" 
                            placeholder="Search" 
                            aria-label="Search" 
                            value="{{ request('search') }}"
                        >
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <a href="{{ route('products.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-1"></i> {{ trans('global.add') }}
                    </a>
                </div>
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
                    <th>{{ trans('cruds.product.fields.category') }}</th>
                    <th>{{ trans('cruds.product.fields.brand') }}</th>
                    <th>{{ trans('cruds.product.fields.description') }}</th>
                    <th>Image</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$firstItem++}}</td>
                            <td>{{$product->name ?? ''}}</td>
                            <td>{{$product->code ?? ''}}</td>
                            <td>{{$product->qty ?? ''}}</td>
                            <td>{{$product->price ?? ''}}</td>
                            <td>{{$product->category?->name ?? ''}}</td>
                            <td>{{$product->brand?->name ?? ''}}</td>
                            <td>{{$product->description ?? ''}}</td>
                            <td><img src="{{ asset($product->getFirstMediaUrl('photo')) }}" width="50px" height="50px" /></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
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
    $(document).ready(function() {
        $('#filterCategory').on('change', function() {
            let value = $(this).val();
            let url = {!! json_encode(route('products.index')) !!};
           if (value === 'all') {
                location.href = url; 
            } else {
                location.href = `${url}?category_id=${value}`;
            }
        });
        $('#filterBrand').on('change', function() {
            let value = $(this).val();
            let url = {!! json_encode(route('products.index')) !!};
           if (value === 'all') {
                location.href = url; 
            } else {
                location.href = `${url}?brand_id=${value}`;
            }
        });
    })
</script>
@endsection