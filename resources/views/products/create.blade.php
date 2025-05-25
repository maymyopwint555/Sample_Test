@extends('layouts.admin')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3 shadow" style="max-width: 900px; width: 100%;">
        <div class="card-header">
            <h4 class="card-title">{{ trans('global.create') }} {{ trans('cruds.product.title_singular') }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route("products.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.product.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                            @if($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.name_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.product.fields.code') }}</label>
                            <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                            @if($errors->has('code'))
                                <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.code_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="qty">{{ trans('cruds.product.fields.qty') }}</label>
                            <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', '') }}" required>
                            @if($errors->has('qty'))
                                <span class="text-danger">{{ $errors->first('qty') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.qty_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required" for="price">{{ trans('cruds.product.fields.price') }}</label>
                            <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" required>
                            @if($errors->has('price'))
                                <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.price_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_id" class="form-label required">{{ trans('cruds.product.fields.category') }}</label>
                            <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}"
                                name="category_id" id="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                                <span class="text-danger">{{ $errors->first('category') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.category_helper') }}</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brand_id" class="form-label required">{{ trans('cruds.product.fields.brand') }}</label>
                            <select class="form-control select2 {{ $errors->has('vendor') ? 'is-invalid' : '' }}"
                                name="brand_id" id="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('brand'))
                                <span class="text-danger">{{ $errors->first('brand') }}</span>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.brand_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="form-group col-md-12">
                        <label for="product_photo">Image</label>
                        <div class="needsclick dropzone {{ $errors->has('product_photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('product_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('product_photo') }}
                            </div>
                        @endif
                        <span class="help-block"></span>
                    </div>
                </div>
                 <div class="row mt-3">
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label for="description">{{ trans('cruds.product.fields.description') }}</label>
                            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" rows="3"
                                placeholder="Description ..." id="description" required>
                            {{ old('description') }}
                            </textarea>
                            @if ($errors->has('description'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.product.fields.description_helper') }}</span>
                        </div>
                    </div>
                <div class="form-group mt-3">
                    <button class="btn btn-outline-warning" type="submit">
                        {{ trans('global.save') }}
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-3">
                        {{ trans('global.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    var uploadedImagesMap = {}

    function dropzoneCall(inputName, maxFile) {
        return {
            url: '{{ route('products.storeMedia') }}',
            maxFiles: maxFile,
            maxFilesize: 10, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 10,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                if (inputName == 'photo') {
                    $('form').append('<input type="hidden" name="' + inputName + '[]" value="' + response.name +
                        '">')
                } else {
                    $('form').append('<input type="hidden" name="' + inputName + '" value="' + response.name + '">')
                }
                uploadedImagesMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedImagesMap[file.name]
                }
                if (inputName == 'photo') {
                    $('form').find('input[name="' + inputName + '[]"][value="' + name + '"]').remove()
                } else {
                    $('form').find('input[name="' + inputName + '"]').remove()
                }

            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    }

    Dropzone.options.photoDropzone = dropzoneCall('photo', 1);
</script>
@endsection