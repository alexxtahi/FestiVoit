<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('user-profil');
Helper::setCurrentView('user-profil.php');


require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/user/UserDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
	DB::init();
}

$user = User::getAuthUser();

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
							<h5 class="card-title fw-semibold mb-4">Mon compte</h5>
							<!-- Error/Success message -->
							<?php if (isset($_SESSION['transactionState'])) { ?>
								<div class="alert alert-<?= $_SESSION['transactionState'] ?>" role="alert">
									<?= $_SESSION['transactionMsg'] ?>
								</div>
							<?php } ?>
							<?php
							unset($_SESSION['transactionState']);
							unset($_SESSION['transactionMsg']);
							?>
							<div class="card">
								<div class="card-body">
									<form action="<?= Helper::getControllerPath('/auth/profileController.php'); ?>" method="post">
										<div class="row mb-3">
											<div class="col-6">
												<label for="nom" class="form-label">Nom</label>
												<input type="text" class="form-control" id="nom" name="nom" value="<?= $user->getNom() ?>">
											</div>
											<div class="col-6">
												<label for="prenom" class="form-label">Prenom</label>
												<input type="text" class="form-control" id="prenom" name="prenom" value="<?= $user->getPrenom() ?>">
											</div>
										</div>
										<div class="mb-3">
											<label for="login" class="form-label">Login</label>
											<input type="text" class="form-control" id="login" name="login" value="<?= $user->getLogin() ?>" disabled>
										</div>
										<div class="mb-3">
											<label for="mdp" class="form-label">Changer de mot de passe</label>
											<input type="password" class="form-control" id="mdp" name="mdp">
											<div id="emailHelp" class="form-text">Saisissez votre nouveau mot de passe pour l'enregistrer</div>
										</div>
										<button type="submit" class="btn btn-primary">Enregistrer</button>
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