<?php

namespace App\Controller;

use App\Model\RegisterManager;

class RegisterController extends AbstractController
{
    public function index()
    {
        session_start();
        $registerManager = new RegisterManager();
        $users = $registerManager->selectAll();
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])
            && !empty($_POST['role_id'])) {
                $users = $registerManager->add();
                $_SESSION['login'] = true;
                $_SESSION['pseudo'] = $_POST['pseudo'];
                return $this->twig->render('Log/welcome.html.twig', [
                    'connected' => $_SESSION['login'],
                    'pseudo' => $_SESSION['pseudo']
                ]);
            } else {
                $error['form'] = 'Tous les champs doivent être remplis';
            }
        }

        return $this->twig->render('Log/register.html.twig', [
            'users' => $users,
            'error' => $error
        ]);
    }
}
