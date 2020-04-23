<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
            <router-link to="/home" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    Home
                </p>
            </router-link>
        </li>
         <li class="nav-item">
                    <router-link to="/doctor/dashboard" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>

        <li class="nav-item">
            <router-link to="/chat" class="nav-link">
                <i class="far fa-comments nav-icon green"></i>
                <p>Chat</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/doctor/profile" class="nav-link">
                <i class="nav-icon fas fa-user-circle orange"></i>
                <p>
                    Profile

                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/doctor/prescription" class="nav-link">
                <i class="nav-icon fas fa-capsules orange"></i>
                <p>
                    Prescription

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

                <li class="nav-item">
                    <router-link to="/user/medical-records" class="nav-link">
                        <i class="fas fa-file-medical pink nav-icon"></i>
                        <p>Veiw Medical Records</p>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/user/medical-records" class="nav-link">
                        <i class="fas fa-file-medical pink nav-icon"></i>
                        <p>Create New Records</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-checkl purple"></i>
                <p>
                    Appointments
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <router-link to="/doctor/upcoming-appointment" class="nav-link">
                        <i class="far fa-calendar-check nav-icon indigo"></i>
                        <p>Upcoming Appointments</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/doctor/past-appointment" class="nav-link">
                        <i class="far fa-calendar-check nav-icon indigo"></i>
                        <p>Past Appointments</p>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <i class="fas fa-power-off nav-icon red"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
