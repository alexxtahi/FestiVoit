<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('loginController.php');

require_once Helper::getModelsPath('/user/UserDAO.php');
require_once Helper::getModelsPath('/DB.php');

// Dans le cas d'un utilisateur qui vient de s'inscrire, on le connecte directement...
if (User::isLoggedIn()) {
    header('location:' . Helper::pathToView('root', 'index.php'));
}

// Dans le cas d'un utilisateur qui veut se connecter...

// Récupération des infos de connexion
$login = $_POST['login'];
$mdp = $_POST['mdp'];

// Connexion à la base de données
if (!DB::isOpen()) {
    DB::init();
}

// Vérification du login en base et comparaison des mots de passe
$userDao = new UserDAO(DB::getConnection());
$dbUser = $userDao->readByLogin($login);


if ($dbUser != null && password_verify($mdp, $dbUser->getHashMdp())) {
    session_start();
    User::setAuthUser($dbUser);
    header('location:' . Helper::pathToView('root', 'index.php'));
}

// Redirecvtion sur la âge de connexion en cas de login/mdp incorrects
$_SESSION['transactionState'] = "danger";
$_SESSION['transactionMsg'] = "<strong>Login</strong> ou <strong>Mot de passe</strong> incorrect Veuillez réessayer s'il vous plait";
header('location:' . Helper::pathToView('auth', 'login.php'));
