<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="HealthCareSystem" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="fas fa-clinic-medical"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/user.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            {{--<div class="info">--}}
            {{--<a href="#" class="d-block">{{auth()->user()->role->name}}</a>--}}
            {{--</div>--}}
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{url('/home')}}" class="nav-link" onclick="showContent();">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                {{--//for admins only--}}
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical purple"></i>
                        <p>
                            Manage Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/admin/upcoming-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Administrators</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/past-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Doctors</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/past-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Pharmacy</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/past-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Out Patient</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-facebook-messenger cyan"></i>
                        <p>
                            Chat
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" onclick="hideContent();">
                            <router-link to="/user/chat" class="nav-link">
                                <i class="far fa-circle nav-icon green"></i>
                                <p>Doctor Name</p>
                            </router-link>
                        </li>

                    </ul>
                </li>
                <li class="nav-item" onclick="hideContent();">
                    <router-link to="/user/profile" class="nav-link">
                        <i class="nav-icon fas fa-user-circle orange"></i>
                        <p>
                            Profile

                        </p>
                    </router-link>
                </li>
                <li class="nav-item" onclick="hideContent();">
                    <router-link to="/user/doctors" class="nav-link">
                        <i class="nav-icon fas fa-user-nurse teal"></i>
                        <p>
                            Doctors

                        </p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical purple"></i>
                        <p>
                            Medical Records
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{--//for patients only--}}
                        <li class="nav-item" onclick="hideContent();">
                            <router-link to="/user/medical-records" class="nav-link">
                                <i class="fas fa-file-medical pink nav-icon"></i>
                                <p>My Medical Records</p>
                            </router-link>
                        </li>
                        {{--//for doctors only--}}
                        <li class="nav-item" onclick="hideContent();">
                            <router-link to="/user/medical-records" class="nav-link">
                                <i class="fas fa-file-medical pink nav-icon"></i>
                                <p>Create New Records</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" onclick="hideContent();">
                    <router-link to="/user/medical-records" class="nav-link">
                        <i class="nav-icon fas fa-file-medical pink"></i>
                        <p>
                            Medical Records

                        </p>
                    </router-link>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical purple"></i>
                        <p>
                            Appointments
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" onclick="hideContent();">
                            <router-link to="/user/upcoming-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Upcoming Appointments</p>
                            </router-link>
                        </li>
                        <li class="nav-item" onclick="hideContent();">
                            <router-link to="/user/past-appointment" class="nav-link">
                                <i class="far fa-circle nav-icon indigo"></i>
                                <p>Past Appointments</p>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off nav-icon red"></i>
                        <p>
                            {{ __('Logout') }}
                        </p>
                    </a>

                    <form id="logout-form" action="{{ route('user.logout') }}" method="GET" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
