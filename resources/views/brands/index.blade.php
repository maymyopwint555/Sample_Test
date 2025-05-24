@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
       <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>Brand Lists</h5>
                </div>
               <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <form action="{{ route('brands.index') }}" class="d-flex me-2">
                        <input 
                            class="form-control me-2" 
                            name="search" 
                            type="search" 
                            placeholder="Search Name" 
                            aria-label="Search" 
                            value="{{ request('search') }}"
                        >
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>

                    <a href="{{ route('brands.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-1"></i> {{ trans('global.add') }}
                    </a>
                </div>
            </div>
        </div>        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>{{ trans('cruds.brand.fields.no') }}</th>
                    <th>{{ trans('cruds.brand.fields.name') }}</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{$firstItem++}}</td>
                            <td>{{$brand->name ?? ''}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('brands.show', $brand->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
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
                {{ $brands->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
