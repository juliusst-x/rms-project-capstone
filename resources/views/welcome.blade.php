<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SRMS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.svg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  @include('includes.landing.stylesheet')


  <!-- =======================================================
    * Template Name: Vesperr - v4.7.0
    * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

  @include('includes.landing.navbar')


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Residence Management System</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Submit your problem report here, we will process it quickly, safely and comfortably.</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="{{ url('login')}}" class="btn-get-started scrollto">Let's Login</a>

            <!-- <a href="#services" class="btn-get-started-2 scrollto">Report Flow</a> -->
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/hero.svg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->



  <!-- ======= About Us Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>About Us</h2>
      </div>

      <div class="row content">
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
          <p>
          <h3>RMS</h3> is a system that optimizing residences' emergency safety control through smart residence management system
          </p>
          <ul>
            <h3>RMS Purposes</h3>
            <li><i class="ri-check-double-line"></i>help to manage the resident inside the residential area</li>
            <li><i class="ri-check-double-line"></i>Improve emergency safety control</li>
          </ul>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
          <p>
          <h4>RMS</h4>is our commitment to give contribution in improving residential management and optimize residences' safety control.
          </p>
          <!-- <a href="#services" class="btn-learn-more">Report Flow</a> -->
        </div>
      </div>

    </div>
  </section><!-- End About Us Section -->


  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>FLOW</h2>
        <p>This is the flow in the RMS Website</p>
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class='bx bxs-edit-alt'></i></div>
            <h4 class="title"><a href="">Submit Report</a></h4>
            <p class="description">Fill your concern report clearly.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-shuffle"></i></div>
            <h4 class="title"><a href="">Verification</a></h4>
            <p class="description">Wait until your report is validated by the admin.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4 class="title"><a href="">Follow-Up</a></h4>
            <p class="description">Your report is being processed and followed up.</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class='bx bx-check-shield'></i></div>
            <h4 class="title"><a href="">Finish</a></h4>
            <p class="description">The concern report has been processed.</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Services Section -->

  @include('includes.landing.footer')







  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('includes.landing.javascript')

</body>

</html>