<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
        <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/dist/img/boxed-bg.jpg')}}" class="img-circle elevation-2" alt="User Image"
                     style="margin-top: 5px; border-radius: 50px; height: 40px; width: 40px;">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->is('home')?'active':'' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('account')||request()->is('account/*')||
                            request()->is('change-password')||request()->is('change-password/*')?'menu-open':'' }}">
                    <a href="#" class="nav-link {{ request()->is('account')||request()->is('account/*')||
                            request()->is('change-password')||request()->is('change-password/*')?'active':'' }}">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Account
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('account')||request()->is('account/*')||
                            request()->is('change-password')||request()->is('change-password/*')?'':'display: none;' }}">
                        <li class="nav-item">
                            <a href="{{route('userUpdate')}}" class="nav-link
                                {{ request()->is('account')||request()->is('account/*')?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Update Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('changePassword')}}" class="nav-link
                                {{ request()->is('change-password')||request()->is('change-password/*')?'active':'' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if(isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('sub-admin.index') }}"
                           class="nav-link {{ request()->is('sub-admin')||request()->is('sub-admin/*')?'active':'' }}">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Sub Admin
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                       class="nav-link {{ request()->is('users')||request()->is('users/*')?'active':'' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>
                @if(isAdmin())
                    <li class="nav-item has-treeview {{ request()->is('vaccine-center')||request()->is('vaccine-center/*')||
                            request()->is('vaccine-detail')||request()->is('vaccine-detail/*')?'menu-open':'' }}">
                        <a href="#" class="nav-link {{ request()->is('vaccine-center')||request()->is('vaccine-center/*')||
                            request()->is('vaccine-detail')||request()->is('vaccine-detail/*')?'active':'' }}">
                            <i class="nav-icon fas fa-shopping-bag"></i>
                            <p>
                                Vaccine
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="{{ request()->is('vaccine-center')||request()->is('vaccine-center/*')||
                            request()->is('vaccine-detail')||request()->is('vaccine-detail/*')?'':'display: none;' }}">
                            <li class="nav-item">
                                <a href="{{route('vaccine-center.index')}}" class="nav-link
                                {{ request()->is('vaccine-center')||request()->is('vaccine-center/*')?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Vaccine Centers</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('vaccine-detail.index')}}" class="nav-link
                                {{ request()->is('vaccine-detail')||request()->is('vaccine-detail/*')?'active':'' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Details and Quantities</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('alert.index') }}"
                           class="nav-link {{ request()->is('alert')||request()->is('alert/*')?'active':'' }}">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>
                                Alert and News
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
