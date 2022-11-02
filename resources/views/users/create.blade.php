@extends('layouts.app')
@section('content')
<section class="content">
    <div class="row">
        <div class="col-sm-12 p-3">
            <div class="card customCard">
                <div class="card-header">
                    <h3 class="card-title">Add User</h3>
                </div>
                <div class="card-body card-body-left labelLineHeight">
                    <form action="{{ route('users.store') }}"
                            method="POST" enctype="multipart/form-data" id="users-form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="name">User Name<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="country_code" class="col-form-label">Phone Number</label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="phone_number"
                                                    placeholder="Phone Number"
                                                    name="phone_number" maxlength="15"
                                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                    value="{{ old('phone_number') }}">
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
                                        <label for="name" class="col-form-label">Email Address<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                        <label for="password" class="col-form-label">Password<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="{{ old('password') }}">
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
</script>
@endpush