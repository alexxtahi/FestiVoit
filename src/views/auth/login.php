<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('auth');
Helper::setCurrentView('login.php');

require_once Helper::getModelsPath('/user/User.php');

// Dans le cas d'un utilisateur qui vient de s'inscrire, on le connecte directement...
if (User::isLoggedIn()) {
    header('location:' . Helper::pathToView('root', 'index.php'));
}

?>

<!doctype html>
<html lang="fr">

<head>
    <?php include '../components/head.php' ?>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="<?= Helper::pathToView('root', 'index.php') ?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="<?= Helper::getAssetPath('/images/logos/dark-logo.svg'); ?>" width="180" alt="">
                                </a>
                                <p class="text-center">Votre site de covoiturage facile !</p>
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
                                <form action="<?= Helper::getControllerPath('/auth/loginController.php'); ?>" method="post">
                                    <div class="mb-3">
                                        <label for="login" class="form-label">Login</label>
                                        <input type="text" class="form-control" id="login" name="login" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="mdp" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="mdp" name="mdp" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Se connecter</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Vous êtes nouveau ?</p>
                                        <a class="text-primary fw-bold ms-2" href="<?= Helper::pathToView('auth', 'register.php') ?>">Créez votre compte ici !</a>
                                    </div>
                                </form>
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