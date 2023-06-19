<?php
require_once Helper::getModelsPath('/user/User.php');
?>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="<?= Helper::getAssetPath('/images/logos/dark-logo.svg') ?>" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <!-- Accueil -->
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Accueil</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= Helper::activeNavLink('home') ?>" href="<?= Helper::pathToView('root', 'index.php') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Accueil</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">TABLEAU DE BORD</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= Helper::activeNavLink('annonces') ?>" href="<?= Helper::pathToView('annonces', 'annonces.php') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Annonces</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link <?= Helper::activeNavLink('festivals') ?>" href="<?= Helper::pathToView('festivals', 'festivals.php') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Festivals</span>
                    </a>
                </li>
                <?php if (User::isLoggedIn() && User::getAuthUser()->getTypeUserId() == 1) { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link <?= Helper::activeNavLink('users') ?>" href="<?= Helper::pathToView('users', 'users.php') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-alert-circle"></i>
                            </span>
                            <span class="hide-menu">Utilisateurs</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">MON COMPTE</span>
                </li>
                <?php if (User::isLoggedIn()) { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" <?= Helper::activeNavLink('auth') ?> href="<?= Helper::pathToView('auth', 'profile.php') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Mon compte</span>
                        </a>
                    </li>
                <?php } else { ?>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="<?= Helper::pathToView('auth', 'login.php') ?>" aria-expanded="false">
                            <span>
                                <i class="ti ti-login"></i>
                            </span>
                            <span class="hide-menu">Connexion</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>