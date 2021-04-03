<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController,
    Symfony\Component\HttpFoundation\Response,
    Symfony\Contracts\Translation\TranslatorInterface,
    Symfony\Component\HttpFoundation\Request,
    App\Entity\Imprint,
    App\Repository\ImprintInterface,
    Symfony\Contracts\Cache\CacheInterface;

class ImprintController extends AbstractController
{
    public function index(TranslatorInterface $translator, Request $request, ImprintInterface $imprintRepo, CacheInterface $cache): Response
    {
        return $this->render("imprint/index.html.twig", [
            'pageTitel' => $translator->trans('imprintPageTitel'),
            'imprintEntity' => $cache->get( 'CSV_Imprint_' . md5($request->getLocale()), function () use ($imprintRepo, $request) {
                return $imprintRepo->find($request->getLocale());
            })
        ]);
    }
}