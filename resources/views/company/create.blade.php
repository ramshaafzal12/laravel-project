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
                    <form action="{{ route('company.store') }}"
                            method="POST" enctype="multipart/form-data" id="company-form">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="col-form-label" for="company_name">Company Name<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{ old('company_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="name" class="col-form-label">User Name<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="name" placeholder="User Name" name="name" value="{{ old('name') }}">
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
                                            <label for="country_code" class="col-form-label">Phone Number<span class="require">*</span></label>
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
                                        <label for="city_id" class="col-form-label">City<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <select name="city_id" id="city_id" class="form-control">
                                                <option value="">Select City</option>
                                                @foreach($cities as $key => $city)
                                                <option value="{{ $key }}"> {{ $city }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label for="country_code" class="col-form-label">Address<span class="require">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{ old('address') }}">
                                        </div>
                                    </div>
                                </div>
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

</script>
@endpush