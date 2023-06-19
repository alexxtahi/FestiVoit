<?php
require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/user/UserDAO.php');
require_once Helper::getModelsPath('/typeUser/TypeUserDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

$typeUserDao = new TypeUserDAO(DB::getConnection());
$authUserType = $typeUserDao->read(User::getAuthUser()->getTypeUserId());
?>


<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <?php if (User::isLoggedIn()) { ?>
                    <a href="#" class="btn btn-primary">
                        <?= User::getAuthUser()->getNomComplet() ?> <span style="opacity: 0.7;"><?= '(' . $authUserType->getNomType() . ')' ?></span>
                    </a>
                <?php } else { ?>
                    <a href="<?= Helper::pathToView('auth', 'login.php') ?>" class="btn btn-primary">
                        Se connecter
                    </a>
                <?php } ?>
                <?php if (User::isLoggedIn()) { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= Helper::getAssetPath('/images/profile/user-1.jpg'); ?>" alt="" width="35" height="35" class="rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                            <div class="message-body">
                                <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user fs-6"></i>
                                    <p class="mb-0 fs-3">Mon profil</p>
                                </a>
                                <a href="<?= Helper::getControllerPath('/auth/logoutController.php'); ?>" class="btn btn-outline-primary mx-3 mt-2 d-block">Se déconnecter</a>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>