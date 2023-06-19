<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('annonceController.php');

require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/participate/Participate.php');
require_once Helper::getModelsPath('/participate/ParticipateDAO.php');
require_once Helper::getModelsPath('/DB.php');

// Récupération des infos et création d'un nouvel utilisateur
$newParticipate = new Participate(0, $_GET['annonceId'], User::getAuthUser()->getId());

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

$participateDao = new ParticipateDAO(DB::getConnection());

// Enregistrement de l'annonce en base
$participateDao->create($newParticipate);

$_SESSION['transactionState'] = "success";
$_SESSION['transactionMsg'] = "Vous avez bien été enregistré pour ce covoiturage !";
header('location: ' . $_SERVER['HTTP_REFERER']);
