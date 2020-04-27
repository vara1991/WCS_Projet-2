<?php
namespace App\Controller;

use App\Model\LogManager;

class LogController extends AbstractController
{
    public function index()
    {
        session_start();
        $logManager = new LogManager();
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                $log = $logManager->login();
                if ($_POST['pseudo'] == $log['username']) {
                    if ($_POST['password'] == $log['password']) {
                        if ($log['role_id'] == 1) {
                            $_SESSION['login'] = true;
                            $_SESSION['pseudo'] = $_POST['pseudo'];
                            return $this->twig->render('Log/welcome.html.twig', [
                                'connected' => $_SESSION['login'],
                                'pseudo' => $_SESSION['pseudo']
                            ]);
                        } else {
                            session_start();
                            $_SESSION['login'] = true;
                            $_SESSION['admin'] = true;
                            $_SESSION['pseudo'] = $_POST['pseudo'];
                            return $this->twig->render('Log/welcome.html.twig', [
                                'connected' => $_SESSION['login'],
                                'admin' => $_SESSION['admin'],
                                'pseudo' => $_SESSION['pseudo']
                            ]);
                        }
                    }
                    if ($_POST['password'] != $log['password']) {
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
            'error' => $error
        ]);
    }

    public function logout()
    {
        session_start();
        session_destroy();
        $_SESSION = array();
        unset($_SESSION);
        return $this->twig->render('Log/goodbye.html.twig');
    }

    public function register()
    {
        return $this->twig->render('Log/register.html.twig');
    }
}
