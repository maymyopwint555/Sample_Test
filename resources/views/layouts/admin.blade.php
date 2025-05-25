<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- bootstrap --}}
    {{-- <link rel="stylesheet" href="{{asset('vendor/bootstrap/bootstrap.min.css')}}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- fontawesome and boxicon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- select2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    {{-- summernote --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.9.1/summernote-bs5.min.css" integrity="sha512-rDHV59PgRefDUbMm2lSjvf0ZhXZy3wgROFyao0JxZPGho3oOuWejq/ELx0FOZJpgaE5QovVtRN65Y3rrb7JhdQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- dropzone --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />

    <style>
    .custom-navbar {
        background-color: #416d96;
    }

    .nav-link {
        color: #ffffff !important;
    }

    .nav-link.active {
        color: #0de8c0 !important;
        font-weight: bold;
    }

   .required:after {
        content: " *";
        color: red;
    }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light custom-navbar shadow-sm">
            <div class="container">
                {{-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item mx-3">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->is('home') || request()->is('home/*') ? 'active' : '' }}">
    
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ route('categories.index') }}"
                                class="nav-link {{ request()->is('categories') || request()->is('categories/*') ? 'active' : '' }}">
    
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ route('brands.index') }}"
                                class="nav-link {{ request()->is('brands') || request()->is('brands/*') ? 'active' : '' }}">

                                <p>
                                    Brand
                                </p>
                            </a>
                        </li>
                        <li class="nav-item mx-3">
                            <a href="{{ route('products.index') }}"
                                class="nav-link {{ request()->is('products') || request()->is('products/*') ? 'active' : '' }}">

                                <p>
                                    Product
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('stocks.index') }}"
                                class="nav-link {{ request()->is('stocks') || request()->is('stocks/*') ? 'active' : '' }}">

                                <p>
                                    Stock
                                </p>
                            </a>
                        </li>
                    </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-link nav-link" style="display: inline; cursor: pointer;">
                                        <i class="fas fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (session('message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
            @endif
            @if (session('error_message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-danger" role="alert">{{ session('error_message') }}</div>
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>
    {{-- bootstrap --}}
    <script src="{{ asset('vendor/js/jquery.min.js')}}"></script>
    {{-- <script src="{{ asset('vendor/bootstrap/bootstrap.bundle.js')}}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.min.js" integrity="sha512-y8/3lysXD6CUJkBj4RZM7o9U0t35voPBOSRHLvlUZ2zmU+NLQhezEpe/pMeFxfpRJY7RmlTv67DYhphyiyxBRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    @yield('scripts')
    <script>
        $(function() {
           $('.select2').select2({
            theme: "bootstrap-5"
           })
       })
    </script>
</body>
</html>
