<?php
namespace App\Controller\Base;

use App\Entity\Portal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{


    public function pageHeader(Request $request): Response
    {
        return $this->render("common/_header.twig", [
            'currentLocale' => $request->getLocale(),
            'portals' => $this->getDoctrine()->getRepository(Portal::class)->findAll()
        ]);
    }



    public function pageFooter(Request $request): Response
    {
        return $this->render("common/_footer.twig", [
            'currentLocale' => $request->getLocale(),
        ]);
    }

}
