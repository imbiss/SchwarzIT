<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Contracts\Translation\TranslatorInterface,
    Symfony\Component\HttpFoundation\Request,
    App\Entity\Imprint,
    App\Repository\ImprintInterface;

class ImprintController extends AbstractController
{
    public function index(TranslatorInterface $translator, Request $request, ImprintInterface $imprintRepo): Response
    {
        return $this->render("imprint/index.html.twig", [
            'pageTitel' => $translator->trans('imprint'),
            'imprintEntity' => $imprintRepo->find($request->getLocale())
        ]);
    }
}