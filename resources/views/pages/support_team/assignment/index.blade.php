@extends('layouts.master')
@section('page_title', 'Manage Assignment')
@section('content')


    {{-- This card for Teacher ,Super Admin And Admin --}}
    @if (Auth::user()->user_roll != 'student')

        <div class="card">
            <div class="card-header header-elements-inline">
                @if (Auth::user()->user_roll == 'student')
                    <h2 class="card-title text-center w-100">Your Assignment</h2>
                @else
                    <h6 class="card-title">Manage Assignment</h6>
                @endif
                {!! Qs::getPanelOptions() !!}
            </div>

            @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif
            <div class="card-body">
                {{-- @if (Auth::user()->user_roll != 'student') --}}
                @if (Auth::user()->user_roll != 'student')
                    <ul class="nav nav-tabs nav-tabs-highlight">
                        <li class="nav-item">
                            {{-- @if (Auth::user()->user_roll != 'student') --}}
                            {{-- <a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Assignment</a> --}}
                            {{-- @endif --}}
                            <a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Assignment</a>
                        </li>


                        <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab">
                                <i class="icon-plus2"></i>
                                Create New Assignment</a>
                        </li>

                    </ul>
                @endif


                @if (Auth::user()->user_roll == 'student')
                    <h4 class="text-success text-center">New Assignment</h4>
                    <div class="tab-pane fade show active" id="all-classes" style="margin-top: 20px; margin-bottom: 50px;">
                        {{-- datatable-button-html5-columns --}}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Assignment Title</th>
                                    <th>Assignment</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($new_assignment as $new_assignment)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $new_assignment->assignment_title }}</td>
                                        <td><a target="_nobir"
                                                href="{{ $new_assignment->assignment_file }}">{{ $new_assignment->assignment_file }}</a>
                                        </td>
                                        <td>{{ $new_assignment->start_date }}</td>
                                        <td>{{ $new_assignment->end_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <h4 class="text-center mb-3 text-success">Submit Assignment</h4>
                    {{-- class="ajax-store --}}
                    <form mb-4" method="post" enctype="multipart/form-data" action="{{ route('assignmentSubmit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="assignment_name" class="col-lg-3 col-form-label font-weight-semibold">Assignment
                                Name
                                <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                {{-- @dd($new_assignment) --}}
                                <select required data-placeholder="Select Semester" class="form-control select"
                                    name="assignment_name" id="assignment_name">
                                    <option value="">Select Assignment</option>

                                    @foreach ($new_assignment2 as $new_assignment)
                                        <option value="{{ Qs::hash($new_assignment->id) }}">
                                            {{ $new_assignment->assignment_title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Assignment file:<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="assignment_given" value="{{ old('notice_file') }}" accept=".pdf" required
                                    type="file" class="form-control" placeholder="Assignment file">
                            </div>
                        </div>
                        <div class="text-right">
                            <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                @endif
                <hr class="">
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="all-classes">
                        @if (Auth::user()->user_roll == 'student')
                            <h3 class="text-center">Assignment that you have been submited</h3>
                        @else
                            <h3 class="">Assignments</h3>
                        @endif

                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Assignment Title</th>
                                    <th>Assignment</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->assignment_title }}</td>
                                        <td><a target="_nobir"
                                                href="{{ $c->assignment_file }}">{{ $c->assignment_file }}</a>
                                        </td>
                                        <td>{{ $c->start_date }}</td>
                                        <td>{{ $c->end_date }}</td>
                                        <td class="text-center">
                                            <div class="list-icons">
                                                <div class="dropdown">
                                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                        <i class="icon-menu9"></i>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-left">
                                                        @if (Qs::userIsTeamSA())
                                                            {{-- Edit --}}

                                                            <a href="{{ route('assignment.edit', Qs::hash($c->id)) }}"
                                                                class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        @endif
                                                        @if (Qs::userIsSuperAdmin())
                                                            {{-- Delete --}}
                                                            <a id="{{ Qs::hash($c->id) }}" onclick="confirmDelete(this.id)"
                                                                href="#" class="dropdown-item"><i
                                                                    class="icon-trash"></i>
                                                                Delete</a>
                                                            <form method="post" id="item-delete-{{ Qs::hash($c->id) }}"
                                                                action="{{ route('assignment.destroy', Qs::hash($c->id)) }}"
                                                                class="hidden">@csrf @method('delete')</form>
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

                                    <span>When a Assignment is created, a Section will be automatically created for the
                                        Assignment, you can edit it or add more sections to the Assignment at <a
                                            target="_blank" href="{{ route('sections.index') }}">Manage Sections</a></span>
                                </div>
                            </div>
                        </div>

                        <div Semester="row">
                            <div class="col-md-6">

                                @if (Auth::user()->user_roll != 'student')
                                    <form class="ajax-store" method="post" enctype="multipart/form-data"
                                        action="{{ route('assignment.store') }}">
                                        @csrf

                                        <div class="form-group row">
                                            <label for="my_class_id"
                                                class="col-lg-3 col-form-label font-weight-semibold">Select
                                                Semester <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select required data-placeholder="Select Semester"
                                                    class="form-control select" name="semester_name" id="semester_name">
                                                    <option value=""></option>
                                                    @foreach ($semester as $s)
                                                        <option {{ old('my_class_id') == $s->id ? 'selected' : '' }}
                                                            value="{{ $s->name }}">{{ $s->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="my_class_id"
                                                class="col-lg-3 col-form-label font-weight-semibold">Select
                                                group <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select required data-placeholder="Select Group"
                                                    class="form-control select" name="group" id="group">
                                                    <option value=""></option>
                                                    @foreach ($section as $g)
                                                        <option {{ old('group') == $g->name ? 'selected' : '' }}
                                                            value="{{ $g->name }}">{{ $g->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label font-weight-semibold">Assignment
                                                Title:<span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input name="assignment_title" value="{{ old('assignment_title') }}"
                                                    required type="text" class="form-control"
                                                    placeholder="Assignment Title">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label font-weight-semibold">Assignment
                                                file:<span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input name="assignment_file" value="{{ old('assignment_file') }}"
                                                    accept=".pdf" required type="file" class="form-control"
                                                    placeholder="Assignment file">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label font-weight-semibold">Start Date:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input name="start_date" value="{{ old('start_date') }}" required
                                                    type="date" class="form-control" placeholder="Start Date">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label font-weight-semibold">End Date:<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input name="end_date" value="{{ old('end_date') }}" required
                                                    type="date" class="form-control" placeholder="End Date">
                                            </div>
                                        </div>

                                        <div class="text-right">
                                            <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i
                                                    class="icon-paperplane ml-2"></i></button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade show active" id="all-classes" style="margin-top: 50px">
                            @if (Auth::user()->user_roll == 'student')
                                <h3 class="text-center">Assignment that you have been submited</h3>
                            @else
                                <h3 class="">Assignments</h3>
                            @endif

                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Assignment Title</th>
                                        <th>Assignment</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->assignment_title }}</td>
                                            <td><a target="_nobir"
                                                    href="{{ $c->assignment_file }}">{{ $c->assignment_file }}</a>
                                            </td>
                                            <td>{{ $c->start_date }}</td>
                                            <td>{{ $c->end_date }}</td>
                                            <td class="text-center">
                                                <div class="list-icons">
                                                    <div class="dropdown">
                                                        <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                            <i class="icon-menu9"></i>
                                                        </a>

                                                        <div class="dropdown-menu dropdown-menu-left">
                                                            @if (Qs::userIsTeamSA())
                                                                {{-- Edit --}}

                                                                <a href="{{ route('assignment.edit', Qs::hash($c->id)) }}"
                                                                    class="dropdown-item"><i class="icon-pencil"></i>
                                                                    Edit</a>
                                                            @endif
                                                            @if (Qs::userIsSuperAdmin())
                                                                {{-- Delete --}}
                                                                <a id="{{ Qs::hash($c->id) }}"
                                                                    onclick="confirmDelete(this.id)" href="#"
                                                                    class="dropdown-item"><i class="icon-trash"></i>
                                                                    Delete</a>
                                                                <form method="post"
                                                                    id="item-delete-{{ Qs::hash($c->id) }}"
                                                                    action="{{ route('assignment.destroy', Qs::hash($c->id)) }}"
                                                                    class="hidden">@csrf @method('delete')</form>
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
                    </div>
                </div>
                {{-- @endif --}}

            </div>
        </div>
    @endif



    {{-- This card for Student --}}
    @if (Auth::user()->user_roll == 'student')
        <div class="card">

            {{-- * Err msg --}}
            @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif
            {{-- * End Error Message --}}


            <div class="card-header header-elements-inline">
                <h2 class="card-title text-center w-100">Your Assignment</h2>
                {!! Qs::getPanelOptions() !!}
            </div>
            <div class="card-body">
                {{-- * New Assignment --}}
                <h4 class="text-success text-center">New Assignment</h4>
                <div class="tab-pane fade show active" id="all-classes" style="margin-top: 20px; margin-bottom: 50px;">
                    {{-- datatable-button-html5-columns --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Assignment Title</th>
                                <th>Assignment</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($new_assignment as $new_assignment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $new_assignment->assignment_title }}</td>
                                    <td><a target="_nobir"
                                            href="{{ $new_assignment->assignment_file }}">{{ $new_assignment->assignment_file }}</a>
                                    </td>
                                    <td>{{ $new_assignment->start_date }}</td>
                                    <td>{{ $new_assignment->end_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- * End New Assignment --}}
                <hr>


                {{-- * Submit assignment --}}
                <h4 class="text-center mb-3 text-success">Submit Assignment</h4>
                {{--  --}}
                <form class="ajax-store  mb-4" method="post" enctype="multipart/form-data"
                    action="{{ route('assignmentSubmit') }}">
                    @csrf

                    <div class="form-group row">
                        <label for="assignment_given_id" class="col-lg-3 col-form-label font-weight-semibold">Assignment
                            Name
                            <span class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            {{-- @dd($new_assignment) --}}
                            <select required data-placeholder="Select Semester" class="form-control select"
                                name="assignment_given_id" id="assignment_given_id">
                                <option value="">Select Assignment</option>

                                @foreach ($new_assignment2 as $new_assignment)
                                    <option value="{{ Qs::hash($new_assignment->id) }}">
                                        {{ $new_assignment->assignment_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Assignment file:<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="assignment_submited_file" value="{{ old('assignment_submited_file') }}"
                                accept=".pdf" required type="file" class="form-control"
                                placeholder="Assignment file">
                        </div>
                    </div>
                    <div class="text-right">
                        <button id="ajax-btn" type="submit" class="btn btn-primary">
                            Submit form
                            <i class="icon-paperplane ml-2"></i>
                        </button>
                    </div>
                </form>
                {{-- * End Submit Assignment --}}


                <hr class="">

                {{-- * Show Assignment that Have been past --}}
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="all-classes">
                        <h3 class="text-center">Assignment that you have been submited</h3>
                        <table class="table datatable-button-html5-columns">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Assignment Title</th>
                                    <th>Assignment</th>
                                    <th>Sumbit Assignment</th>
                                    <th>Death Line</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($submitted_assignment) --}}
                                @foreach ($submitted_assignment as $c)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $c->assignment_given->assignment_title }}</td>
                                        <td>
                                            <a target="_nobir" href="{{ $c->assignment_given->assignment_file }}">
                                                {{ $c->assignment_given->assignment_file }}
                                            </a>
                                        </td>
                                        <td>
                                            <a target="_nobir" href="{{ $c->assignment_submited_file }}">
                                                {{ $c->assignment_submited_file }}
                                            </a>
                                        </td>
                                        <td>{{ $c->assignment_given->start_date . ' => ' . $c->assignment_given->end_date }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endif

@endsection
