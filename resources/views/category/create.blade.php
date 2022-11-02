@extends('layouts.app')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-12 p-3">
            <div class="card customCard">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
                </div>
                <div class="card-body card-body-left labelLineHeight">
                    <form action="{{ route('category.store') }}"
                            method="POST" enctype="multipart/form-data" id="categories-form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="company_id">Company<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select name="company_id" id="company_id" class="form-control" onchange="getAgencyDropdownWrtCompany(this.value, 'agenciesDropdown')">
                                                <option value="" disabled selected>Select Company</option>
                                                @foreach($companies as $key => $company)
                                                <option value="{{ $company->id }}"> {{ $company->company_name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="agency_id" class="col-form-label">Agency<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select name="agency_id" id="agenciesDropdown" class="form-control">
                                                <option value="" disabled selected>Select Agency</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                        <label for="name" class="col-form-label">Category Name<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" placeholder="Category Name" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                               
                            </div>
                        </div>
                        <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('page_scripts')
<script>
     function userTypeChange(type) {
        var selectedType = type.options[type.selectedIndex].value;
        
        if(selectedType == 2) {
            $('#clubsDropdown').show();
        } else {
            $('#clubsDropdown').hide();
        }
    }
    
    getAgencyDropdownWrtCompany(null, 'agenciesDropdown');
</script>
@endpush