@extends('admin.common.admin')

@section('content')
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">How many qr you want to generate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('qr-code.store') }}" id="qr-generate" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="number" id="quantity" name="quantity" class="form-control" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="content">
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <h1 class="h3 d-inline align-middle">Users Table</h1>
            </div>
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Generate QR
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="qr-table" class="users-table display dt-responsive responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>QR Code</th>
                            <th>Link</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
    <script>
        // const qrRoute = "{{ route('qr-code.store') }}";
        $(document).ready(function() {
            $('#qr-table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "responsive": true,
                "displayStart": 0,
                "ajax": {
                    "url": "{{ route('admin.qr-list') }}",
                    "type": "POST",

                    "dataType": "json",
                    "dataSrc": function(json) {
                        console.log(json)
                        return json.data; // Assuming your data is wrapped in an array
                    },

                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "path"
                    },

                    {
                        "data": "name"
                    }, {
                        "data": "button"
                    }
                ],
                "searching": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],



            });
        });

        $(document).ready(function() {
            $('#qr-generate').on('submit', function(e) {
                e.preventDefault();
                var qrroute = $(this).attr('action');
                data = {
                    'quantity': $('#quantity').val()
                }
                $.post(qrroute, data);
            });
        })
    </script>
@endsection
