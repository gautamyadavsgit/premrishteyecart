@extends('admin.common.admin')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="mb-3">
                <h1 class="h3 d-inline align-middle">Forms</h1>
                <a class="badge bg-dark text-white ms-2" href="upgrade-to-pro.html">
                    Create/Update user
                </a>
            </div>
            <form method="post"
                @if (isset($user)) action="{{ route('users.update', ['user' => $user['id']]) }}"
            @else
                action="{{ route('users.store') }}" @endif>
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif

                <input type="hidden" name="user_id" value="{{ $user['id'] ?? '' }}">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Name</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', isset($user['name']) ? $user['name'] : '') }}"
                                    placeholder="Enter user name">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Password</h5>
                            </div>
                            <div class="card-body">
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                    placeholder="Enter user password">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Email</h5>
                            </div>
                            <div class="card-body">
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', isset($user['email']) ? $user['email'] : '') }}"
                                    placeholder="Enter user email">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Phone</h5>
                            </div>
                            <div class="card-body">
                                <input type="tel" name="mobile"
                                    value="{{ old('mobile', isset($user['mobile']) ? $user['mobile'] : '') }}"
                                    class="form-control" placeholder="Enter user phone">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Role</h5>
                            </div>
                            <div class="card-body">
                                <select class="form-select mb-3" name="roll">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role['name'] }}"
                                            {{ old('roll', isset($user['name']) ? $user['name'] : '') == $role['name'] ? 'selected' : '' }}>
                                            {{ $role['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Status</h5>
                            </div>
                            <div class="card-body">
                                <select name="status" class="form-select mb-3">
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Deactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </main>
@endsection
