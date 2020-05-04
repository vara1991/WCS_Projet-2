<?php

namespace App\Controller;

class ContactController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */

    public function index()
    {
        session_start();
        if (empty($_SESSION['login'])) {
            $_SESSION['login'] = false;
        }
        $error = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
                $to = "michellisa.75@gmail.com";
                $from = "lilouuuups@gmail.com";

                $email = $_POST['email'];
                $message = $_POST['message'];
                $subject = $_POST['subject'];
                $name = $_POST['name'];

                $content = "Objet:" . $subject . "<br>" . "Nom:" . $name . "<br>" . "Email:" . $email . "<br>" . "Message:" . $message;
                $headers = "from: " . $from;
                mail($to, $subject, $content, $headers);
                return $this->twig->render(
                    'Contact/message.html.twig',
                    [
                        'name' => $name,
                        'subject' => $subject,
                        'connected' => $_SESSION['login'],
                    ]
                );
            }
        }
        if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message'])) {
            $error = "Tous les champs sont obligatoires";
        }
        return $this->twig->render(
            'Contact/index.html.twig',
            [
                'error' => $error,
                'connected' => $_SESSION['login'],
            ]
        );
    }
}
