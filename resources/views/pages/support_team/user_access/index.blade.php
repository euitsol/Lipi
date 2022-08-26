@extends('layouts.master')
@section('page_title', 'Manage User Access')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage User Access</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            @if (session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif       

            <form method="post" action="{{ route('userRollCreation.store') }}">
                @csrf
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label font-weight-semibold">Name <span
                            class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <input name="name" value="{{ old('name') }}" required type="text"
                            class="form-control" placeholder="Name of User Roll">
                    </div>
                </div>

                <div class="text-right">
                    <button id="ajax-btn" type="submit" class="btn btn-primary">Submit form <i
                            class="icon-paperplane ml-2"></i></button>
                </div>
            </form>
        </div>
    </div>

    {{-- Class List Ends --}}

@endsection
