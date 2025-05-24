@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3 shadow" style="max-width: 900px; width: 100%;">
        <div class="card-header">
            <h4 class="card-title">{{ trans('global.edit') }} {{ trans('cruds.category.title_singular') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("categories.update",[$category->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="required" for="name">{{ trans('cruds.category.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $category->name) }}" required>
                    @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.category.fields.name_helper') }}</span>
                </div>
                <div class="form-group mt-3">
                    <button class="btn btn-outline-warning" type="submit">
                        {{ trans('global.update') }}
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary me-3">
                        {{ trans('global.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection