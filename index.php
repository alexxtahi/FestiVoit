<?php

require_once './helper.php';

Helper::setCurrentViewDir('root');
Helper::setCurrentView('index.php');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <?php include './src/views/components/head.php' ?>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <?php include './src/views/components/sidebar.php' ?>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <?php include './src/views/components/header.php' ?>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-xl-12">
            <div class="card overflow-hidden rounded-2">
              <div class="card-body pt-3 p-4">
                <h6 class="fw-semibold fs-4">Bienvenue sur FestiVoiturage !</h6>
                <div class="d-flex align-items-center justify-content-between">
                  <p class="fw-semibold fs-4 mb-0">
                    Votre application web de réservation de covoit' 100% fiable et sécurisée.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">
            Design and Developed by
            <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>
            Distributed by <a href="https://themewagon.com">ThemeWagon</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts Start -->
  <?php include './src/views/components/scripts.php' ?>
  <!--  Scripts End -->
</body>

</html>