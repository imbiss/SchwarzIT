<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    App\ApiClient,
    Psr\Log\LoggerInterface,
    Symfony\Contracts\Cache\CacheInterface;

class UsersController extends AbstractController
{
    public function index(ApiClient $client, LoggerInterface $logger, CacheInterface $cache): Response
    {
        try {
            $users = $cache->get('API_Call_UserAPI_' . md5('UserAPI'), function () use ($client) {
                return $client->getUsers();
            } );

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