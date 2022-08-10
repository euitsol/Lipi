{{-- Extract master here  --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="CJ Inspired">

    <title> @yield('page_title') | {{ config('app.name') }} </title>


    @include('partials.inc_top')
</head>

<body class="{{ in_array(Route::currentRouteName(), ['payments.invoice', 'marks.tabulation', 'marks.show', 'ttr.manage', 'ttr.show']) ? 'sidebar-xs' : '' }}">

    {{-- Extract top menu here  --}}
    <div class="navbar navbar-expand-md navbar-dark">
        <div class="mt-2 mr-5">
            <a href="{{ route('dashboard') }}" class="d-inline-block">
            <h4 class="text-bold text-white">{{ Qs::getSystemName() }}</h4>
            </a>
        </div>
      {{--  <div class="navbar-brand">
            <a href="index.html" class="d-inline-block">
                <img src="{{ asset('global_assets/images/logo_light.png') }}" alt="">
            </a>
        </div>--}}

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
                <i class="icon-tree5"></i>
            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="icon-paragraph-justify3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                        <i class="icon-paragraph-justify3"></i>
                    </a>
                </li>


            </ul>

                <span class="navbar-text ml-md-3 mr-md-auto"></span>

            <ul class="navbar-nav">

                <li class="nav-item dropdown dropdown-user">
                    {{-- <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                        <img style="width: 38px; height:38px;" src="{{ Auth::user()->photo }}" class="rounded-circle" alt="photo">
                        <span>{{ Auth::user()->name }}</span>
                    </a> --}}

                    {{-- <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ Qs::userIsStudent() ? route('students.show', Qs::hash(Qs::findStudentRecord(Auth::user()->id)->id)) : route('users.show', Qs::hash(Auth::user()->id)) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div> --}}
                </li>
            </ul>
        </div>
    </div>

{{-- End extracting top manu from here  --}}
{{-- @include('partials.top_menu') --}}
<div class="page-content">
    {{-- @include('partials.menu') --}}
    <div class="content-wrapper">

        {{-- Extracting  header  --}}
        <div id="page-header" class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">@yield('page_title')</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="d-flex justify-content-center">
           {{--             <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                        <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>--}}
                        {{-- <a href="{{ Qs::userIsSuperAdmin() ? route('settings') : '' }}" class="btn btn-link btn-float text-default"><i class="icon-arrow-down7 text-primary"></i> <span class="font-weight-semibold">Current Session: {{ Qs::getSetting('current_session') }}</span></a> --}}
                    </div>
                </div>
            </div>

            {{--Breadcrumbs--}}
            {{--<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                        <a href="form_select2.html" class="breadcrumb-item">Forms</a>
                        <span class="breadcrumb-item active">Select2 selects</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements d-none">
                    <div class="breadcrumb justify-content-center">
                        <a href="#" class="breadcrumb-elements-item">
                            <i class="icon-comment-discussion mr-2"></i>
                            Support
                        </a>

                        <div class="breadcrumb-elements-item dropdown p-0">
                            <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-gear mr-2"></i>
                                Settings
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                                <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                                <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    {{-- End extracting header  --}}
        {{-- @include('partials.header') --}}

        <div class="content">
            {{--Error Alert Area--}}
            @if($errors->any())
                <div class="alert alert-danger border-0 alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                        @foreach($errors->all() as $er)
                            <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                        @endforeach

                </div>
            @endif
            <div id="ajax-alert" style="display: none"></div>


{{-- extracting content here  --}}
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Please fill The form Below To Admit A New Student</h6>

                    {!! Qs::getPanelOptions() !!}
                </div>

                <form id="ajax-reg" method="post" enctype="multipart/form-data" class="wizard-form steps-validation" action="{{ route('admission.store') }}" data-fouc>
                   @csrf
                    <h6>Personal data</h6>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Name: <span class="text-danger">*</span></label>
                                    <input value="{{ old('name') }}" required type="text" name="name" placeholder="Full Name" class="form-control">
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address: <span class="text-danger">*</span></label>
                                    <input value="{{ old('address') }}" class="form-control" placeholder="Address" name="address" type="text" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Email address: </label>
                                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">Gender: <span class="text-danger">*</span></label>
                                    <select class="select form-control" id="gender" name="gender" required data-fouc data-placeholder="Choose..">
                                        <option value=""></option>
                                        <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option>
                                        <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Phone:</label>
                                    <input value="{{ old('phone') }}" type="text" name="phone" class="form-control" placeholder="" >
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Telephone:</label>
                                    <input value="{{ old('phone2') }}" type="text" name="phone2" class="form-control" placeholder="" >
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date of Birth:</label>
                                    <input name="dob" value="{{ old('dob') }}" type="text" class="form-control date-pick" placeholder="Select Date...">

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">Nationality: <span class="text-danger">*</span></label>
                                    <select data-placeholder="Choose..." required name="nal_id" id="nal_id" class="select-search form-control">
                                        <option value=""></option>
                                        @foreach($nationals as $nal)
                                            <option {{ (old('nal_id') == $nal->id ? 'selected' : '') }} value="{{ $nal->id }}">{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="state_id">State: <span class="text-danger">*</span></label>
                                <select onchange="getLGA(this.value)" required data-placeholder="Choose.." class="select-search form-control" name="state_id" id="state_id">
                                    <option value=""></option>
                                    @foreach($states as $st)
                                        <option {{ (old('state_id') == $st->id ? 'selected' : '') }} value="{{ $st->id }}">{{ $st->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label for="lga_id">LGA: <span class="text-danger">*</span></label>
                                <select required data-placeholder="Select State First" class="select-search form-control" name="lga_id" id="lga_id">
                                    <option value=""></option>
                                </select>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bg_id">Blood Group: </label>
                                    <select class="select form-control" id="bg_id" name="bg_id" data-fouc data-placeholder="Choose..">
                                        <option value=""></option>
                                        @foreach(App\Models\BloodGroup::all() as $bg)
                                            <option {{ (old('bg_id') == $bg->id ? 'selected' : '') }} value="{{ $bg->id }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="d-block">Upload Passport Photo:</label>
                                    <input value="{{ old('photo') }}" accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
                                    <span class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <h6>Student Data</h6>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my_class_id">Class: <span class="text-danger">*</span></label>
                                    <select onchange="getClassSections(this.value)" data-placeholder="Choose..." required name="my_class_id" id="my_class_id" class="select-search form-control">
                                        <option value=""></option>
                                        @foreach($my_classes as $c)
                                            <option {{ (old('my_class_id') == $c->id ? 'selected' : '') }} value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                    </select>
                            </div>
                                </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="section_id">Section: <span class="text-danger">*</span></label>
                                    <select data-placeholder="Select Class First" required name="section_id" id="section_id" class="select-search form-control">
                                        <option {{ (old('section_id')) ? 'selected' : '' }} value="{{ old('section_id') }}">{{ (old('section_id')) ? 'Selected' : '' }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="my_parent_id">Parent: </label>
                                    <select data-placeholder="Choose..."  name="my_parent_id" id="my_parent_id" class="select-search form-control">
                                        <option  value=""></option>
                                        @foreach($parents as $p)
                                            <option {{ (old('my_parent_id') == Qs::hash($p->id)) ? 'selected' : '' }} value="{{ Qs::hash($p->id) }}">{{ $p->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="year_admitted">Year Admitted: <span class="text-danger">*</span></label>
                                    <select data-placeholder="Choose..." required name="year_admitted" id="year_admitted" class="select-search form-control">
                                        <option value=""></option>
                                        @for($y=date('Y', strtotime('- 10 years')); $y<=date('Y'); $y++)
                                            <option {{ (old('year_admitted') == $y) ? 'selected' : '' }} value="{{ $y }}">{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="dorm_id">Dormitory: </label>
                                <select data-placeholder="Choose..."  name="dorm_id" id="dorm_id" class="select-search form-control">
                                    <option value=""></option>
                                    @foreach($dorms as $d)
                                        <option {{ (old('dorm_id') == $d->id) ? 'selected' : '' }} value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                </select>

                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Dormitory Room No:</label>
                                    <input type="text" name="dorm_room_no" placeholder="Dormitory Room No" class="form-control" value="{{ old('dorm_room_no') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sport House:</label>
                                    <input type="text" name="house" placeholder="Sport House" class="form-control" value="{{ old('house') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Admission Number:</label>
                                    <input type="text" name="adm_no" placeholder="Admission Number" class="form-control" value="{{ old('adm_no') }}">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
            </div>

            {{-- End extracting  --}}
            {{-- @yield('content') --}}




        </div>


    </div>
</div>

@include('partials.inc_bottom')
@yield('scripts')
</body>
</html>
{{-- @extends('layouts.master') --}}
{{-- End extracting master  --}}

@section('page_title', 'Admit Student')

{{-- @section('content')

@endsection --}}
