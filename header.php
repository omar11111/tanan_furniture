<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanan</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">

</head>

<body>
  <main class=" container-fluid row col-12  mx-auto ">
    
    <header>
    <!-- navbar start -->
    <nav class="navbar col-12  mx-auto navbar-expand-lg ">
      <a class="col-7 col-md-6 navbar-brand" href="index.php">
        <span><img style="width: 50px;" src="images/logo.png" alt=""></span>
        Tanan </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="col-2 "><i class="fas fa-bars"></i></span>
      </button>
      <div class=" collapse  navbar-collapse " id="navbarNavDropdown">
        <ul class="  col-12 text-center navbar-nav">
         
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>

          
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact Us</a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="sign_in.php">Sign In</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="sign_up.php">Sign Up</a>
          </li>

        </ul>
      </div>

    </nav>