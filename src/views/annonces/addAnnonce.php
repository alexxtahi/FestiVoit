<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('annonces');
Helper::setCurrentView('addAnnonce.php');

require_once Helper::getModelsPath('/DB.php');
require_once Helper::getModelsPath('/festival/FestivalDAO.php');

// Connexion à la base de données
if (!DB::isOpen()) {
	DB::init();
}

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
							<h5 class="card-title fw-semibold mb-4">Nouvelle Annonce</h5>
							<div class="card">
								<div class="card-body">
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
									<form action="<?= Helper::getControllerPath('/auth/annonceController.php'); ?>" method="post">
										<div class="row mb-3">
											<div class="col-6">
												<label for="typeVehicule" class="form-label">Type de véhicule</label>
												<input type="text" class="form-control" id="typeVehicule" name="typeVehicule" required>
											</div>
											<div class="col-6">
												<label for="placeVehicule" class="form-label">Nombre de places disponibles</label>
												<input type="number" class="form-control" id="placeVehicule" name="placeVehicule" value="1" min="1" required>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-6">
												<label for="dateAller" class="form-label">Date aller</label>
												<input type="datetime-local" class="form-control" id="dateAller" name="dateAller" value="" required>
											</div>
											<div class="col-6">
												<label for="dateRetour" class="form-label">Date retour</label>
												<input type="datetime-local" class="form-control" id="dateRetour" name="dateRetour" value="">
											</div>
										</div>
										<div class="mb-3">
											<label for="festivalId" class="form-label">Festival concerné</label>
											<select id="festivalId" name="festivalId" class="form-select" required>
												<option value="">-- Sélectionnez le festival --</option>
												<?php foreach ($festivals as $f) { ?>
													<option value="<?= $f->getId() ?>"><?= $f->getNomFestival() ?></option>
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