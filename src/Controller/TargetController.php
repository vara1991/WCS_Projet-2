<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\TargetManager;

/**
 * Class ItemController
 *
 */
class TargetController extends AbstractController
{


    /**
     * Display item listing
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        session_start();
        if (empty($_SESSION['login']) && empty($_SESSION['admin'])) {
            $_SESSION['login'] = false;
            $_SESSION['admin'] = false;
        }
        $tmr = new TargetManager();
        $targets = $tmr->selectAll();
        $alive = $tmr->getAlive();
        $dead = $tmr->getDead();
        $result = [];
        
        foreach ($targets as $target) {
            if (!empty($target['weapon_id'])) {
                $weapon = $tmr->getWeapon(intval($target['weapon_id']));
                foreach ($weapon as $item) {
                    $target['weapon_name'] = $item['weapon_name'];
                }
            }
            if (!empty($target['status_id'])) {
                $status = $tmr->getStatus(intval($target['status_id']));
                foreach ($status as $item) {
                    $target['status_name'] = $item['status_name'];
                }
            }
            if (!empty($target['img'])) {
                $img = $tmr->getImg(intval($target['img']));
                foreach ($img as $item) {
                    $target['img'] = $item['img'];
                }
            }
            array_push($result, $target);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tmr->getLike(intval($_POST['id']));
            var_dump($_POST['id']);
            header("Location: http://localhost:8000/target/index");

        }
        return $this->twig->render('Target/index.html.twig', [
            'targets' => $result,
            'alive' => $alive,
            'dead' => $dead,
            'connected' => $_SESSION['login'],
            'admin' => $_SESSION['admin']
        ]);
    }
}
