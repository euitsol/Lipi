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
                <table class="table datatable-button-html5-columns">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Division</th>
                            <th>Exam Name</th>
                            <th>Passing Year</th>
                            <th>Board</th>
                            <th>Roll</th>
                            <th>Registration No.</th>
                            <th>Registration Card</th>
                            <th>Marksheet</th>
                            <th>photo</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($student_list) --}}
                        @foreach ($promotion_list as $s)
                            {{-- @dd($s) --}}

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- <td><img class="rounded-circle" style="height: 40px; width: 40px;"
                                        src="{{ $s-photo }}" alt="photo"></td> --}}
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->phone }}</td>
                                <td>{{ $s->division }}</td>
                                <td>{{ $s->exam_name }}</td>
                                <td>{{ $s->passing_year }}</td>
                                <td>{{ $s->board }}</td>
                                <td>{{ $s->roll }}</td>
                                <td>{{ $s->registration_no }}</td>
                                <td>
                                    <a target="_nobir" href="{{ $s->reg_card }}">
                                        {{ $s->reg_card }}
                                    </a>
                                </td>
                                <td>
                                    <a target="_nobir" href="{{ $s->marksheet }}">
                                        {{ $s->marksheet }}
                                    </a>
                                </td>
                                <td>
                                    <a target="_nobir" href="{{ $s->marksheet }}">
                                        {{ $s->photo }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <div class="list-icons">
                                        <div class="dropdown">
                                            <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                <i class="icon-menu9"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-left">

                                                @if (Qs::UserAccess()[0]->edit == 'yes')
                                                    {{-- <a id="{{ Qs::hash($s->user_id) }}" onclick="confirmDelete(this.id)"
                                                        href="#" class="dropdown-item"><i class="icon-trash"></i>
                                                        Aprove
                                                    </a>

                                                    <a id="{{ Qs::hash($s->user_id) }}" value='' onclick="return confirm('Are you sure??')"
                                                        href="#" class="dropdown-item"><i class="icon-trash"></i>
                                                        Decline
                                                    </a> --}}

                                                    {{-- , Qs::hash($s->user_id) --}}
                                                    <form method="post" class="dropdown-item"
                                                        action="{{ url('Admission_std_promotion') }}">

                                                        @csrf
                                                        @method('PUT')
                                                        <input name="id" type="text"
                                                            value=" {{ Qs::hash($s->id) }}" hidden>
                                                        <input name="name" type="text"
                                                            value=" {{ $s->name }}" hidden>

                                                        <button name="status" value="aprove"
                                                            class="dropdown-item">Aprove</button>
                                                    </form>

                                                    <form method="post" class="dropdown-item"
                                                        action="{{ url('Admission_std_promotion') }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <input name="id" type="text"
                                                            value=" {{ Qs::hash($s->id) }}" hidden>
                                                            <input name="name" type="text"
                                                            value=" {{ $s->name }}" hidden>
                                                        <button name="status" value="decline"
                                                            class="dropdown-item">Decline</button>
                                                    </form>
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
