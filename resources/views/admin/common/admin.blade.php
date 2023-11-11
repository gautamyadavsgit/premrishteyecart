@include('admin.common.header')
@include('admin.common.aside')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    @if (session('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success"> {{ session('success') }}</p>

        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-success  mt-2">
            <p class="text-warning"> {{ session('error') }}</p>

        </div>
    @endif
</div>
@yield('content');

@include('admin.common.footer')
