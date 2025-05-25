@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3 shadow" style="max-width: 900px; width: 100%;">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.product.title_singular') }}
            </div>  
            <div class="card-body">
                <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.product.fields.id') }}</th>
                        <td>{{$product->id ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.name') }}</th>
                        <td>{{$product->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.code') }}</th>
                        <td>{{$product->code ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.qty') }}</th>
                        <td>{{$product->qty ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.price') }}</th>
                        <td>{{$product->price ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.category') }}</th>
                        <td>{{$product->category?->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.brand') }}</th>
                        <td>{{$product->brand?->name ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>
                            Image
                        </th>
                        <td>
                            <img src="{{ asset($product->getFirstMediaUrl('photo')) }}" 
                            width="150px" height="150px" />
                        </td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.product.fields.description') }}</th>
                        <td>{{$product->description ?? ''}}</td>
                    </tr>
                </tbody>
                </table>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection