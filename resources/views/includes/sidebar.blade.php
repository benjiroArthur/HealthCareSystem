<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="" alt="E - HEALTH CARE" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="fas fa-clinic-medical"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{auth()->user()->userable->image}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">Hi {{auth()->user()->userable->first_name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        @if(auth()->user()->role->name == 'out_patient')
            @include('includes.out_patient_nav')
        @elseif(auth()->user()->role->name == 'doctor')
            @include('includes.doctor_nav')
        @elseif(auth()->user()->role->name == 'pharmacy')
            @include('includes.pharmacy_nav')
        @elseif(auth()->user()->role->name == 'admin')
            @include('includes.admin_nav')
        @endif
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
