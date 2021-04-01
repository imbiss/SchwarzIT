<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Contracts\Translation\TranslatorInterface,
    Symfony\Component\HttpFoundation\Request,
    App\Entity\Imprint;


class ImprintController extends AbstractController
{


    public function index(TranslatorInterface $translator, Request $request): Response
    {
        $locale = $request->getLocale();
        $imprint = $translator->trans('imprint');
        $content = Imprint::getContent($locale);
        return $this->render("imprint/index.html.twig", [
            'imprint' => $imprint,
            'locale' => $locale,
            'content' => $content
        ]);
    }

}