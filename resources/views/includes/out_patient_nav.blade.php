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
            <router-link to="/user/chat" class="nav-link">
                <i class="far fa-circle nav-icon green"></i>
                <p>Doctor Name</p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/user/profile" class="nav-link">
                <i class="nav-icon fas fa-user-circle orange"></i>
                <p>
                    Profile

                </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/user/doctors" class="nav-link">
                <i class="nav-icon fas fa-user-nurse teal"></i>
                <p>
                    Doctors

                </p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/user/medical-records" class="nav-link">
                <i class="nav-icon fas fa-notes-medical purple"></i>
                <p>
                    Medical Records
                </p>
            </router-link>

        </li>

        <li class="nav-item">
            <router-link to="/user/my-appointment" class="nav-link">
                <i class="far fa-calendar-alt pink nav-icon"></i>
                <p>My Appointments</p>
            </router-link>
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
