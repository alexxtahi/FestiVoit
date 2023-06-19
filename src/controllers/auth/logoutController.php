<?php

require_once '../../../helper.php';

Helper::setCurrentViewDir('controllers/auth');
Helper::setCurrentView('logoutController.php');

require_once Helper::getModelsPath('/user/User.php');

// Dans le cas où personne n'est connecté...
if (!User::isLoggedIn()) {
    header('location:' . Helper::pathToView('root', 'index.php'));
}

// Redirection sur la page d'accueil
User::logout();
header('location:' . Helper::pathToView('root', 'index.php'));
