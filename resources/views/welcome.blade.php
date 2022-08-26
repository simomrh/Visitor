@extends('layouts.guest')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Page d'Accueil</title>
    <link href="{{ asset('/css/home.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <header>
            <!-- <div class="label">
                <img src="{{ asset('/images/logo.png') }}"href="#">

            </div>
            <div class="navbar">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a class="btn btn-primary" href="{{ url('/login') }}">log-in</a></li>
                </ul>
            </div>!-->

            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-logo " href="#">Visitor</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link" href="#Home">Home <span class="sr-only"></span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#contact">Contact </a>
                        </li>
                    </ul>
                    <a href="{{ route('login') }}" class="btn btn-outline-success">Log in</a>



                </div>
                <p>*seuls les employeurs</p>
            </nav>
        </header>

        <div class="body-content">

            <div class="b-title">

                <h1>Bonjour,<br> Bienvenue sur <span> Visitor</span> <br>
                    <small> où vous pouvez réserver votre rendez-vous </small>
                </h1>
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModalCenter">créer Rendez-vous</button>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Rendez-vous</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email address</label>
                                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Password</label>
                                  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                  </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                              </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <div class="b-img">
                <img src="{{ asset('/img/home2.svg') }}" class="image-fluid" alt="">
            </div>
        </div>
    </div>

    <hr>

    <!-- section about !-->

    <section id="about" class="about section-padding">
        <div class="container">
            <h1>About</h1>
            <hr class="about-hr">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="about-image">
                        <img src="{{ asset('/img/about2.svg') }}" class="svg" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">

                    <div class="about-text">
                        <h2> <span> Planification intelligente </span> <br> et engagement dynamique des employés</h2>
                        <p>Facile à mettre en œuvre, facile à apprendre et à entretenir,
                            Visitor Workforce Management offre un accès rapide aux informations dont les planificateurs
                            ont besoin
                            pour prendre des décisions à court et à long terme afin de mieux impliquer les agents et les
                            clients.
                        </p>
                        <a href="" class="btn btn-outline-success">learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr>

    <!-- section contact !-->
    <section id="contact" class="contact section-padding">
        <div class="container">
            <h1>Contact</h1>
            <hr class="contact-hr">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <div class="contact-image">
                        <img src="{{ asset('/img/contact.svg') }}" class="svg" alt="">
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">

                    <div class="contact-form">

                        <form>
                            <div class=" form-group">
                                <label for="exampleFormControlInput1">First name</label>
                                <input type="text" class="input form-control" id="exampleFormControlInput1"
                                  >
                            </div>
                            <div class=" form-group">
                                <label for="exampleFormControlInput1">last name</label>
                                <input type="text" class="input form-control" id="exampleFormControlInput1"
                                    >
                            </div>
                            <div class=" form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="input form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com">
                            </div>
                            <div class=" form-group">
                                <label for="exampleFormControlInput1">Phone</label>
                                <input type="telephone" class="input form-control" id="exampleFormControlInput1"
                                    >
                            </div>

                            <div class=" form-group">
                                <label for="exampleFormControlTextarea1">Message</label>
                                <textarea class="input form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <a href="" class="btn btn-outline-success">Send</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <hr>
    <!-- Footer -->
<footer id="footer" class="text-center text-lg-start bg-light text-muted">

    <section class="">
      <div class="container text-center text-md-start mt-5">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h4 id="footer-logo" class="text-uppercase fw-bold mb-4">
              <i class="fas fa-gem me-3"></i>Visitor
            </h4>
            <p>
                Facile à mettre en œuvre, facile à apprendre et à entretenir
                Visitor Workforce Management offre un accès rapide aux informations dont les planificateurs
                ont besoin
                pour prendre des décisions à court et à long terme afin de mieux impliquer les agents et les
                clients.
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->

          <!-- Grid column -->

          <!-- Grid column -->
          <div id="footer-links" class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 id="footer-title" class="text-uppercase fw-bold mb-4">
               links
            </h6>
            <p>
                <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only"></span></a>
            </p>
            <p>
                <a class="nav-link" href="#about">About</a>
            </p>
            <p>
                <a class="nav-link" href="#contact">Contact</a>
            </p>

          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div id="footer-contact" class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 id="footer-title" class="text-uppercase fw-bold mb-4">Contact</h6>
            <p><i class="fas fa-home me-3"></i> Casablanca, NY 10012, MAR</p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              info@example.com
            </p>
            <p><i class="fas fa-phone me-3"></i> + 212 0634 5672 88</p>
            <p><i class="fas fa-print me-3"></i> + 212 0634 5672 89</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2021 Copyright:
      <a id="copyright" class="text-reset fw-bold" href="{{url('/')}}">Visitor</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>



@endsection
