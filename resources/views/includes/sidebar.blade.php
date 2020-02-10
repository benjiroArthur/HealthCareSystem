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
            <div class="info">
            <a href="#" class="d-block">{{auth()->user()->role->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @include('includes.out_patient_nav')
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
