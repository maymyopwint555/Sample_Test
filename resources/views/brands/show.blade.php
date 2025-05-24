@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3 shadow" style="max-width: 900px; width: 100%;">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.brand.title_singular') }}
            </div>  
            <div class="card-body">
                <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.brand.fields.id') }}</th>
                        <td>{{$brand->id ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.brand.fields.name') }}</th>
                        <td>{{$brand->name ?? ''}}</td>
                    </tr>
                </tbody>
                </table>
                <a href="{{ route('brands.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection