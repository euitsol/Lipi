@extends('layouts.master')
@section('page_title', 'Edit Semester Details')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            {{-- @dd($query_semester_details) --}}
            <h6 class="card-title">Edit Subject - {{$query_semester_details->semesters->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @if(session()->has('msg'))
            <div class="alert alert-success">
                {{session()->get('msg')}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    {{-- @dd($query_semester_details) --}}
                    <form class="ajax-update" method="post" action="{{ route('semester_details.update', Qs::hash($query_semester_details->id)) }}">
                        @csrf @method('PUT')
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
    </div>

    {{--subject Edit Ends--}}

@endsection
