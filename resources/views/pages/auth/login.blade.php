<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Employee Management
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset("assets/css/bootstrap.min.css")}}" rel="stylesheet" />
    <link href="{{asset("assets/css/paper-dashboard.css?v=2.0.1")}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset("assets/demo/demo.css")}}" rel="stylesheet" />
    <style>
        .wrapper{
            background-color: #f4f3ef;
            height: 100vh;
        }

        .login{
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="">
<div class="wrapper">

    <div class="row login">
        <div class="col-md-4 mx-auto">
           <form method="post" action="{{ route('login-user') }}">
               @csrf
               <div class="card">
                   <div class="card-header">
                       <h2>Login</h2>
                   </div>
                   <div class="card-body">

                       @if(session()->has('message'))
                       <div class="alert alert-danger">
                           Invalid email or password
                       </div>
                       @endif

                       <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" id="email" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror">
                           @error('email')
                            <small class="invalid-feedback">Email is required</small>
                           @enderror
                       </div>

                       <div class="form-group">
                           <label for="password">Password</label>
                           <input type="password" id="password" name="password" class="form-control  @error('password') is-invalid @enderror">
                           @error('email')
                           <small class="invalid-feedback">Password is required</small>
                           @enderror
                       </div>

                       <div class="mt-2">
                           <button class="btn btn-primary">Login</button>
                       </div>
                   </div>
               </div>
           </form>
        </div>

    </div>

</div>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset("assets/js/paper-dashboard.min.js?v=2.0.1")}}" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
<script src="{{asset('assets/demo/demo.js')}}"></script>
@stack('script')
</body>

</html>

