<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    App\ApiClient;

class UsersController extends AbstractController
{
    public function index(ApiClient $client): Response
    {
        $users = $client->getUsers();
        return $this->render("users/index.html.twig", [
            'users' => $users,
        ]);
    }

}