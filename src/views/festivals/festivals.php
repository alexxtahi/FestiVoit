<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('festivals');
Helper::setCurrentView('festivals.php');
require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/festival/festivalDAO.php');

require_once Helper::getModelsPath('/festival/festival.php');

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

// Récupération des annonces depuis la BD
$festivalDao = new FestivalDAO(DB::getConnection());
$festivals = $festivalDao->readAll();

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
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Affichage de la liste des festivals -->
                                <?php foreach ($festivals as $festival) { ?>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <img src="<?= Helper::getAssetPath('/images/products/s4.jpg'); ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $festival->getNomFestival() ?></h5>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                                    the
                                                    card's content.</p>
                                                <a href="#" class="btn btn-primary">Participer</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
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