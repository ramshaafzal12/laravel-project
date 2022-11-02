<!-- /.row -->
@extends('layouts.app')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-6">
                <h1>Categories</h1>
            </div>
            <div class="col-sm-6">
                <div class="pull-right" style="margin-left:70%">
                    <a class="btn btn-success btn-sm" href="{{ route('category.create') }}"> Create New Category</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm categorie-datatable">
                <thead class="thead-dark">
                    <tr style="text-align: center">
                        <th>No</th>
                        <th>Company Name</th>
                        <th>Agency Name</th>
                        <th>Category</th>
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
    var CategoryTable = {};
    CategoryTable = { ...dataTableParams };
    CategoryTable.element = "categorie-datatable";
    CategoryTable.url = "/categories/all";
    CategoryTable.columns = [
        "id",
        "company_name",
        "agency_name",
        "name",
        "status",
        "action"
    ];
    CategoryTable.dataColumns = [];

    makeDataTable(CategoryTable);
    function deleteCategory(id){
        var url = $(`#deleteForm${id}`).attr('data-action');
        console.log(url);
        deleteRecord(url, 'Category', 'POST');
    }
</script>

@endpush