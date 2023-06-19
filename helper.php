<?php

if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Une classe contenant toutes les fonctions qui nous on été utiles pour le projet
 */
abstract class Helper
{
    /**
     * Retourne le chemin racine du projet
     * @return string $rootPath
     */
    public static function getRootPath(): string
    {
        return __DIR__;
    }

    /**
     * Retourne le chemin vers le dossier [assets] du projet
     * @param string $target Le fichier/dossier de destination
     * @return string $targetPath Le chemin de destination concatené avec le chemin du dossier [assets]
     */
    public static function getAssetPath(string $target): string
    {
        $currentFile = basename(__FILE__);

        $gap = $currentFile == 'index.php' ? './assets' : '../../../assets';

        return $gap . $target;
    }

    /**
     * Retourne le chemin vers le dossier [assets] du projet
     * @param string $target Le fichier/dossier de destination
     * @return string $targetPath Le chemin de destination concatené avec le chemin du dossier [assets]
     */
    public static function getModelsPath(string $target): string
    {
        $gap = './';

        if (Helper::getCurrentViewDir() == 'root') {
            $gap = './src/models';
        } else if (Helper::getCurrentViewDir() != 'root') {
            $gap = '../../models';
        }

        return $gap . $target;
    }

    /**
     * Retourne le chemin vers le dossier [assets] du projet
     * @param string $target Le fichier/dossier de destination
     * @return string $targetPath Le chemin de destination concatené avec le chemin du dossier [assets]
     */
    public static function getControllerPath(string $target): string
    {
        $gap = './';

        if (Helper::getCurrentViewDir() == 'root') {
            $gap = './src/controllers';
        } else if (Helper::getCurrentViewDir() != 'root') {
            $gap = '../../controllers';
        }

        return $gap . $target;
    }

    /**
     * Retourne le chemin vers le dossier [assets] du projet
     * @param string $target Le fichier/dossier de destination
     * @return string $targetPath Le chemin de destination concatené avec le chemin du dossier [assets]
     */
    public static function pathToView(string $viewDir, string $view): string
    {
        $gap = './';

        if (Helper::getCurrentViewDir() == 'root' && $view != 'index.php') {
            $gap = './src/views/' . $viewDir . '/';
        } else if (Helper::getCurrentViewDir() == 'controllers/auth' && $view != 'index.php') {
            $gap = '../../views/' . $viewDir . '/';
        } else if (Helper::getCurrentViewDir() != 'root' && $view == 'index.php') {
            $gap = '../../../';
        } else if (Helper::getCurrentViewDir() != 'root' && $view != 'index.php') {
            $gap = '../' . $viewDir . '/';
        }

        return $gap . $view ;
    }

    /**
     * Retourne "active" si la page courante est dans le dossier courant
     * @param string $viewDir le dossier de la page courrante
     * @return string $activeState "active" si la page courrante est dans le dossier courant, "" sinon.
     */
    public static function activeNavLink(string $viewDir): string
    {
        return Helper::getCurrentViewDir() == $viewDir ? 'active' : '';
    }

    /**
     * Met le dossier de la page courante en cookie de session
     * @param string $viewDir le dossier de la page courante
     * @return void
     */
    public static function setCurrentViewDir(string $viewDir): void
    {
        $_SESSION['currentViewDir'] = $viewDir;
    }

    /**
     * Met le nom du fichier de la page courante en cookie de session
     * @param string $view le nom du fichier de la page courante
     * @return void
     */
    public static function setCurrentView(string $view): void
    {
        $_SESSION['currentView'] = $view;
    }

    /**
     * Retourne le dossier de la page courante en cookie de session
     * @return string $viewDir le dossier de la page courante
     */
    public static function getCurrentViewDir(): string
    {
        return $_SESSION['currentViewDir'];
    }

    /**
     * Retourne la page courante en cookie de session
     * @return string $view la page de la page courante
     */
    public static function getCurrentView(): string
    {
        return $_SESSION['currentView'];
    }
}
