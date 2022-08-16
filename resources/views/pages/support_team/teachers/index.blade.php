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
                        @foreach($departments as $ut)
                            <a href="#ut-{{ Qs::hash($ut->id) }}" class="dropdown-item" data-toggle="tab">{{ $ut->short_name }}s</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="new-user">
                    <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-store" action="{{ route('teachers.store') }}" data-fouc>
                        @csrf

                    <h6>Teacher Login</h6>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username: </label>
                                    <input value="{{ old('username') }}" type="text" name="username" class="form-control" placeholder="Username">
                                </div>
                            </div>


                                <div class="col-md-6">
                                   <div class="form-group">
                                       <label for="password">Password: </label>
                                       <input id="password" type="password" name="password" class="form-control"  >
                                   </div>
                               </div>
                        </div>
                    </fieldset>

                    <h6>Personal Data</h6>
                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="user_type"> Select Department: <span class="text-danger">*</span></label>
                                        <select required data-placeholder="Select User" class="form-control select" name="department_name" id="department_name">
                                @foreach($departments as $ut)
                                    <option value="{{ Qs::hash($ut->id) }}">{{ $ut->short_name }}</option>
                                @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Full Name: <span class="text-danger">*</span></label>
                                        <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address: <span class="text-danger">*</span></label>
                                        <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Email Address: </label>
                                        <input value="{{ old('email') }}" type="email" name="email" class="form-control" placeholder="your@email.com">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Phone:</label>
                                        <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="+2341234567" >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Date of Employment:</label>
                                        <input autocomplete="off" name="emp_date" value="{{ old('emp_date') }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                                        <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
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
                                    <input value="{{ old('nationality') }}" type="text" name="nationality" class="form-control" placeholder="
                                    Nationality">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_name">Blood Group: </label>
                                    <select class="select form-control" id="bg_id" name="bg_name" data-fouc data-placeholder="Choose..">
                                        <option value=""></option>
                                        @foreach($blood_groups as $bg)
                                            <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->name }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block">Upload Passport Photo:</label>
                                    <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                    <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="d-block">Upload Your CV or Resume:</label>
                                    <input value="{{ old('resume') }}" accept=".pdf" type="file" name="resume" class="form-input-styled" data-fouc>
                                    <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                </div>
                            </div>
                        </div>
                        </fieldset>
                    </form>
                </div>

                @foreach($teacher as $ut)
                    <div class="tab-pane fade" id="ut-{{Qs::hash($ut->id)}}">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Department Name</th>
                                <th>Teachers Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>emp_date</th>
                                <th>gender</th>
                                <th>nationality</th>
                                <th>Teachers Photo</th>
                                <th>Teachers Resume</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{-- @foreach($users->where('user_type', $ut->title) as $u) --}}
                            @foreach($teacher as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img class="rounded-circle" style="height: 40px; width: 40px;" src="{{ $u->photo }}" alt="photo"></td>
                                    <td>{{ $u->department_name }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->address }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>{{ $u->phone }}</td>
                                    <td>{{ $u->emp_date }}</td>
                                    <td>{{ $u->gender }}</td>
                                    <td>{{ $u->nationality }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->photo }}</td>
                                    <td>{{ $u->resume }}</td>
                                    {{-- <td>{{ $u->email }}</td> --}}
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    {{--View Profile--}}
                                                    <a href="{{ route('teachers.show', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                                    {{--Edit--}}
                                                    <a href="{{ route('teachers.edit', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                {{-- @if(Qs::userIsSuperAdmin())

                                                        <a href="{{ route('teachers.reset_pass', Qs::hash($u->id)) }}" class="dropdown-item"><i class="icon-lock"></i> Reset password</a> --}}
                                                        {{--Delete--}}
                                                        {{-- <a id="{{ Qs::hash($u->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($u->id) }}" action="{{ route('teachers.destroy', Qs::hash($u->id)) }}" class="hidden">@csrf @method('delete')</form>
                                                @endif --}}

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{--Student List Ends--}}

@endsection
