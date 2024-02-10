@extends('admin.common.admin')

@section('content')
    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Write Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('category.store') }}" id="qr-generate" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" id="category" name="quantity" class="form-control" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" id="edit-category" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <input type="text" id="edit-category-name" name="category" class="form-control" />
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
                    Create Category
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table id="qr-table" class="users-table display dt-responsive responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th width="10%">Id</th>
                            <th width="80%">Category</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </main>
    <script>
        // const qrRoute = "{{ route('qr-code.store') }}";
        $(document).ready(function() {

            table1 = $('#qr-table').DataTable({
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "responsive": true,
                "displayStart": 0,
                // "order": [0, 'desc'],
                "ajax": {
                    "url": "{{ route('admin.category-list') }}",
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
            $('#qr-generate').on('submit', function(e) {
                e.preventDefault();
                var qrroute = $(this).attr('action');
                data = {
                    'category': $('#category').val()
                }

                $.post(qrroute, data).done(function(res) {
                    $('body').click();
                    table1.ajax.reload();
                    toastr.success('Category added successfully');
                }).fail(function(res) {
                    toastr.error('Something went wrong');

                });

            });

            $('#edit-category').validate({
                rules: {
                    'quantity': {
                        'required': true,
                        'maxlength': 20,
                        'minlength': 3,
                    }
                }
            });
        });

        function editCat(id, name) {
            var form = $('#edit-category');
            form.attr('action', '/admin/category/' + id);

            $('#edit-category-name').val(name);
            $('#editModal').modal('show');
        }

        
    </script>
@endsection
