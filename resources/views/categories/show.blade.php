@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3 shadow" style="max-width: 900px; width: 100%;">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.category.title_singular') }}
            </div>  
            <div class="card-body">
                <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>{{ trans('cruds.category.fields.id') }}</th>
                        <td>{{$category->id ?? ''}}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.category.fields.name') }}</th>
                        <td>{{$category->name ?? ''}}</td>
                    </tr>
                </tbody>
                </table>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection