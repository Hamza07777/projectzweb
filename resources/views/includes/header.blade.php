<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>

    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
          <form action="{{route('logout')}}" method="post" id="logout_form">
              @csrf
              <a class="nav-link" href="javascript:void(0)" onclick="document.getElementById('logout_form').submit()">
                  Logout
                  <i class="fa-sign-out"></i>
              </a>
          </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
