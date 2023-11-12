@extends('admin.common.admin')

@section('content')
    <main class="content">
        <div class="mb-3 d-flex justify-content-between">
            <div>
                <h1 class="h3 d-inline align-middle">Users Table</h1>
            </div>
            <div>
                <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="user-table" class="users-table display dt-responsive responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th>User Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#user-table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "responsive": true,
                "displayStart": 0,
                "ajax": {
                    "url": "{{ route('admin.users.data') }}",
                    "type": "POST",

                    "dataType": "json",
                    "dataSrc": function(json) {
                        return json[0].data; // Assuming your data is wrapped in an array
                    },

                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
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
                "drawCallback": function(settings) {
                    // Update the records total and filtered records count
                    var api = this.api();
                    $('#recordsTotal').text(api.page.info().recordsTotal);
                    $('#recordsFiltered').text(api.page.info().recordsDisplay);
                },


            });
        });
    </script>
@endsection
