@extends('layouts.master')
@section('page_title', 'Student Promotion')
@section('content')

    <div class="card">
        {{-- <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">Student Promotion From <span class="text-danger">{{ $old_year }}</span> TO <span class="text-success">{{ $new_year }}</span> Session</h5>
            {!! Qs::getPanelOptions() !!}
        </div> --}}

        <div class="card-body">
            {{-- @include('pages.support_team.students.promotion.selector') --}}
        </div>
        <div class="tab-content">
            @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif
            <div class="tab-pane fade show active" id="all-students">
                <div class="tab-pane fade show active" id="all-students">
                    <form method="post" action="{{ route('students.Admission_std_assign') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department_id">Department Name: </label>
                                    <select class="select form-control" id="department_id" name="department_id" data-fouc
                                        data-placeholder="Choose..">
                                        <option value="{{ Qs::hash($update->departments_id) }}">
                                            {{ $update->departments->department_name }}</option>
                                        {{-- @foreach (App\Models\departmentModel::all() as $d)
                                    <option value="{{ $d->id }}">{{ $d->department_name }}</option>
                                @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="semester_id">Semester Name: </label>
                                    <select class="select form-control" id="semester_id" name="semester_id" data-fouc
                                        data-placeholder="Choose..">
                                        <option value=""></option>
                                        @foreach (App\Models\semester::all() as $s)
                                            <option value="{{ Qs::hash($s->id) }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_id">Group Name: </label>
                                    <select class="select form-control" id="section_id" name="section_id" data-fouc
                                        data-placeholder="Choose..">
                                        <option value=""></option>
                                        @foreach (App\Models\Section::all() as $s)
                                            <option value="{{ Qs::hash($s->id) }}">{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_start">Session Start: </label>
                                    <input name="session_start" value="{{ old('session_start') }}" required type="date"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="session_end">Session End: </label>
                                    <input name="session_end" value="{{ old('session_end') }}" required type="date"
                                        class="form-control">
                                </div>
                            </div>

                            <input type="text" name="id" value="{{ Qs::hash($id) }}" hidden>
                            <input type="text" name="update" value="{{ $update }}" hidden>

                            <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-primary">Save <i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- @if ($selected) --}}
    {{-- <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title font-weight-bold">Promote Students From <span class="text-teal">{{ $my_classes->where('id', $fc)->first()->name.' '.$sections->where('id', $fs)->first()->name }}</span> TO <span class="text-purple">{{ $my_classes->where('id', $tc)->first()->name.' '.$sections->where('id', $ts)->first()->name }}</span> </h5>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @include('pages.support_team.students.promotion.promote')
        </div>
    </div> --}}
    {{-- @endif --}}


    {{-- Student Promotion End --}}

@endsection
