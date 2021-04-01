<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Contracts\Translation\TranslatorInterface,
    Symfony\Component\HttpFoundation\Request,
    App\Entity\Imprint;


class ApiController extends AbstractController
{


    public function imprint(TranslatorInterface $translator, Request $request): Response
    {
        $imprint = [
            'content' => Imprint::getContent()
        ];
        return $this->json($imprint, Response::HTTP_OK, [], []);
    }

}