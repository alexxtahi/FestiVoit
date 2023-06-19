<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('user-profil');
Helper::setCurrentView('user-profil.php');


require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/typeUser/TypeUser.php');
require_once Helper::getModelsPath('/typeUser/TypeUserDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
	DB::init();
}

$typeUserDao = new TypeUserDao(DB::getConnection());
$typeUsers = $typeUserDao->readAll();

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
							<h5 class="card-title fw-semibold mb-4">Ajouter un utilisateur</h5>
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
							<div class="card">
								<div class="card-body">
									<form action="<?= Helper::getControllerPath('/auth/registerController.php'); ?>" method="post">
										<div class="row mb-3">
											<div class="col-6">
												<label for="nom" class="form-label">Nom</label>
												<input type="text" class="form-control" id="nom" name="nom" required>
											</div>
											<div class="col-6">
												<label for="prenom" class="form-label">Prenom</label>
												<input type="text" class="form-control" id="prenom" name="prenom" required>
											</div>
										</div>
										<div class="mb-3">
											<label for="login" class="form-label">Login</label>
											<input type="text" class="form-control" id="login" name="login" required>
										</div>
										<div class="mb-3">
											<label for="mdp" class="form-label">Mot de passe</label>
											<input type="password" class="form-control" id="mdp" name="mdp" required>
										</div>
										<div class="mb-3">
											<label for="typeUserId" class="form-label">Rôle</label>
											<select id="typeUserId" name="typeUserId" class="form-select" required>
												<?php foreach ($typeUsers as $tu) { ?>
													<option value="<?= $tu->getId() ?>" <?= $tu->getId() == 3 ? 'selected' : '' ?>><?= $tu->getNomType() ?></option>
												<?php } ?>
											</select>
										</div>
										<button type="submit" class="btn btn-primary">Ajouter</button>
									</form>
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