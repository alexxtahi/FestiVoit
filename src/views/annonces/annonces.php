<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('annonces');
Helper::setCurrentView('annonces.php');

require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/annonce/Annonce.php');
require_once Helper::getModelsPath('/annonce/AnnonceDAO.php');
require_once Helper::getModelsPath('/festival/FestivalDAO.php');
require_once Helper::getModelsPath('/participate/ParticipateDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

// Récupération des annonces depuis la BD
$annonceDao = new AnnonceDAO(DB::getConnection());
$festivalDao = new FestivalDAO(DB::getConnection());
$participateDao = new ParticipateDAO(DB::getConnection());
$annonces = $annonceDao->readAll();

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
                                <div class="col-9">
                                    <h5 class="card-title fw-semibold mb-4">
                                        Annonces
                                    </h5>
                                </div>
                                <div class="col-3">
                                    <a href="<?= User::isLoggedIn() ? Helper::pathToView('annonces', 'addAnnonce.php') : Helper::pathToView('auth', 'login.php') ?>" class="btn btn-primary m-1">Ajouter une annonce</a>
                                </div>
                            </div>
                            <!-- Transaction message start -->
                            <?php if (isset($_SESSION['transactionState'])) { ?>
                                <div class="alert alert-<?= $_SESSION['transactionState'] ?>" role="alert">
                                    <?= $_SESSION['transactionMsg'] ?>
                                </div>
                            <?php } ?>
                            <?php
                            unset($_SESSION['transactionState']);
                            unset($_SESSION['transactionMsg']);
                            ?>
                            <!-- Transaction message end -->
                            <div class="row">
                                <!-- Affichage de la liste des annonces -->
                                <?php foreach ($annonces as $annonce) { ?>
                                    <?php
                                    $annonceFesti = $festivalDao->read($annonce->getFestivalId());
                                    $countParticipate = count($participateDao->readAllByAnnonceId($annonce->getId()));
                                    ?>
                                    <div class="col-sm-6 col-xl-3">
                                        <div class="card overflow-hidden rounded-2">
                                            <div class="position-relative">
                                                <a href="javascript:void(0)"><img src="<?= Helper::getAssetPath('/images/covoiturage.jpg'); ?>" class="card-img-top rounded-0" alt="..." /></a>
                                                </a>
                                            </div>
                                            <div class="card-body pt-3 p-4">
                                                <h6 class="fw-semibold fs-4">Covoit' pour le <?= $annonceFesti->getNomFestival() ?></h6>
                                                <p class="fw-semibold fs-4 mb-1">Véhicule: <?= $annonce->getTypeVehicule() ?></p>
                                                <p class="fw-semibold fs-4 mb-1">Places: <?= $countParticipate . '/' . $annonce->getPlaceVehicule() ?></p>
                                                <p class="fw-semibold fs-4 mb-1">Date aller: <?= $annonce->getDateAller() ?></p>
                                                <p class="fw-semibold fs-4 mb-1">Date retour: <?= $annonce->getDateRetour() ?></p>
                                                <a href="<?= Helper::getControllerPath('/auth/participateToAnnonceController.php'); ?>?annonceId=<?= $annonce->getId() ?>" class="btn btn-primary m-1">Participer</a>
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
        <!-- Scripts Start -->
        <?php include '../components/scripts.php' ?>
        <!--  Scripts End -->
</body>

</html>