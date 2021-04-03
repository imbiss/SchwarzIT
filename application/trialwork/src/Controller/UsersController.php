<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    App\ApiClient,
    Psr\Log\LoggerInterface;

class UsersController extends AbstractController
{
    public function index(ApiClient $client, LoggerInterface $logger): Response
    {
        try {
            $users = $client->getUsers();
        } catch (\Exception $e) {
            $logger->error($e->getMessage());
            $users = [];
        }
        $response = $this->render("users/index.html.twig", [
            'users' => $users
        ]);

        if (empty($users)) {
            $response->setStatusCode(404);
        }

        return $response;
    }

}