<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('registerController.php');

require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/user/UserDAO.php');
require_once Helper::getModelsPath('/DB.php');

function isFieldSetAndNotEmpty($field): bool
{
    return isset($field) && !empty($field);
}

// Récupération des nouvelles infos de l'utilisateur
$authUser = User::getAuthUser();

if (isFieldSetAndNotEmpty($_POST['nom'])) {
    $authUser->setNom($_POST['nom']);
}

if (isFieldSetAndNotEmpty($_POST['prenom'])) {
    $authUser->setPrenom($_POST['prenom']);
}

if (isFieldSetAndNotEmpty($_POST['mdp'])) {
    $authUser->sethashMdp($_POST['mdp']);
}

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

// Modification de l'utilisateur en base
$userDao = new UserDAO(DB::getConnection());
$userDao->update($authUser);

// Redirection vers la page de connexion
User::setAuthUser($authUser);
$_SESSION['transactionState'] = "success";
$_SESSION['transactionMsg'] = "Modification réussie !";
header('location:' . Helper::pathToView('auth', 'profile.php'));
