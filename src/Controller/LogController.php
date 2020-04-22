<?php
namespace App\Controller;

use App\Model\LogManager;

class LogController extends AbstractController
{
    public function index()
    {

        $logManager = new LogManager();
        $connected = false;
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                $log = $logManager->login();
                if ($_POST['pseudo'] == $log['username']) {
                    if ($_POST['password'] == $log['password']) {
                        $connected = true;
                        return $this->twig->render('Home/index.html.twig');
                    } else {
                        $error['password'] = 'Mauvais mot de passe';
                    }
                } else {
                    $error['pseudo'] = 'Pseudo introuvable';
                }
            } else {
                $error['form'] = 'Tous les champs doivent être remplis';
            }
        }

        return $this->twig->render('Log/index.html.twig', [
            $connected,
            'error' => $error,
        ]);
    }

    public function register()
    {
        return $this->twig->render('Log/register.html.twig');
    }
}
