<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('users');
Helper::setCurrentView('users.php');


require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/user/UserDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
  DB::init();
}

// Récupération des annonces depuis la BD
$userDao = new UserDAO(DB::getConnection());
$users = $userDao->readAll();

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

        <div class="row">
          <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
              <div class="row">
                  <div class="col-9">
                    <h5 class="card-title fw-semibold mb-4">
                      Utilisateurs
                    </h5>
                  </div>
                  <div class="col-3">
                    <a href="<?= Helper::pathToView('users', 'addUser.php') ?>" class="btn btn-primary m-1">Ajouter un utilisateur</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">No</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Nom</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Prénom</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Role</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Actions</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $index => $user) { ?>
                        <tr>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-0"><?= $index + 1 ?></h6>
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?= $user->getNom() ?></h6>
                            <!-- <span class="fw-normal">Web Designer</span> -->
                          </td>
                          <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1"><?= $user->getPrenom() ?></h6>
                            <!-- <span class="fw-normal">Web Designer</span> -->
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal"><?= $user->getPrenom() ?></p>
                          </td>
                          <td class="border-bottom-0">
                            <div class="d-flex align-items-center gap-2">
                              <a href="#" class="d-flex align-items-center justify-content-center badge bg-primary rounded-3 fw-semibold">
                                <i class="ti ti-eye me-1"></i> Voir
                              </a>
                              <span class="d-flex align-items-center justify-content-center badge bg-warning rounded-3 fw-semibold">
                                <i class="ti ti-edit-circle me-1"></i> Modifier
                              </span>
                              <button class="d-flex align-items-center justify-content-center badge bg-danger rounded-3 fw-semibold" style="border: none;" data-toggle="modal" data-target="#deleteUser<?= $user->getId() ?>">
                                <i class="ti ti-trash me-1"></i> Supprimer
                              </button>
                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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