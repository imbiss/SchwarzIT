<?php
namespace App\Controller;
use App\Controller\Base\BaseController;
use App\Form\Type\PortalType;
use App\Entity\Portal;
use App\Service\PortalService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\ImprintType;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;


class AdminController extends BaseController
{

    private PortalService $portalService;

    public function __construct(PortalService $portalService)
    {
        $this->portalService = $portalService;
    }

    public function index(): Response
    {
        return $this->render("admin/index.html.twig", []);
    }


    public function portal(Request $request): Response
    {
        $form = $this->createPortalForm((new Portal()));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->portalService->addPortal($form->getData());
            $this->get('session')->getFlashBag()->add('notice','New locale added!');
        }
        return $this->render("admin/portal.html.twig", [
            'form' => $form->createView(),
            'portals' => $this->portalService->getAllPoral()
        ]);
    }

    public function edit(Request $request): Response
    {
        $form = $this->createPortalForm($this->portalService->findPortalByLocale($request->get('locale')));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->portalService->updatePortal($form->getData());
            $this->get('session')->getFlashBag()->add('notice','update!');
            return $this->redirectToRoute("admin_portal");
        }
        return $this->render("admin/portal.html.twig", [
            'form' => $form->createView(),
            'portals' => null // do not show other portals in edit mode
        ]);
    }


    public function delete(Request $request): Response
    {
        $this->portalService->removePortalByLocale($request->get('locale'));
        $this->get('session')->getFlashBag()->add('notice','deleted');
        return $this->redirectToRoute("admin_portal");
    }

    /**
     * Create a form (type=PortalType)
     * @param Portal $pe
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createPortalForm(Portal $pe)
    {
        return $this->createForm(PortalType::class, $pe, []);
    }


}