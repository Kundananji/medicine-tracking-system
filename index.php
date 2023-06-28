<?php
session_start();
if (!isset($_SESSION['userId'])) header('location:login.php');
$name = $_SESSION['name'];
$userId =  $_SESSION['userId'];
$userTypeId = $_SESSION['userTypeId'];

include('classes/database.php');
include('classes/user-type.php');
$userType = new userType($userTypeId);
$mUserType = $userType->getUserByTypeId();

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


  <style>
    #map {
      width: 100%;
      height: 600px;
      background-color: grey;
    }

    .full-screen-modal {
      position: fixed !important;
      top: 0 !important;
      right: 0 !important;
      bottom: 0 !important;
      left: 0 !important;
      overflow: hidden !important;
      width: 100% !important;
      height: 100% !important;
    }

    .full-screen-modal-dialog {
      width: 100% !important;
      height: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
      max-width: 100% !important;
    }

    .full-screen-modal-content {
      height: auto !important;
      min-height: 100% !important;
      border-radius: 0 !important;
      width: 100% !important;

    }
  </style>

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
  <?php include('includes/side-bar.php') ?>

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
        <div class="col table-responsive" id="page-content">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <img src="assets/img/mts.jpg" style="width: 100%;" class="img img-fluid rounded">

            </div>
            <div class="col-sm-12 col-md-6">

              <p>Welcome to the Medicine Tracking System, your trusted solution for effectively monitoring and managing medicine throughout the entire medical supply chain. Our innovative platform empowers you to track medications from the moment they are produced by the manufacturer until they reach the hands of the end customer.</p>

              <p>With the ever-growing complexity of the pharmaceutical industry, ensuring the safety and integrity of medicines is of paramount importance. Our system is designed to address this critical need by providing real-time visibility and traceability throughout the entire supply chain. By leveraging advanced technologies such as blockchain, IoT (Internet of Things), and secure data encryption, we offer a robust and reliable solution that instills confidence in the pharmaceutical ecosystem.</p>

              <p>Here are some key reasons why you should choose our Medicine Tracking System:</p>

              <ul>
                <li>Enhanced Safety and Quality Control.</li>

                <li>Efficient Supply Chain Management.</li>

                <li>Regulatory Compliance Made Easy.</li>

                <li>Trust and Transparency.</li>

                <li>Customer Empowerment.</li>

                <li>Scalable and Future-Ready.</li>
              </ul>


            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include('includes/footer.php'); ?>




  <!-- modal: show transaction -->
  <div class="modal fade" id="showTransactionModal" aria-labelledby="showTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showTransactionModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body table-responsive" id="show-transaction-modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <!-- modal: show content -->
  <div class="modal fade" id="showContentModal" aria-labelledby="showContentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="showContentModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body table-responsive" id="show-content-modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>






  <!-- modal: pick location -->
  <div class="modal fade" id="pickLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pick Location From Map</h5>
          <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="alerting-area"></div>
          <div id="googleMap" style="width:100%;height:400px;">

          </div>


        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Okay</button>

        </div>
      </div>
    </div>
  </div>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <?php include('includes/js-scripts.php') ?>

  <script>
    window.lastPickedLocation = null;

    let showLocation = (location) => {
      $('#pickLocationModal').modal('show');
      $('#alerting-area').html('');
      loadMap(null, location);
    }


    let pickLocation = (obj) => {
      $('#pickLocationModal').modal('show');
      $('#alerting-area').html(`<div class="alert alert-info">Click on Map to Pick Locaton</div>`);
      loadMap(obj);
    }

    let loadMap = (obj, mLocation) => {

// Initialize map to Lusaka
let currentPosition = new google.maps.LatLng(-15.416667, 28.283333);

if (window.lastPickedLocation) {
  // Remember last picked location
  currentPosition = window.lastPickedLocation;
}

if (!mLocation) {
  // Get user's current location
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        currentPosition = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        initializeMap(currentPosition);
      },
      (error) => {
        console.log(error);
        initializeMap(currentPosition);
      }
    );
  } else {
    initializeMap(currentPosition);
  }
} else {
  let locationParts = mLocation.split(",");
  currentPosition = new google.maps.LatLng(locationParts[0], locationParts[1]);
  initializeMap(currentPosition);
}

function initializeMap(position) {
  var mapProp = {
    center: position,
    zoom: 8,
  };

  var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

  currentMarker = null;

  if (!mLocation) {
    // Only listen for location changes if mLocation is not defined
    google.maps.event.addListener(map, "click", (event) => {
      addMarker(event.latLng, map);
    });
  }

  // Add a marker at the center of the map.
  addMarker(position, map);

  // Adds a marker to the map.
  function addMarker(location, map) {
    if (currentMarker) {
      currentMarker.setMap(null);
    }
    
    // Add the marker at the clicked location
    currentMarker = new google.maps.Marker({
      position: location,
      map: map,
    });

    if (obj) {
      var mLocation = location.toJSON();
      obj.value = mLocation.lat + "," + mLocation.lng;
    }
  }
}
};

  </script>

  <!-- Google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASoSGvmJE4yIFaP4K0ijV-hpemGBevikw&callback=loadMap"></script>

</body>

</html>