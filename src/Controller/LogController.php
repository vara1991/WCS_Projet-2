<?php
namespace App\Controller;

use App\Model\LogManager;

class LogController extends AbstractController
{
    public function index()
    {
        $logManager = new LogManager();
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
                $log = $logManager->login();
                if ($_POST['pseudo'] == $log['username']) {
                    if ($_POST['password'] == $log['password']) {
                        if ($log['role_id'] == 1) {
                            session_start();
                            $_SESSION['login'] = true;
                            return $this->twig->render('Home/index.html.twig', [
                                'connected' => $_SESSION['login']
                            ]);
                        } else {
                            session_start();
                            $_SESSION['login'] = true;
                            $_SESSION['admin'] = true;
                            return $this->twig->render('Home/index.html.twig', [
                                'connected' => $_SESSION['login'],
                                'admin' => $_SESSION['admin']
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
        $_SESSION['login'] = false;
        return $this->twig->render('Home/index.html.twig', [
            'connected' => $_SESSION['login']
        ]);
    }

    public function register()
    {
        return $this->twig->render('Log/register.html.twig');
    }
}
