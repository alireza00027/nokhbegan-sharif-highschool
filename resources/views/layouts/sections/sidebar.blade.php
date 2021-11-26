<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="info">
                    <a href="#" class="d-block">{{auth()->user()->name}}</a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    
                    @can('managerOrAssistantOrteacher')
                        <li class="nav-item">
                            <a href="{{route('admin.dashboard')}}" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبورد
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('manager')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-users"></i>
                                <p>
                                    کاربران
                                    <i class="fa fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('register')}}" class="nav-link @if (url()->current() == route('register')) active @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            ثبت کاربر جدید
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.students.seventhList')}}" class="nav-link @if(url()->current() == route('admin.students.seventhList'))
                                        active
                                        @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            پایه هفتم
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.students.eighthList')}}" class="nav-link @if (url()->current() == route('admin.students.eighthList')) active @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            پایه هشتم
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.students.ninthList')}}" class="nav-link @if (url()->current() == route('admin.students.ninthList')) active @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            پایه نهم
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.teachers.index')}}" class="nav-link @if(url()->current() == route('admin.teachers.index'))
                                        active
                                        @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            معلمین
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.level.index')}}" class="nav-link @if (url()->current() == route('admin.level.index')) active @endif">
                                <i class="nav-icon fa fa-key"></i>
                                <p>
                                    سطح دسترسی
                                </p>
                            </a>
                        </li>
                    @endcan
                    @can('managerOrAssistant')
                        <li class="nav-item">
                            <a href="{{ route('admin.courses.index') }}" class="nav-link @if (url()->current() == route('admin.courses.index')) active @endif">
                                <i class="nav-icon fa fa-gears"></i>
                                <p>
                                    دروس
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-list-alt"></i>
                                <p>
                                    برنامه هفتگی
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.schedules.create')}}" class="nav-link @if (url()->current() == route('admin.schedules.create')) active @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            ثبت برنامه درسی
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.schedules.index')}}" class="nav-link @if(url()->current() == route('admin.schedules.index'))
                                         active
                                          @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            لیست برنامه های هفتگی
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                    @endcan
                    @can('managerOrAssistantOrteacher')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-list-alt"></i>
                                <p>
                                    آزمون صبحانه
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.exams.create')}}" class="nav-link @if (url()->current() == route('admin.exams.create')) active @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            ثبت آزمون جدید
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.exams.index')}}" class="nav-link @if(url()->current() == route('admin.exams.index'))
                                        active
                                        @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            لیست آزمون ها
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('admin.exams.chartStyle')}}" class="nav-link @if(url()->current() == route('admin.exams.chartStyle'))
                                        active
                                        @endif">
                                        <i class="fa fa-circle-o nav-icon fs1"></i>
                                        <p>
                                            تحلیل نموداری
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link @if(url()->current() == route('home'))
                            active
                            @endif">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>
                                خانه
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('financials.index')}}" class="nav-link @if (url()->current() == route('financials.index')) active @endif">
                            <i class="nav-icon fa fa-money"></i>
                            <p>
                                حساب های مالی من
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('schedules.index')}}" class="nav-link @if (url()->current() == route('schedules.index')) active @endif">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>
                                برنامه های هفتگی من
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('exams.index')}}" class="nav-link @if (url()->current() == route('exams.index')) active @endif">
                            <i class="nav-icon fa fa-list-alt"></i>
                            <p>
                                آزمون های صبحانه من
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="$('#form-logout').submit()">
                            <i class="nav-icon fa fa-power-off"></i>
                            <p>
                                خروج
                            </p>
                        </a>
                        <form id="form-logout" action="{{route('logout')}}" method="post" style="display: none">
                            {{csrf_field()}}
                            <div class="nav-link">
                                <button type="submit"><i class="nav-icon fa fa-power-off">خروج</i></button>
                            </div>
                        </form>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>