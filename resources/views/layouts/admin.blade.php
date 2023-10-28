<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{asset('contens/admin')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('contens/admin')}}/css/all.min.css">
    <link rel="stylesheet" href="{{asset('contens/admin')}}/css/datatables.min.css">
    <link rel="stylesheet" href="{{asset('contens/admin')}}/css/datepicker.css">
    <link rel="stylesheet" href="{{asset('contens/admin')}}/css/style.css">

  </head>
  <body>
    <header>
        <div class="container-fluid header_part">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-7"></div>
                <div class="col-md-3 top_right_menu text-end">
                    <div class="dropdown">
                      <button class="btn dropdown-toggle top_right_btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="images/avatar.png" class="img-fluid">
                          Saidul Islam Uzzal
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-tie"></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Manage Account</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                      </ul>
                    </div>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </header>
    <section>
        <div class="container-fluid content_part">
            <div class="row">
                <div class="col-md-2 sidebar_part">
                    <div class="user_part">
                        <img class="" src="images/avatar.png" alt="avatar"/>
                        <h5>Saidul Islam Uzzal</h5>
                        <p><i class="fas fa-circle"></i> Online</p>
                    </div>
                    <div class="menu">
                        <ul>
                            <li><a href="{{url('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a></li>
                            <li><a href="{{url('dashboard/user')}}"><i class="fas fa-user-circle"></i> Users</a></li>
                            <li><a href="{{url('dashboard/income/category')}}"><i class="fas fa-user-circle"></i>Income Category</a></li>
                            <li><a href="#"><i class="fas fa-images"></i> Banner</a></li>
                            <li><a href="{{url('dashboard/income/category/recycle')}}"><i class="fas fa-trash"></i>Income Recycle Bin</a></li>
                            <li><a href="#"><i class="fas fa-comments"></i> Contact Message</a></li>
                            <li><a href="#"><i class="fas fa-globe"></i> Live Site</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </div>
                <div class="col-md-10 content">
                   @yield('content')
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid footer_part">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10 copyright">
                    <p>Copyright &copy; 2022 | All rights reserved by Dashboard | Development By <a href="#">Creative System Limited.</a></p>
                </div>
                <div class="clr"></div>
            </div>
        </div>
    </footer>
    <script src="{{asset('contens/admin')}}/js/jquery-3.6.0.min.js"></script>
    <script src="{{asset('contens/admin')}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('contens/admin')}}/js/datatables.min.js"></script>
    <script src="{{asset('contens/admin')}}/js/bootstrap-datepicker.js"></script>
    <script src="{{asset('contens/admin')}}/js/custom.js"></script>
  </body>
</html>
