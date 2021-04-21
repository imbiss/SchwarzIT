<?php
namespace App\Controller;

use App\Controller\Base\BaseController;
use App\Entity\Page;
use App\Form\Type\PageType;
use App\Service\PageService;
use App\Service\PortalService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends BaseController
{
    private PortalService $portalService;

    private PageService $pageService;


    public function __construct(PortalService $portalService, PageService $pageService)
    {
        $this->portalService = $portalService;
        $this->pageService = $pageService;
    }

    public function index(Request $request):Response
    {
        $form = $this->createForm(PageType::class, (new Page()), [
            'portal_allowed_options' => $this->portalService->getAllPortalOptions()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->pageService->addPage($form->getData());
            $this->addNotice('New Page added!');
        }

        return $this->render("page/index.html.twig", [
            'form' => $form->createView(),
            'pages' => $this->pageService->getAllPages()
        ]);
    }

    public function delete(Request $request): Response
    {
        $this->pageService->removePage($request->get('pageid'));
        $this->addNotice('deleted');
        return $this->redirectToRoute("admin_page");
    }
}