<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('/css/login/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font/awesome-font/all.css') }}" rel="stylesheet">
</head>

<body>

    <!--header section -->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <a class="navbar-logo " href="{{ url('/') }}">Visitor</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only"></span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact us</a>
                    </li>
                </ul>

            </div>

        </nav>


        <section id="login" class="login section-padding">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 col-md-12 col-12">
                        <div class="login-image">
                            <img src="{{ asset('/img/login.svg') }}" class="svg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">

                        <div class="card">

                            <h1 style="margin:5% 0 3% 40%"> Log-in </h1>
                            <form  class="form-horizontal form-material text-center" id="loginform" method="POST" action="{{ route('login') }}">

                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="text" style="width:300px" class="input form-control" name="email"
                                        required aria-describedby="emailHelp">
                                    <span class="text-danger">
                                        @error('email')
                                            please enter your login
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" style="width:300px" class="input form-control"
                                        name="password" required>
                                        <span class="text-danger">
                                            @error('password')
                                                please enter your correct password
                                            @enderror
                                        </span>
                                </div>


                                <button  class="btn btn-outline-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>














    <script src="{{ asset('js/jQuery.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
