<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Contracts\Translation\TranslatorInterface,
    Symfony\Component\HttpFoundation\Request;

class PortalController extends AbstractController
{


    public function index(TranslatorInterface $translator, Request $request): Response
    {

        return $this->render("portal/index.html.twig", [

        ]);
    }

}