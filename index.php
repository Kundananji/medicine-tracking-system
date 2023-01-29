<?php
session_start();
if(!isset($_SESSION['userId'])) header('location:login.php');
$name= $_SESSION['name'];
$userId =  $_SESSION['userId'];
$userTypeId = $_SESSION['userTypeId'];

include('classes/database.php');
include('classes/user-type.php');
$userType = new userType($userTypeId);
$mUserType=$userType->getUserByTypeId();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="Medicine Tracking System Dashboard allows you to report notification related to medicine." name="description">
  <meta content="Medicine Traacking System, Dashboard, Medicine notifications" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <?php include('includes/css-files.php') ?>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
 <?php include('includes/header.php') ?>

  <!-- ======= Sidebar ======= -->
  <?php include('includes/side-bar.php')?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">
         <div class="col" id="page-content">
            <p>Welcome to the Medicine Tracking System. A system that allows you track medicne through the medical supply chain from the manufacturer to the customer.</p>
         </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php');?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include('includes/js-scripts.php') ?>

</body>

</html>