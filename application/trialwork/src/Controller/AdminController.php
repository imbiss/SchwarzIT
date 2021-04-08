<?php
namespace App\Controller;
use App\Form\Type\PortalType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Portal;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\Type\ImprintType;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;


class AdminController extends AbstractController
{


    public function index(): Response
    {
        return $this->render("admin/index.html.twig", []);
    }


    public function portal(Request $request): Response
    {
        $pe = new Portal();
        $form = $this->createForm(PortalType::class, $pe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pe = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pe);
            $entityManager->flush();
            // add flash bag
            $this->get('session')->getFlashBag()->add('notice','New localed added!');
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
        $form = $this->createForm(PortalType::class, $pe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pe = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pe);
            $entityManager->flush();
            // add flash bag
            $this->get('session')->getFlashBag()->add('notice','update!');
            return $this->redirectToRoute("admin_portal");
        }
        return $this->render("admin/portal.html.twig", [
            'form' => $form->createView(),
            'portals' => null
        ]);
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

}