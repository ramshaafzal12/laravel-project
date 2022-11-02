<!-- /.row -->
@extends('layouts.app')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1>User</h1>
            </div>
            <div class="col-sm-6">
                <div class="pull-right" style="margin-left:78%">
                    <a class="btn btn-success btn-sm" href="{{ route('users.create') }}"> Create New User</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm users-datatable">
                <thead class="thead-dark">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody style="text-align: center"></tbody>
            </table>
        </div>
    </div>
</section>
@endsection

@push('page_scripts')
<script>
    var usersTable = {};
    usersTable = { ...dataTableParams };
    usersTable.element = "users-datatable";
    usersTable.url = "/users/all";
    usersTable.columns = [
        "id",
        "name",
        "email",
        "phone",
        "status",
        "action"
    ];
    usersTable.dataColumns = [];

    makeDataTable(usersTable);
    function deleteUser(id){
        var url = $(`#deleteForm${id}`).attr('data-action');
        console.log(url);
        deleteRecord(url, 'User', 'POST');
    }
</script>

@endpush