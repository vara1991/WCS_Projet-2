<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 16:07
 * PHP version 7
 */

namespace App\Controller;

use App\Model\AdminManager;

/**
 * Class ItemController
 *
 */
class AdminController extends AbstractController
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
        $adm= new AdminManager();
        $items = $adm->selectAll();

        return $this->twig->render('Admin/index.html.twig', ['items' => $items]);
    }


    /**
     * Display item informations specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function show(int $id)
    {
        $adm = new AdminManager();
        $item = $adm->selectOneById($id);

        return $this->twig->render('Admin/show.html.twig', ['item' => $item]);
    }


    /**
     * Display item edition page specified by $id
     *
     * @param int $id
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function update(int $id): string
    {
        $adm = new AdminManager();
        $objet = $adm->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = [
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'status_id' => $_POST['status_id'],
                'bounty' => $_POST['bounty'],
                'date_kill' => $_POST['date_kill'],
                'weapon_id' => $_POST['weapon_id'],
                'bio' => $_POST['bio'],
                'img' => $_POST['img'],

            ];

            $adm->update($item);
            header('Location:/target/index');
        }

        return $this->twig->render('Admin/edit.html.twig', ['item' => $objet]);
    }


    /**
     * Display item creation page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adm = new AdminManager();

            $item = [

                'name' => $_POST['name'],
                'status_id' => $_POST['status_id'],
                'bounty' => $_POST['bounty'],
                'date_kill' => $_POST['date_kill'],
                'weapon_id' => $_POST['weapon_id'],
                'bio' => $_POST['bio'],
                'img' => $_POST['img'],

                ];

            $id = $adm->insert($item);
            header('Location:/Admin/show/' . $id);
        }

        return $this->twig->render('Admin/add.html.twig');
    }


    /**
     * Handle item deletion
     *
     * @param int $id
     */
    public function delete(int $id)
    {
        $adm = new AdminManager();
        $adm->delete($id);
        header('Location:/Admin/index');
    }
}
