<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Component\HttpFoundation\Request;

class UsersController extends AbstractController
{


    public function index(): Response
    {
        $users = [];
        return $this->render("users/index.html.twig", [
            'users' => $users,
        ]);
    }

}