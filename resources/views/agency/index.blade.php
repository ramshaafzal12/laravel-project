<!-- /.row -->
@extends('layouts.app')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1>Agencies</h1>
            </div>
            <div class="col-sm-6">
                <div class="pull-right" style="margin-left:70%">
                    <a class="btn btn-success btn-sm" href="{{ route('agency.create') }}"> Create New Agency</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm agencie-datatable">
                <thead class="thead-dark">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Agency Name</th>
                        <th>Company Name</th>
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
    var AgencyTable = {};
    AgencyTable = { ...dataTableParams };
    AgencyTable.element = "agencie-datatable";
    AgencyTable.url = "/agencies/all";
    AgencyTable.columns = [
        "id",
        "agency_name",
        "company_name",
        "status",
        "action"
    ];
    AgencyTable.dataColumns = [];

    makeDataTable(AgencyTable);
    function deleteAgency(id){
        var url = $(`#deleteForm${id}`).attr('data-action');
        console.log(url);
        deleteRecord(url, 'User', 'POST');
    }
</script>

@endpush