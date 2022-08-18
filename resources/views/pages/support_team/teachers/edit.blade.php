@extends('layouts.master')
@section('page_title', 'Manage Teachers')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Teachers</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-user" class="nav-link active" data-toggle="tab">Create New Teacher</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage Teachers</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- @foreach($teachers as $ut) --}}
                        <a href="#ut-{{$teachers->id }}" class="dropdown-item" data-toggle="tab"> Mangage Profile </a>
                    {{-- @endforeach --}}
                    </div>
                </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-user">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" action="{{ route('teachers.update',Qs::hash($teachers->id)) }}" data-fouc>
                        @csrf
                        @method("PUT")

                    <h6>Update Teachers Information</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name: <span class="text-danger">*</span></label>
                                        <input value="{{ $teachers->name }}" required type="text" name="name" placeholder="Full Name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address: <span class="text-danger">*</span></label>
                                        <input value="{{ $teachers->address }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email Address: <span class="text-danger">*</span></label>
                                        <input value="{{  $teachers->email }}" type="email" name="email" class="form-control" placeholder="your@email.com" required>
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone: <span class="text-danger">*</span></label>
                                        <input value="{{  $teachers->phone }}" type="text" name="phone" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Employment: <span class="text-danger">*</span></label>
                                        <input autocomplete="off" name="emp_date" value="{{  $teachers->emp_date }}" type="text" required class="form-control date-pick" placeholder="Select Date...">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose.." required>
                                            <option value=""></option>
                                            <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                            <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">Nationality: <span class="text-danger">*</span></label>
                                    <input value="{{  $teachers->nationality }}" type="text" name="nationality" class="form-control" placeholder="
                                    Nationality" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_name">Blood Group: <span class="text-danger">*</span></label>
                                    <select class="select form-control" id="bg_id" name="bg_name" data-fouc data-placeholder="Choose.." required>
                                        <option value=""></option>
                                        @foreach($blood_groups as $bg)
                                            <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->name }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block">Upload Passport Photo: <span class="text-danger">*</span></label>
                                    <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" required data-fouc>
                                    <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block">Upload Your CV or Resume: <span class="text-danger">*</span></label>
                                    <input value="{{ old('resume') }}" accept=".pdf" type="file" name="resume" class="form-input-styled" required data-fouc>
                                    <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                </div>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Student List Ends--}}

@endsection
