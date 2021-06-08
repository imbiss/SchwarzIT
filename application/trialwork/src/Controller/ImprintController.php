<?php
namespace App\Controller;

use App\Service\PageService;
use App\Service\PortalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Portal;
use App\Repository\PortalInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImprintController extends AbstractController
{

    private PortalService $portalService;

    private PageService $pageService;

    public function __construct(PortalService $portalService, PageService $pageService)
    {
        $this->portalService = $portalService;
        $this->pageService = $pageService;
    }

    public function index(TranslatorInterface $translator, Request $request): Response
    {
        $locale = $request->getLocale();
        $portal = $this->getPortalByLocal($locale);
        $imprintPage = $this->pageService->getPagesByPortId($portal->getId());
        dump($imprintPage);
        if ($portal == null) {
            // not found
            throw new NotFoundResourceException('Not found ' . $locale);
        }

        return $this->render("imprint/index.html.twig", [
            'pageTitel' => $translator->trans('imprintPageTitel'),
            'portalEntity' => $portal,
            'pageEntity' => $imprintPage,
            'portals' => $this->portalService->getAllPortal(),
            'currentLocale' => $request->getLocale()
        ]);
    }

    /**
     * The simple way to return an json response
     *
     * @return JsonResponse
     */
    public function jsonFormat(Request $request ): JsonResponse
    {
        $statusCode = 200;
        $locale = $request->getLocale();
        $portal = $this->getPortalByLocal($locale);
        if ($portal == null) {
            // not found
            $portal = [];
            $statusCode = 404;
        }
        return $this->json($portal)->setStatusCode($statusCode);
    }

    private function getPortalByLocal(string $locale): ?Portal
    {
        return $this->portalService->findPortalByLocale($locale);
    }



}