@extends('layouts.master')
@section('page_title', 'Manage Deparments')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Deparment</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-classes" class="nav-link active" data-toggle="tab">Deparment</a></li>
                <li class="nav-item"><a href="#new-class" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Create New Deparment</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-classes">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Short Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($department_db as $c)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $c->department_name }}</td>
                                    <td>{{ $c->short_name }}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    @if(Qs::userIsTeamSA())
                                                    {{--Edit--}}
                                                    <a href="{{ route('departments.edit', $c->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                   @endif
                                                        @if(Qs::userIsSuperAdmin())
                                                    {{--Delete--}}
                                                    <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="post" id="item-delete-{{ $c->id }}" action="{{ route('departments.destroy', $c->id) }}" class="hidden">@csrf @method('delete')</form>
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

                                <span>When a Deparment is created, a Section will be automatically created for the Deparment, you can edit it or add more sections to the Deparment at <a target="_blank" href="{{ route('sections.index') }}">Manage Sections</a></span>
                            </div>
                        </div>
                    </div>

                    <div Semester="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('departments.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Department Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" placeholder="Name of Deparment">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="slug" class="col-lg-3 col-form-label font-weight-semibold">Short Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="slug" required name="short_name" value="{{ old('short_name') }}" type="text" class="form-control" placeholder="Eg. B.Eng">
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Class List Ends--}}

@endsection
