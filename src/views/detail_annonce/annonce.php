<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('annonces');
Helper::setCurrentView('annonces.php');

require_once Helper::getModelsPath('/annonce/annonce.php');

$annonces = Annonce::factory(3);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include '../components/head.php' ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <?php include '../components/sidebar.php' ?>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <?php include '../components/header.php' ?>
            <!--  Header End -->
            <div class="container-fluid">
                <div class="container-fluid">
                    <h1>Detail Annonce</h1>
                    <div class="card">
                        <div class="card-body" style="font-size:25px">
                            Type Annonce :  <br>
                            Nombre de place : <br>
                            Nom du festival : <br>
                            Date Aller : <br>
                            Date Retour : <br>
                               </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts Start -->
    <?php include '../components/scripts.php' ?>
    <!--  Scripts End -->
</body>

</html>