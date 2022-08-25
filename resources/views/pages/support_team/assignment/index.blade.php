@extends('layouts.master')
@section('page_title', 'Manage Assignment')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage Assignment</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        @if (session()->has('msg'))
            <div class="alert alert-success">
                {{ session()->get('msg') }}
            </div>
        @endif
        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Manage Assignment</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i>
                        Create New Assignment</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-classes">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Assignment Title</th>
                                <th>Assignment File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->assignment_title }}</td>
                                    <td><a target="_nobir" href="{{ $c->assignment_file }}">{{ $c->assignment_file }}</a>
                                    </td>
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
                                                            href="#" class="dropdown-item"><i class="icon-trash"></i>
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
                                    Assignment, you can edit it or add more sections to the Assignment at <a target="_blank"
                                        href="{{ route('sections.index') }}">Manage Sections</a></span>
                            </div>
                        </div>
                    </div>

                    <div Semester="row">
                        <div class="col-md-6">
                            {{-- //This form is for Teacher --}}
                            @if (Auth::user()->user_roll != 'student')
                                {{-- class="ajax-store" --}}
                                <form class="ajax-store" method="post" enctype="multipart/form-data"
                                    action="{{ route('assignment.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Select
                                            Semester <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select required data-placeholder="Select Semester" class="form-control select"
                                                name="semester_name" id="semester_name">
                                                <option value=""></option>
                                                @foreach ($semester as $s)
                                                    <option {{ old('my_class_id') == $s->id ? 'selected' : '' }}
                                                        value="{{ $s->name }}">{{ $s->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Select
                                            group <span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select required data-placeholder="Select Group" class="form-control select"
                                                name="group" id="group">
                                                <option value=""></option>
                                                @foreach ($section as $g)
                                                    <option {{ old('group') == $g->name ? 'selected' : '' }}
                                                        value="{{ $g->name }}">{{ $g->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Assignment Title:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="assignment_title" value="{{ old('assignment_title') }}" required
                                                type="text" class="form-control" placeholder="Assignment Title">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Assignment file:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="assignment_file" value="{{ old('assignment_file') }}"
                                                accept=".pdf" required type="file" class="form-control"
                                                placeholder="Assignment file">
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i
                                                class="icon-paperplane ml-2"></i></button>
                                    </div>
                                </form>
                            @endif
                            {{-- @dd(Auth::user()->user_roll) --}}
                            @if (Auth::user()->user_roll == 'student')
                                {{-- This form is for Student --}}
                                <form class="ajax-store" method="post" enctype="multipart/form-data"
                                    action="{{ route('notice.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Assignment file:<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="assignment_given" value="{{ old('notice_file') }}"
                                                accept=".pdf" required type="file" class="form-control"
                                                placeholder="Assignment file">
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
                </div>
            </div>
        </div>
    </div>

    {{-- Class List Ends --}}

@endsection
