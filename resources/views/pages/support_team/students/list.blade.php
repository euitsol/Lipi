@extends('layouts.master')
@section('page_title', 'Student Information - ' . $semester->semtester_name)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Students List</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-students" class="nav-link active" data-toggle="tab">All
                        {{ $semester->Semester_name }} Students</a></li>
                {{-- <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Sections</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($sections as $s)
                            <a href="#s{{ $s->id }}" class="dropdown-item" data-toggle="tab">{{ $my_class->name.' '.$s->name }}</a>
                        @endforeach
                    </div>
                </li> --}}
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all-students">
                    <table class="table datatable-button-html5-columns">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Student ID</th>
                                <th>Section</th>
                                <th>Email</th>
                                <th>photo</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($student_list) --}}
                            @foreach ($student_list as $s)
                                {{-- @dd($s) --}}

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- <td><img class="rounded-circle" style="height: 40px; width: 40px;"
                                            src="{{ $s-photo }}" alt="photo"></td> --}}
                                    <td>{{ $s->name }}</td>
                                    <td>{{ $s->user_id }}</td>
                                    <td>{{ $s->group_name }}</td>
                                    <td>{{ $s->phone }}</td>
                                    <td>{{ $s->photo }}</td>
                                    {{-- <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    <a href="{{ route('students.show', Qs::hash($s->id)) }}"
                                                        class="dropdown-item"><i class="icon-eye"></i> View Profile</a>
                                                    @if (Qs::userIsTeamSA())
                                                        <a href="{{ route('students.edit', Qs::hash($s->id)) }}"
                                                            class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <a href="{{ route('st.reset_pass', Qs::hash($s->user_id)) }}"
                                                            class="dropdown-item"><i class="icon-lock"></i> Reset
                                                            password</a>
                                                    @endif
                                                    <a target="_blank"
                                                        href="{{ route('marks.year_selector', Qs::hash($s->user_id)) }}"
                                                        class="dropdown-item"><i class="icon-check"></i> Marksheet</a> --}}

                                    {{-- Delete --}}
                                    {{-- @if (Qs::userIsSuperAdmin())
                                                        <a id="{{ Qs::hash($s->user_id) }}"
                                                            onclick="confirmDelete(this.id)" href="#"
                                                            class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ Qs::hash($s->user_id) }}"
                                                            action="{{ route('students.destroy', Qs::hash($s->user_id)) }}"
                                                            class="hidden">@csrf @method('delete')</form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

    {{-- Student List Ends --}}

@endsection
