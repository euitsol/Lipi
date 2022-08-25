@extends('layouts.master')
@section('page_title', 'Manage User Creations')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Account Creation</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div>
                @if(session()->has("msg"))
                <div class="alert alert-danger">
                    <span>{{session()->get("msg")}}</span>
                </div>
                @endif
            </div>
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">User Creation</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New User Creation</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>ID</th>
                                <th>designation</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{-- @if ($c->user_id=="")
                                        <span>not registrated</span>
                                        @else --}}
                                        {{ $c->user_id }}
                                        {{-- @endif --}}
                                        </td>
                                    <td>{{ $c->user_roll }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-left">
                                                    @if(Qs::userIsTeamSA())
                                                    {{--Edit--}}
                                                    <a href="{{ route('userCreation.edit', $c->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                   @endif
                                                        @if(Qs::userIsSuperAdmin())
                                                    {{--Delete--}}
                                                    <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="post" id="item-delete-{{ $c->id }}" action="{{ route('userCreation.destroy', $c->id) }}" class="hidden">@csrf @method('delete')</form>
                                                        @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                <div class="tab-pane fade" id="new-class">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info border-0 alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                                <span>When a User is created, a Section will be automatically created for the User , you can edit it or add more sections to the User at <a target="_blank" href="{{ route('sections.index') }}">Manage Sections</a></span>
                            </div>
                        </div>
                    </div>

                    <div Semester="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('userCreation.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="user_id" class="col-lg-3 col-form-label font-weight-semibold">User Id <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="user_id" required name="user_id" value="{{ old('user_id') }}" type="text" class="form-control" placeholder="User ID">
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
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Class List Ends--}}

@endsection
