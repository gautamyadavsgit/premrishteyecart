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
            <form method="post" action="{{ route('shop.store') }}"> @csrf
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Back Cover</h5>
                            </div>
                            <div class="card-body">
                                <input type="file" name="back_cover" class="form-control">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Profile Photo</h5>
                            </div>
                            <div class="card-body">
                                <input type="file" class="form-control" name="profile_photo">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Name</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" required name="name" class="form-control"
                                    value="{{ old('name', isset($user['name']) ? $user['name'] : '') }}"
                                    placeholder="Enter user name">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Whatsapp</h5>
                            </div>
                            <div class="card-body">
                                <input type="number" required class="form-control" name="whatsapp" value="{{ old('whatsapp') }}"
                                    placeholder="Enter Whatsapp">
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Email</h5>
                            </div>
                            <div class="card-body">
                                <input type="email" required name="email" class="form-control"
                                    value="{{ old('email', isset($user['email']) ? $user['email'] : '') }}"
                                    placeholder="Enter user email">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Phone</h5>
                            </div>
                            <div class="card-body">
                                <input type="tel" required name="mobile"
                                    value="{{ old('mobile', isset($user['mobile']) ? $user['mobile'] : '') }}"
                                    class="form-control" placeholder="Enter user phone">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Google Map</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" required name="googlemap" class="form-control" />
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Website</h5>
                            </div>
                            <div class="card-body">
                                <input type="text" required  name=""
                                    value="{{ old('mobile', isset($user['mobile']) ? $user['mobile'] : '') }}"
                                    class="form-control" placeholder="Enter user phone">
                            </div>
                        </div>


                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="payment-link-type">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Payment links</h5>
                                </div>

                                <div class="card-body">
                                    <select class="form-select mb-3 payment-links" name="roll">
                                        <option value="0" disabled selected>Select payment link type</option>
                                        @foreach ($paymentOptions as $option)
                                            <option value="{{ $option }}">
                                                {{ convertCamelcaseToString($option) }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            {{-- <button type="button" class="btn btn-success">Add More</button> --}}
                        </div>

                    </div>

                    <div class="col-12 ">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">About</h5>
                            </div>
                            <div class="card-body">
                                <textarea name="about" id="about-text1" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 ">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Message</h5>
                            </div>
                            <div class="card-body">
                                <textarea name="message" id="message" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </main>
    <script>
        $(document).ready(function() {

            CKEDITOR.replace('about-text1');
            CKEDITOR.replace('message');

        });
    </script>
@endsection
