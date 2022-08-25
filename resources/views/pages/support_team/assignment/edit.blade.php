@extends('layouts.master')
@section('page_title', 'Edit Class Room - ' . $assignment->assignment_title)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Notice</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">

                    @if (Auth::user()->user_roll != 'student')
                        {{-- class="ajax-store" --}}
                        {{-- class="ajax-update" --}}
                        <form  data-reload="#page-header" enctype="multipart/form-data" method="post"
                            action="{{ route('assignment.update', Qs::hash($assignment->id)) }}">
                            @csrf @method('PUT')

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
                                    <input name="assignment_title" value="{{$assignment->assignment_title}}" required
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
                        <form class="ajax-update" data-reload="#page-header" enctype="multipart/form-data" method="post"
                            action="{{ route('assignment.update', $data->id) }}">
                            @csrf @method('PUT')

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
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Class Edit Ends --}}

@endsection
