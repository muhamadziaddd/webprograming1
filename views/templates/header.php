<?php
// Cek apakah sesi sudah aktif sebelum memulai sesi
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Halaman
    <?= $data['judul']; ?>
  </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css">

  <style>
    html,
    body {
      height: 100%;
      margin: 0;
    }

    .content {
      min-height: 100%;
      margin-bottom: -60px;
    }
    .image-preview {
      max-height: 20px;
    }

    .footer {
      height: 60px;
      /* Tinggi footer */
      padding: 10px;
    }

    .bg-image-vertical {
      position: relative;
      overflow: hidden;
      background-repeat: no-repeat;
      background-position: right center;
      background-size: auto 100%;
      max-height: 200px
    }

    /* Additional custom styles (if any) can be added here */
    .donation-card {
      position: relative;
      overflow: hidden;
      border-radius: 8px;
    }

    .donation-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      border-top-left-radius: 6px;
      border-top-right-radius: 6px;
    }

    .donation-card .card-title {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .donation-card .card-text {
      font-size: 16px;
      color: #888;
    }

    

    /* .donation-card:hover .card-text {
      color: #f8f9fa;
    } */

    /* .donation-card:hover .btn {
      background-color: #ffc107;
    } */

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .animated {
      animation-duration: 1s;
      animation-fill-mode: both;
    }

    /* Customize the animation duration and easing here */
    .fadeInUp {
      animation-name: fadeInUp;
    }

    /* Custom styles for card and jumbotron */
    .donation-card {
      transition: transform 0.3s ease;
    }

    .donation-card:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
    }

    .jumbotron {
      background-image: url("<?= BASEURL; ?>/img/bg-banner-custome.jpg");
      background-size: cover;
      background-position: center;
      color: #fff;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
      padding: 200px 0;
      text-align: center;
      height: 600px;
    }
    .jumbotron-about {
      background-image: url("<?= BASEURL; ?>/img/bg-banner-blog.jpg");
      background-size: cover;
      background-position: center;
      color: #fff;
      text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
      padding: 70px 0;
      text-align: center;
      height: 300px;
    }


    .jumbotron h1 {
      font-size: 48px;
    }

    .jumbotron p {
      font-size: 24px;
    }

    .jumbotron a {
      font-size: 20px;
      padding: 10px 30px;
    }

    .jumbotron button:hover {
      background-color: #ffc107;
    }

  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="<?= BASEURL; ?>">ABC</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav me-auto">
          <a class="nav-item nav-link active" href="<?= BASEURL; ?>">Home</a>
          <!-- <a class="nav-item nav-link" href="<?= BASEURL; ?>/event">Event</a> -->
          <a class="nav-item nav-link" href="<?= BASEURL; ?>/about">About</a>
          <a class="nav-item nav-link" href="<?= BASEURL; ?>/donasi">All donation</a>
        </div>
        <div class="ms-auto">
          <a class="nav-item nav-link text-light" href="<?= BASEURL; ?>/dashboard">Dashboard</a>
        </div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true): ?>
          <div class="navbar-nav">
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $username; ?>
              </a>
              <ul class="dropdown-menu">
                <form id="logout" action="<?= BASEURL; ?>/auth/logout" method="post">
                  <a href="#" onclick="submitForm()" class="dropdown-item">
                    <i class="fas fa-arrow-right mr-2"></i> Logout
                  </a>
                </form>
                <script>
                    function submitForm() {
                        document.getElementById('logout').submit();
                    }
                </script>
              </ul>
            </li> -->
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>



  <div class="content">
    <!-- Your remaining HTML code -->