@extends('layouts.master')
{{-- @dd($data_update) --}}
@section('page_title', 'Edit Class - '.$data_update->department_name)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Deparment</h6>
            {!! Qs::getPanelOptions() !!}
        </div>
{{-- @dd($data_update->id) --}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    {{-- class="ajax-update" --}}
                    <form  data-reload="#page-header" method="post" action="{{ route('userCreation.update', $data_update->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label for="user_id" class="col-lg-3 col-form-label font-weight-semibold">User Id <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input id="user_id" required name="user_id" value="{{$data_update->user_id}}" type="text" class="form-control" placeholder="User ID">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">User Roll <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <select name="user_roll" value="{{ old('user_roll') }}" required type="text" class="form-control" placeholder="Name of User">
                                    <option value="">Select user roll </option>
                                    <option value="teacher">Teachers</option>
                                    <option value="student">Student</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--Class Edit Ends--}}

@endsection
