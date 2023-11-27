@extends('admin.common.admin')

@section('content')
    <main class="content">
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <h1 class="h3 d-inline align-middle">Users Table</h1>
            </div>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Generate Qr</a>
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
                        "data": "name"
                    },
                    {
                        "data": "phone"
                    },
                    {
                        "data": "status"
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
    </script>
@endsection
