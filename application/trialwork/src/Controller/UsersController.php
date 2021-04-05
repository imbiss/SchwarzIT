<?php
namespace App\Controller;

use App\Service\UserApiClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Psr\Log\LoggerInterface;

class UsersController extends AbstractController
{
    public function index(UserApiClientInterface $client, LoggerInterface $logger): Response
    {
        $users = [];
        try {
            $users = $client->getUsers();
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
        }
        return $this->render("users/index.html.twig", [
            'users' => $users
        ]);
    }

}