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
        $tmr = new TargetManager();
        $items = $tmr->selectAll();
        //$weapon = $tmr->weapon();
        //var_dump($weapon);

        return $this->twig->render('Target/index.html.twig',[
            'items' => $items,
            //'weapon'=> $weapon       
        ]);

    }
}
