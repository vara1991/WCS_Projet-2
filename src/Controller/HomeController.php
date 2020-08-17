<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
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

        $homeManager = new HomeManager();
        $gain = $homeManager->bounty();
        $kill = $homeManager->kill();
        $maxkill = $homeManager->killByDate();

        return $this->twig->render('Home/index.html.twig', [
                'connected' => $_SESSION['login'],
                'gain' => $gain['total_prime'],
                'kill' => $kill['dead_status'],
                'maxkill' => $maxkill['same_date'],
            ]);
    }
}
