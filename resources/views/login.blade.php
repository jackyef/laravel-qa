<html>

<head>
    <title>Login Form</title>
    <link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/material-kit.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/bootstrap-datepicker.js')}}"></script>
    <script src="{{url('js/material-kit.js')}}"></script>
    <script src="{{url('js/material.min.js')}}"></script>
    <script src="{{url('js/nouislider.min.js')}}"></script>
</head>

<body>
@if (count($errors) > 0)
    <div class = "alert alert-danger">
        <div class="container-fluid">
            <i class="fa fa-warning" style="vertical-align: middle"></i>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fa fa-times fa-3x"></i></span>
            </button>
            <b>Error!</b>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<div class="col-sm-4 col-sm-offset-4">
    <div class="card card-raised card-nav-tabs">
        <div class="header header-primary">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="active" style="width: 50%">
                            <a href="#login" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="left" title="Login here!" data-container="body">
                                        <center><i class="fa fa-user"></i> Login</center>
                                </span>
                            </a>
                        </li>
                        <li style="width: 50%">
                            <a href="#signup" data-toggle="tab">
                                <span data-toggle="tooltip" data-placement="right" title="Sign up here!" data-container="body">
                                    <center><i class="fa fa-edit"></i>
                                    Sign up</center>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="tab-content">
                <div class="tab-pane active" id="login">
                    <form action="{{url('/login')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group label-floating">
                            <label class="control-label" for="username">Username</label>
                            <input class="form-control" type="text" name="username" />
                            <span class="form-control-feedback">
                                                <i class="fa fa-check"></i>
                                            </span>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="signup">
                    <form action="{{url('/signup')}}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group label-floating">
                            <label class="control-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" />
                            <span class="form-control-feedback">
                                                <i class="fa fa-times"></i>
                                            </span>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label" for="username">Username</label>
                            <input class="form-control" type="text" name="username" />
                            <span class="form-control-feedback">
                                                <i class="fa fa-check"></i>
                                            </span>
                        </div>
                        <div class="form-group label-floating">
                            <label class="control-label" for="password">Password</label>
                            <input class="form-control" type="password" name="password" />
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label" for="password2">Confirm password</label>
                            <input class="form-control" type="password" name="password2" />
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success btn-block">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>