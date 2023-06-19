<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('registerController.php');

require_once Helper::getModelsPath('/user/User.php');
require_once Helper::getModelsPath('/user/UserDAO.php');
require_once Helper::getModelsPath('/DB.php');

// Récupération des infos et création d'un nouvel utilisateur
$newUser = new User(0, $_POST['nom'], $_POST['prenom'], $_POST['login'], password_hash($_POST['mdp'], PASSWORD_DEFAULT), isset($_POST['typeUserId']) ? $_POST['typeUserId'] : 3);

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

$userDao = new UserDAO(DB::getConnection());
// On vérifie si l'utilisateur existe déjà avec le login
if ($userDao->readByLogin($_POST['login']) != null) {
    $_SESSION['transactionState'] = "warning";
    $_SESSION['transactionMsg'] = "Un compte avec ce login existe déjà veuillez en choisir un autre.";
    header('location: ' . $_SERVER['HTTP_REFERER']);
}

// Enregistrement de l'utilisateur en base
$userDao->create($newUser);

// Redirection vers la page de connexion
if (!User::isLoggedIn()) {
    $dbUser = $userDao->readByLogin($_POST['login']);
    User::setAuthUser($dbUser);
    header('location:' . Helper::getControllerPath('/auth/loginController.php'));
}

$_SESSION['transactionState'] = "success";
$_SESSION['transactionMsg'] = "Ajout réussi !";
header('location: ' . $_SERVER['HTTP_REFERER']);
