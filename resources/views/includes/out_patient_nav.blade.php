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
            <router-link to="/chat" class="nav-link">
                <i class="far fa-comments nav-icon green"></i>
                <p>Chat</p>
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
            <router-link to="/user/pharmacy" class="nav-link">
                <i class="nav-icon fas fa-tablets teal"></i>
                <p>
                    Pharmacy

                </p>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link to="/user/medical-records" class="nav-link">
                <i class="nav-icon fas fa-notes-medical pink"></i>
                <p>
                    Medical Records
                </p>
            </router-link>
        </li>
        <li class="nav-item">
                    <router-link to="/user/prescription" class="nav-link">
                        <i class="nav-icon fas fa-capsules orange"></i>
                        <p>
                            My Prescriptions
                        </p>
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
            <router-link to="/password/update" class="nav-link">
                <i class="nav-icon fas fa-lock yellow"></i>
                <p>
                    Password Update

                </p>
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
