@extends('layouts.master')
@section('page_title', 'Edit Class Room - ' . $assignment->assignment_title)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Assignment</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

                    @if (Auth::user()->user_roll != 'student')
                        {{-- class="ajax-store" --}}
                        {{-- class="ajax-update" --}}
                        <form data-reload="#page-header" enctype="multipart/form-data" method="post"
                            action="{{ route('assignment.update', Qs::hash($assignment->id)) }}">
                            @csrf @method('PUT')

                            {{-- <div class="form-group row">
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
                                    <input name="assignment_title" value="{{ $assignment->assignment_title }}" required
                                        type="text" class="form-control" placeholder="Assignment Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Assignment file:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="assignment_file" value="{{ old('assignment_file') }}" accept=".pdf"
                                        required type="file" class="form-control" placeholder="Assignment file">
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Select
                                    Semester <span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <select required data-placeholder="Select Semester" class="form-control select"
                                        name="semester_name" id="semester_name">
                                        <option value=""></option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $assignment->semester_name }}">
                                                {{ $assignment->semester_name }}</option> }}</option>
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
                                        <option value="{{ $assignment->group }}">{{ $assignment->group }}</option>
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
                                    <input name="assignment_title" value="{{ $assignment->assignment_title }}" required
                                        type="text" class="form-control" placeholder="Assignment Title">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Assignment
                                    file:<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="assignment_given_file" value="{{ $assignment->assignment_given_file }}"
                                        accept=".pdf" required type="file" class="form-control"
                                        placeholder="Assignment file">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Start Date:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="start_date" value="{{ $assignment->start_date }}" required type="date"
                                        class="form-control" placeholder="Start Date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">End Date:<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="end_date" value="{{ $assignment->end_date }}" required type="date"
                                        class="form-control" placeholder="End Date">
                                </div>
                            </div>
                            <div class="text-right">
                                <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i
                                        class="icon-paperplane ml-2"></i></button>
                            </div>
                        </form>
                    @endif


                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Class Edit Ends --}}

@endsection
