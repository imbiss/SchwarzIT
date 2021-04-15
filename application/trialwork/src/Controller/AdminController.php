<?php
namespace App\Controller;
use App\Controller\Base\BaseController;
use App\Form\Type\PortalType;
use App\Entity\Portal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\ImprintType;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;


class AdminController extends BaseController
{


    public function index(): Response
    {
        return $this->render("admin/index.html.twig", []);
    }


    public function portal(Request $request): Response
    {
        $form = $this->createPortalForm((new Portal()));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityPersist($form->getData());
            // add flash bag
            $this->get('session')->getFlashBag()->add('notice','New locale added!');
        }
        $all = $this->getDoctrine()->getRepository(Portal::class)->findAll();
        return $this->render("admin/portal.html.twig", [
            'form' => $form->createView(),
            'portals' => $all
        ]);
    }

    public function edit(Request $request): Response
    {
        $criteria = [
            'locale' => $request->get('locale')
        ];
        $pe = $this->getDoctrine()->getRepository(Portal::class)->findOneBy($criteria);
        $form = $this->createPortalForm($pe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityPersist($form->getData());
            // add flash bag
            $this->get('session')->getFlashBag()->add('notice','update!');
            return $this->redirectToRoute("admin_portal");
        }
        return $this->render("admin/portal.html.twig", [
            'form' => $form->createView(),
            'portals' => null // do not show other portals in edit mode
        ]);
    }

    private function entityPersist(Portal $pe)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pe);
        $entityManager->flush();
        return $this;
    }

    public function delete(Request $request): Response
    {
        $criteria = [
            'locale' => $request->get('locale')
        ];
        $pe = $this->getDoctrine()->getRepository(Portal::class)->findOneBy($criteria);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($pe);
        $entityManager->flush(); // delete
        // add flash bag
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
        $options = [];
        return $this->createForm(PortalType::class, $pe, $options);
    }




}