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
            <form method="post" action="{{route('users.store')}}">
                @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Name</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter user name">
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Password</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" class="form-control" name="password"  value="{{old('password')}}" placeholder="Enter user password">
                        </div>
                    </div>
                 
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Email</h5>
                        </div>
                        <div class="card-body">
                            <input type="text" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter user email">
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Radios</h5>
                        </div>
                        <div class="card-body">
                            <div>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option1" name="radios-example"
                                        checked>
                                    <span class="form-check-label">
                                        Option one is this and that&mdash;be sure to include why it's great
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option2" name="radios-example">
                                    <span class="form-check-label">
                                        Option two can be something else and selecting it will deselect option one
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input class="form-check-input" type="radio" value="option3" name="radios-example"
                                        disabled>
                                    <span class="form-check-label">
                                        Option three is disabled
                                    </span>
                                </label>
                            </div>
                            <div>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example"
                                        value="option1">
                                    <span class="form-check-label">
                                        1
                                    </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example"
                                        value="option2">
                                    <span class="form-check-label">
                                        2
                                    </span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inline-radios-example"
                                        value="option3" disabled>
                                    <span class="form-check-label">
                                        3
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Selects</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select mb-3">
                                <option selected>Open this select menu</option>
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                            </select>

                            <select multiple class="form-control">
                                <option>One</option>
                                <option>Two</option>
                                <option>Three</option>
                                <option>Four</option>
                            </select>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Disabled</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Disabled input</label>
                                <input type="text" class="form-control" placeholder="Disabled input" disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Disabled select menu</label>
                                <select class="form-control" disabled>
                                    <option>Disabled select</option>
                                </select>
                            </div>
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" value="" disabled>
                                <span class="form-check-label">
                                    Can't check this
                                </span>
                            </label>
                        </div>
                    </div> --}}
               
             
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Phone</h5>
                        </div>
                        <div class="card-body">
                            <input type="number" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Enter user phone">
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Roll</h5>
                        </div>
                        <div class="card-body">
                            <select class="form-select mb-3" name="roll">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
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
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                
            </div>
            <button class="btn btn-primary ">Submit</button> 
        </form>
        </div>
    </main>
@endsection
