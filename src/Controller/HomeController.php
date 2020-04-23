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
        $hm = new HomeManager();
        $gain = $hm->bounty();
        $kill = $hm->kill();
        $maxkill = $hm->killByDate();
        $favWeapon = $hm->favWeapon();
        return $this->twig->render('Home/index.html.twig', [
                'gain' => $gain['total_prime'],
                'kill' => $kill['dead_status'],
                'maxkill' => $maxkill['same_date'],
                'favWeapon' => $favWeapon['favorite_weapon']
            ]);
        ;
    }
}
