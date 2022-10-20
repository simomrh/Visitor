<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{ asset('/css/login/login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font/awesome-font/all.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
    <title>Visitor</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="login">

                <form class="login-form" id="loginform" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" style="width:300px" class="input form-control" name="email" required
                            aria-describedby="emailHelp">
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" style="width:300px" class="input form-control" name="password" required>
                    </div>
                    <input type="submit" value="Login" class="loginBTn solid" />


                </form>

            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Welcome To Visitor</h3>
                    <p>
                        Planification intelligente et engagement dynamique des employés
                    </p>

                </div>
                <img src="{{ asset('img/signIn.svg') }}" class="image" alt="" />
            </div>

        </div>
    </div>

    <script src="{{ asset('js/jQuery.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
