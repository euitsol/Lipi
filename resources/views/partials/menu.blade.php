<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        {{-- <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38" class="rounded-circle" alt="photo"></a> --}}
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i>
                            &nbsp;{{ ucwords(str_replace('_', ' ', Auth::user()->user_roll)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Academics --}}
                @if (Qs::UserAccess()[0]->assignment == 'yes')
                    {{-- Manage Assignments --}}
                    <li class="nav-item">
                        <a href="{{ route('assignment.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['assignment.index', 'assignment.edit']) ? 'active' : '' }}"><i
                                class="icon-windows2"></i> <span> Assignment</span></a>
                    </li>
                @endif

                {{-- Administrative --}}
                @if (Qs::userIsAdministrative())
                    <li
                        class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.show']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> Administrative</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Administrative">

                            {{-- Payments --}}
                            @if (Qs::userIsTeamAccount())
                                <li
                                    class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">

                                    <a href="#"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">Payments</a>

                                    <ul class="nav nav-group-sub">
                                        <li class="nav-item"><a href="{{ route('payments.create') }}"
                                                class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">Create
                                                Payment</a></li>
                                        <li class="nav-item"><a href="{{ route('payments.index') }}"
                                                class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.show']) ? 'active' : '' }}">Manage
                                                Payments</a></li>
                                        <li class="nav-item"><a href="{{ route('payments.manage') }}"
                                                class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">Student
                                                Payments</a></li>

                                    </ul>

                                </li>
                            @endif
                        </ul>
                    </li>
                @endif


                @if (Qs::UserAccess()[0]->teacher == 'yes')
                    {{-- Manage Teachers --}}
                    <li class="nav-item">
                        <a href="{{ route('teachers.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['teachers.index', 'teachers.show', 'teachers.edit']) ? 'active' : '' }}"><i
                                class="icon-users4"></i> <span> Teachers</span></a>
                    </li>
                @endif
                {{-- Manage Students --}}
                <li
                    class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    {{-- <a href="#" class="nav-link"><i class="icon-users"></i> <span> Students</span></a> --}}

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        {{-- Admit Student --}}
                        @if (Qs::userIsTeamSA())
                            <li class="nav-item">
                                <a href="{{ route('students.create') }}"
                                    class="nav-link {{ Route::is('students.create') ? 'active' : '' }}">Admit
                                    Student</a>
                            </li>
                        @endif

                        {{-- Student Information --}}
                        <li
                            class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'nav-item-expanded' : '' }}">
                            <a href="#"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'active' : '' }}">Student
                                Information</a>
                            <ul class="nav nav-group-sub">
                                @foreach (App\Models\MyClass::orderBy('name')->get() as $c)
                                    <li class="nav-item"><a href="{{ route('students.list', $c->id) }}"
                                            class="nav-link ">{{ $c->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        @if (Qs::userIsTeamSA())
                            {{-- Student Promotion --}}
                            <li
                                class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}">
                                <a href="#"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'active' : '' }}">Student
                                    Promotion</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('students.promotion') }}"
                                            class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion']) ? 'active' : '' }}">Promote
                                            Students</a></li>
                                    <li class="nav-item"><a href="{{ route('students.promotion_manage') }}"
                                            class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion_manage']) ? 'active' : '' }}">Manage
                                            Promotions</a></li>
                                </ul>

                            </li>

                            {{-- Student Graduated --}}
                            <li class="nav-item"><a href="{{ route('students.graduated') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated']) ? 'active' : '' }}">Students
                                    Graduated</a></li>
                        @endif

                    </ul>
                </li>
                {{-- @endif --}}

                {{-- * User Managment Details --}}
                @if (Qs::UserAccess()[0]->user == 'yes')
                    <li
                        class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['userCreation.index', 'userRollCreation.index', 'userCreation.create', 'userCreation.invoice', 'userCreation.receipts', 'userCreation.edit', 'userCreation.manage', 'userCreation.show']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> user</span></a>

                        <ul class="nav nav-group-sub">
                            <li class="nav-item"><a href="{{ route('userRollCreation.index') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['userRollCreation.index', 'userRollCreation.edit', 'userRollCreation.show']) ? 'active' : '' }}">Create
                                    User
                                    Roll
                                </a></li>

                            <li class="nav-item"><a href="{{ route('userCreation.index') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['userCreation.index', 'userCreation.edit', 'userCreation.show']) ? 'active' : '' }}">User
                                    Id Assign
                                </a></li>

                            <li class="nav-item"><a href="{{ route('userCreation.index') }}"
                                    class="nav-link {{ in_array(Route::currentRouteName(), ['userCreation.index', 'userCreation.edit', 'userCreation.show']) ? 'active' : '' }}">User
                                    Access Managment
                                </a></li>
                        </ul>


                    </li>
                @endif
                {{-- * End User Managment Details --}}


                {{-- Manage Deparment --}}
                @if (Qs::UserAccess()[0]->deparment == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('departments.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['departments.index', 'departments.edit']) ? 'active' : '' }}"><i
                                class="icon-windows2"></i> <span> Department</span></a>
                    </li>
                @endif


                {{-- Manage Semester --}}
                @if (Qs::UserAccess()[0]->semester == 'yes')
                    <li class="nav-item">
                        {{-- write semester instead --}}
                        <a href="{{ route('semester.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['semester.index', 'semester.edit']) ? 'active' : '' }}"><i
                                class="icon-windows2"></i> <span> Semester</span></a>
                    </li>
                @endif


                {{-- Manage Subjects --}}
                @if (Qs::UserAccess()[0]->semester_details == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('semester_details.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['semester_details.index', 'semester_details.edit']) ? 'active' : '' }}"><i
                                class="icon-windows2"></i> <span> Semester Details</span></a>
                    </li>
                @endif


                {{-- Manage Routine --}}
                @if (Qs::UserAccess()[0]->routine == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('routine.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['routine.index', 'routine.edit']) ? 'active' : '' }}"><i
                                class="icon-windows2"></i> <span> Routine</span></a>
                    </li>
                @endif


                {{-- Manage Class Room --}}
                @if (Qs::UserAccess()[0]->class_room == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('classRoom.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['classRoom.index', 'classRoom.edit']) ? 'active' : '' }}"><i
                                class="icon-home9"></i> <span> Class Room</span></a>
                    </li>
                @endif


                {{-- Manage Notice --}}
                @if (Qs::UserAccess()[0]->notice == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('notice.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['notice.index', 'notice.edit']) ? 'active' : '' }}"><i
                                class="icon-home9"></i> <span> Notice</span></a>
                    </li>
                @endif


                {{-- Manage Dorms --}}
                {{-- @if (Qs::UserAccess()[0]->dorm == 'yes') --}}
                <li class="nav-item">
                    {{-- <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> Dormitories</span></a> --}}
                </li>

                {{-- Manage Sections --}}
                @if (Qs::UserAccess()[0]->section == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('sections.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index', 'sections.edit']) ? 'active' : '' }}"><i
                                class="icon-fence"></i> <span>Group</span></a>
                    </li>
                @endif



                {{-- Manage Subject --}}
                @if (Qs::UserAccess()[0]->subject == 'yes')
                    <li class="nav-item">
                        <a href="{{ route('nameSubjects.index') }}"
                            class="nav-link {{ in_array(Route::currentRouteName(), ['nameSubjects.index', 'nameSubjects.edit']) ? 'active' : '' }}"><i
                                class="icon-pin"></i> <span>Subjects</span></a>
                    </li>
                @endif


                {{-- Exam --}}
                @if (Qs::UserAccess()[0]->exam == 'yes')
                    <li
                        class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-books"></i> <span> Exams</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Exams">
                            @if (Qs::userIsTeamSA())
                                {{-- Exam list --}}
                                <li class="nav-item">
                                    <a href="{{ route('exams.index') }}"
                                        class="nav-link {{ Route::is('exams.index') ? 'active' : '' }}">Exam
                                        List</a>
                                </li>

                                {{-- Grades list --}}
                                <li class="nav-item">
                                    <a href="{{ route('grades.index') }}"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['grades.index', 'grades.edit']) ? 'active' : '' }}">Grades</a>
                                </li>

                                {{-- Tabulation Sheet --}}
                                <li class="nav-item">
                                    <a href="{{ route('marks.tabulation') }}"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">Tabulation
                                        Sheet</a>
                                </li>

                                {{-- Marks Batch Fix --}}
                                <li class="nav-item">
                                    <a href="{{ route('marks.batch_fix') }}"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['marks.batch_fix']) ? 'active' : '' }}">Batch
                                        Fix</a>
                                </li>
                            @endif

                            @if (Qs::userIsTeamSAT())
                                {{-- Marks Manage --}}
                                <li class="nav-item">
                                    <a href="{{ route('marks.index') }}"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">Marks</a>
                                </li>

                                {{-- Marksheet --}}
                                <li class="nav-item">
                                    <a href="{{ route('marks.bulk') }}"
                                        class="nav-link {{ in_array(Route::currentRouteName(), ['marks.bulk', 'marks.show']) ? 'active' : '' }}">Marksheet</a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif


                {{-- End Exam --}}

                @include('pages.' . Qs::getUserType() . '.menu')

                {{-- Manage Account --}}
                <li class="nav-item">
                    <a href="{{ route('my_account') }}"
                        class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i
                            class="icon-user"></i> <span>My Account</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>
