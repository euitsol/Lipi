@extends('layouts.master')
@section('page_title', 'Manage Subjects')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage </h6>
            {!! Qs::getPanelOptions() !!}
            @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-subject" class="nav-link active" data-toggle="tab">Add Semester</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        {{-- @foreach($semester as $c) --}}
                            <a href="#Semester_show" class="dropdown-item" data-toggle="tab">Semester</a>
                        {{-- @endforeach --}}
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show  active fade" id="new-subject">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- class="ajax-store" --}}
                            <form  method="post" action="{{ route('semester_details.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Department Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                         <select required data-placeholder="Select Department" class="form-control select" name="departments_id" id="departments_id">
                                            <option value="">Select Department</option>
                                            @foreach($department_db as $data)
                                            <option value="{{Qs::hash($data->id)}}">{{$data->department_name}}</option>

                                            @endforeach
                                         </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Select Semester <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Semester" class="form-control select" name="my_class_id" id="my_class_id">
                                            <option value=""></option>
                                            @foreach($semester as $c)
                                                <option {{ old('my_class_id') == $c->id ? 'selected' : '' }} value="{{ Qs::hash($c->id) }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Subject Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                         <select required data-placeholder="Select Subject" class="form-control select" name="subject_id" id="subject_id">
                                            <option value="">Select Subject</option>
                                            @foreach($subject_db as $c)
                                            <option value="{{Qs::hash($c->id) }}">{{$c->subject_name}}</option>

                                            @endforeach
                                         </select>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Teacher <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Teacher" class="form-control" name="teacher_id" id="teacher_id">
                                            <option value="">Select Teacher</option> 
                                           
                                            @foreach($teachers as $t)
                                                <option {{ old('teacher_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                            @endforeach
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

                @foreach($semester as $c)
                    <div class="tab-pane fade" id="Semester_show">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Department Name</th>
                                <th>Semester</th>
                                <th>Subject</th>
                                <th>Teacher</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                {{-- @dd($query_semester_details) --}}
                            @foreach($query_semester_details as $s)
                                <tr>
                                    {{-- @dd($s->departments->department_name) --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->departments->department_name }} </td>
                                    <td>{{ $s->semesters->name }} </td>
                                    <td>{{ $s->nsubjects->subject_name }}</td>
                                    <td>{{ $s->teacher->name }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    {{--edit--}}
                                                    @if(Qs::userIsTeamSA())
                                                        <a href="{{ route('semester_details.edit', Qs::hash($s->id)) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                    @endif
                                                    {{--Delete--}}
                                                    @if(Qs::userIsSuperAdmin())
                                                        <a id="{{ Qs::hash($s->id) }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>

                                                        <form method="post" id="item-delete-{{Qs::hash($s->id )}}" action="{{ route('semester_details.destroy', Qs::hash($s->id)) }}" class="hidden">@csrf @method('delete')</form>
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
                @endforeach
            </div>
        </div>
    </div>

    {{--subject List Ends--}}

@endsection
