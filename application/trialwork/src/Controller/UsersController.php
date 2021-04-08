<?php
namespace App\Controller;

use App\Service\UserApiClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use App\Service\Exception\Network;
use App\Service\Exception\Serialize;

class UsersController extends AbstractController
{
    public function index(UserApiClientInterface $client, LoggerInterface $logger): Response
    {
        try {
            $users = [];
            $statusCode = 200;
            $users = $client->getUsers();
        } catch (Network $e) {
            // 503 Service Unavailable
            $statusCode = 503;
            $logger->error($e->getMessage());
        } catch (Serialize $e) {
            //500 Internal Server Error
            $statusCode = 500;
            $logger->error($e->getMessage());
        } finally {
            return $this->render("users/index.html.twig", [
                'users' => $users
            ])->setStatusCode($statusCode);
        }

    }

}