<!-- /.row -->
@extends('layouts.app')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1>Companies</h1>
            </div>
            <div class="col-sm-6">
                <div class="pull-right" style="margin-left:70%">
                    <a class="btn btn-success btn-sm" href="{{ route('company.create') }}"> Create New Company</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm companie-datatable">
                <thead class="thead-dark">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Address</th>
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
    var companyTable = {};
    companyTable = { ...dataTableParams };
    companyTable.element = "companie-datatable";
    companyTable.url = "/companies/all";
    companyTable.columns = [
        "id",
        "company_name",
        "address",
        "status",
        "action"
    ];
    companyTable.dataColumns = [];

    makeDataTable(companyTable);
    function deleteCompany(id){
        var url = $(`#deleteForm${id}`).attr('data-action');
        console.log(url);
        deleteRecord(url, 'User', 'POST');
    }
</script>

@endpush