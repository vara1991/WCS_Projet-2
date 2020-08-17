<?php

namespace App\Controller;

use App\Model\RegisterManager;

class RegisterController extends AbstractController
{
    public function index()
    {
        session_start();
        $registerManager = new RegisterManager();
        $error = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                $confirmSpeudo = $registerManager->user($_POST['pseudo']);
                if ($confirmSpeudo === false ) {
                    if ($_POST['password'] === $_POST['confirmPassword']) {
                        $register = [
                            'pseudo' => $_POST['pseudo'],
                            'email' => $_POST['email'],
                            'password' => $_POST['password'],
                            'role' => 1,
                        ];
                        $registerManager->add($register);
                        $_SESSION['login'] = true;
                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        $_SESSION['admin'] = false;
                        return $this->twig->render('Log/welcome.html.twig', [
                            'connected' => $_SESSION['login'],
                            'admin' => $_SESSION['admin'] = false,
                            'pseudo' => $_SESSION['pseudo']
                        ]);
                    } else {
                        $error['password'] = 'Mot de passe incorrect';
                    }
                } else {
                    $error['pseudo'] = 'Le pseudo existe déjà';
                }
            } else {
                $error['form'] = 'Tous les champs doivent être remplis';
            }
        }

        return $this->twig->render('Log/register.html.twig', [
            'error' => $error
        ]);
    }
}