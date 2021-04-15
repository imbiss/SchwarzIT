<?php
namespace App\Controller;

use App\Entity\Portal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PortalController extends AbstractController
{

    public function index(Request $request): Response
    {
        return $this->render("portal/index.html.twig", [
            'currentLocale' => $request->getLocale(),
            'portals' => $this->getDoctrine()->getRepository(Portal::class)->findAll()
        ]);
    }

}