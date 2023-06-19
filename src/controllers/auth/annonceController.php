<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('annonceController.php');

require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/annonce/AnnonceDAO.php');
require_once Helper::getModelsPath('/DB.php');

// Récupération des infos et création d'un nouvel utilisateur
$newAnnonce = new Annonce(0, $_POST['typeVehicule'], $_POST['placeVehicule'], User::getAuthUser()->getId(), $_POST['festivalId'], new DateTime($_POST['dateAller']), isset($_POST['dateRetour']) ? new DateTime($_POST['dateRetour']) : null);

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

$annonceDao = new AnnonceDAO(DB::getConnection());

// Enregistrement de l'annonce en base
var_dump(User::getAuthUser());
$annonceDao->create($newAnnonce);

$_SESSION['transactionState'] = "success";
$_SESSION['transactionMsg'] = "Ajout réussi !";
header('location: ' . $_SERVER['HTTP_REFERER']);
