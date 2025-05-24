@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="card">
       <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>Category Lists</h5>
                </div>
                <div class="col-md-6 d-flex justify-content-end align-items-center">
                    <form action="{{ route('categories.index') }}" class="d-flex me-2">
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

                    <a href="{{ route('categories.create') }}" class="btn btn-outline-primary">
                        <i class="fas fa-plus me-1"></i> {{ trans('global.add') }}
                    </a>
                </div>
            </div>
        </div>        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>{{ trans('cruds.category.fields.no') }}</th>
                    <th>{{ trans('cruds.category.fields.name') }}</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$firstItem++}}</td>
                            <td>{{$category->name ?? ''}}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="bx bx-show-alt"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-outline-secondary me-2">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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
                {{ $categories->appends(request()->input())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection