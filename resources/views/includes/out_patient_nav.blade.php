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
            <router-link to="/dashboard" class="nav-link">
                <i class="nav-icon fa fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </router-link>
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
                <li class="nav-item">
                    <router-link to="/user/chat" class="nav-link">
                        <i class="far fa-circle nav-icon green"></i>
                        <p>Doctor Name</p>
                    </router-link>
                </li>

            </ul>
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
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-notes-medical purple"></i>
                <p>
                    Medical Records
                </p>
            </a>

        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-calendar-alt purple"></i>
                <p>
                    Appointments
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                    <router-link to="/user/book-apointment" class="nav-link">
                        <i class="far fa-calendar-alt pink nav-icon"></i>
                        <p>Book Apointment</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/user/apointment" class="nav-link">
                        <i class="far fa-calendar-alt pink nav-icon"></i>
                        <p>My Apointment</p>
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

            <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>
